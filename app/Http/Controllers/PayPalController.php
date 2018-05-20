<?php
namespace App\Http\Controllers;

use App\Invoice;
use App\Item;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Srmklive\PayPal\Services\AdaptivePayments;
use Srmklive\PayPal\Services\ExpressCheckout;

class PayPalController extends Controller
{

    protected $provider;

    public function __construct() {
        $this->provider = new ExpressCheckout();
    }

    public function getIndex(Request $request) {
        $response = [];
        if (session()->has('code')) {
            $response['code'] = session()->get('code');
            session()->forget('code');
        }
        if (session()->has('message')) {
            $response['message'] = session()->get('message');
            session()->forget('message');
        }
        return view('welcome', compact('response'));
    }

    public function getExpressCheckout(Request $request) {
        $recurring = ($request->get('mode') === 'recurring') ? true : false;
        $cart = $this->getCheckoutData($recurring);
        try {
            $response = $this->provider->setExpressCheckout($cart, $recurring);
            return redirect($response['paypal_link']);
        } catch (\Exception $e) {
            $invoice = $this->createInvoice($cart, 'Invalid');
            session()->put(['code' => 'danger', 'message' => "Error processing PayPal payment for Order $invoice->id!"]);
        }
    }

    public function getExpressCheckoutSuccess(Request $request) {
        $token = $request->get('token');
        $PayerID = $request->get('PayerID');
        $cart = $this->getCheckoutData($recurring);
        // Verify Express Checkout Token

        dd($cart);
        $response = $this->provider->getExpressCheckoutDetails($token);

        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            $payment_status = $this->provider->doExpressCheckoutPayment($cart, $token, $PayerID);
            $status = $payment_status['PAYMENTINFO_0_PAYMENTSTATUS'];
            $invoice = $this->createInvoice($cart, $status);
            if ($invoice->paid) {
                session()->put(['code' => 'success', 'message' => "Order $invoice->id has been paid successfully!"]);
            } else {
                session()->put(['code' => 'danger', 'message' => "Error processing PayPal payment for Order $invoice->id!"]);
            }
            return redirect('/');
        }
    }     

    public function getAdaptivePay()
    {
        $this->provider = new AdaptivePayments();
        $data = [
            'receivers'  => [
                [
                    'email'   => 'johndoe@example.com',
                    'amount'  => 10,
                    'primary' => true,
                ],
                [
                    'email'   => 'janedoe@example.com',
                    'amount'  => 5,
                    'primary' => false,
                ],
            ],
            'payer'      => 'EACHRECEIVER', // (Optional) Describes who pays PayPal fees. Allowed values are: 'SENDER', 'PRIMARYRECEIVER', 'EACHRECEIVER' (Default), 'SECONDARYONLY'
            'return_url' => 'payment/success',
            'cancel_url' => 'payment/cancel',
        ];
        $response = $this->provider->createPayRequest($data);
    }
    /**
     * Parse PayPal IPN.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function notify(Request $request)
    {
        if (!($this->provider instanceof ExpressCheckout)) {
            $this->provider = new ExpressCheckout();
        }
        $request->merge(['cmd' => '_notify-validate']);
        $post = $request->all();
        $response = (string) $this->provider->verifyIPN($post);
        $logFile = 'ipn_log_'.Carbon::now()->format('Ymd_His').'.txt';
        Storage::disk('local')->put($logFile, $response);
    }
    /**
     * Set cart data for processing payment on PayPal.
     *
     * @param bool $recurring
     *
     * @return array
     */
    protected function getCheckoutData($recurring = false)
    {
        $data = [];
        $data['items'] = [
            [
                'name'  => 'Monthly Subscription '.config('paypal.invoice_prefix'),
                'price' => 100,
                'qty'   => 1,
            ],
        ];
        ///$data['return_url'] = ''; route('getExpressCheckoutSuccess', ['mode' => 'recurring']);
        $data['subscription_desc'] = 'Monthly Subscription '.config('paypal.invoice_prefix');
        $data['invoice_id'] = config('paypal.invoice_prefix');
        $data['invoice_description'] = "Order Invoice";
        $data['cancel_url'] = '/';
        $total = 0;
        foreach ($data['items'] as $item) {
            $total += $item['price'] * $item['qty'];
        }
        $data['total'] = $total;
        return $data;
    }

    protected function createInvoice($cart, $status)
    {
        $invoice = new Invoice();
        $invoice->title = $cart['invoice_description'];
        $invoice->price = $cart['total'];
        if (!strcasecmp($status, 'Completed') || !strcasecmp($status, 'Processed')) {
            $invoice->paid = 1;
        } else {
            $invoice->paid = 0;
        }
        $invoice->save();
        collect($cart['items'])->each(function ($product) use ($invoice) {
            $item = new Item();
            $item->invoice_id = $invoice->id;
            $item->item_name = $product['name'];
            $item->item_price = $product['price'];
            $item->item_qty = $product['qty'];
            $item->user_id = \Auth::user()->id;
            $item->save();
        });
        return $invoice;
    }
}
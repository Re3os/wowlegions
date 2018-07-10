<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\{Shop, CodesShop, User, PaymentDetails, Invoice, Item, CatShop};

use App\Mail\MailOrderShop;

use Srmklive\PayPal\Services\AdaptivePayments;
use Srmklive\PayPal\Services\ExpressCheckout;

class ShopController extends Controller
{

    protected $provider;

    public function __construct() {
        $this->provider = new ExpressCheckout();
        $this->middleware('auth');
    }

    public function index() {
        $data = CatShop::where('act', '=', 1)->with('shop')->orderBy('order', 'asc')->get();
        return view('shop.index', ['data' => $data]);
    }

    public function view($slug) {
        $item = Shop::where('short_code', $slug)->leftJoin('cat_shops', 'shops.category_id', '=', 'cat_shops.id')->firstOrFail();
        return view('shop.view', ['item' => $item]);
    }

    public function buy($slug) {
        $item = Shop::where('short_code', $slug)->firstOrFail();
        return view('shop.buyItem', ['item' => $item]);
    }

    public function store($slug)
    {
        $item = Shop::where('short_code', $slug)->firstOrFail();

        $ActivationCode = CodesShop::generateItemCode();

        $topic = CodesShop::create([
          'purchased_item' => $slug,
          'item_id' => $item['item_id'],
          'item_name' => $item['title'],
          'purchase_code'     => $ActivationCode,
          'purchased_for_account'  => \Auth::user()->id,
          'code_activated'  => '0'
        ]);

        $newBalance = \Auth::user()->balance - $item['price'];
        User::setBalance(\Auth::user()->id, $newBalance);

        PaymentDetails::create([
          'userid' => \Auth::user()->id,
          'service'     => $item['short_code'],
          'item_name'  => $item['title'],
          'price'  => $item['price'],
          'digital_key'  => $ActivationCode,
          'status'  => '1'
        ]);

        \Mail::to(\Auth::user()->email)->send(new MailOrderShop($item['title'], $item['price'], $ActivationCode));

        return redirect()->route('shop.buyComplete', [$slug]);
    }

    public function buyComplete($slug) {
        $item = Shop::where('short_code', $slug)->firstOrFail();
        $code = PaymentDetails::where('service', $slug)->where('userid', \Auth::user()->id)->firstOrFail();
        return view('shop.complete', ['item' => $item, 'code' => $code]);
    }

    public function addBalance() {
        return view('shop.addBalance');
    }

    public function payBalance() {
        return view('shop.payBalance');
    }

    public function payPaypal(Request $request) {
        $item = Item::where('invoice_id', $request->get('id'))->where('user_id', $request->get('u'))->get();
        if(isset($item[0])) {
            if($item[0]->status == 1) {
                return redirect(route('shop'));
            }
            $user = \Auth::user();
            $user->balance += $item[0]->item_price;
            $user->save();
            Item::where('invoice_id', $request->get('id'))->update(['status' => '1']);
            return view('shop.paypalBalance', ['balance' => $item[0]->item_price]);
        } else {

        }
    }

    public function payBalanceAction(Request $request) {
        $recurring = ($request->get('mode') === 'recurring') ? true : false;
        $cart = $this->getCheckoutData($request->input('balanceAmount'), $recurring);
        try {
            $response = $this->provider->setExpressCheckout($cart, $recurring);
            return redirect($response['paypal_link']);
        } catch (\Exception $e) {
            $invoice = $this->createInvoice($cart, 'Invalid');
            session()->put(['code' => 'danger', 'message' => "Error processing PayPal payment for Order $invoice->id!"]);
        }
        return view('shop.payBalance', ['amount' => $request->input('balanceAmount'), 'invoice' => $invoice->id]);
    }

    protected function getCheckoutData($price, $recurring = false)
    {
        $data = [];
        $data['items'] = [
            [
                'name'  => iconv('windows-1251', 'UTF-8', 'Пополнение баланса'),
                'price' => $price,
                'qty'   => 1,
            ],
        ];
        ///$data['return_url'] = route('getExpressCheckoutSuccess', ['mode' => 'recurring']);
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
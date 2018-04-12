<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\{Shop, CodesShop, User, PaymentDetails};

use App\Mail\MailOrderShop;

class ShopController extends Controller
{

    public function __construct() {
        //$this->middleware('auth');
    }

    public function index() {
        $mount = Shop::where('item_type', '=', '3')->get();
        $item = Shop::where('item_type', '=', '2')->get();
        return view('shop.index', ['mount' => $mount, 'items' => $item]);
    }

    public function view($slug) {
        $item = Shop::where('short_code', $slug)->firstOrFail();
        return view('shop.mountView', ['item' => $item]);
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
          'status'  => '0'
        ]);

        \Mail::to(\Auth::user()->email)->send(new MailOrderShop($item['title'], $item['price'], $ActivationCode));

        return redirect()->route('shop.buyComplete', [$slug]);
    }

    public function buyComplete($slug) {
        $item = Shop::where('short_code', $slug)->firstOrFail();
        $code = PaymentDetails::where('service', $slug)->where('userid', \Auth::user()->id)->firstOrFail();
        return view('shop.complete', ['item' => $item, 'code' => $code]);
    }
}

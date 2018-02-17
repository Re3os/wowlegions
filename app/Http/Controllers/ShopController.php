<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Shop;

class ShopController extends Controller
{

    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index()
    {
        $news = Shop::latest()->simplePaginate(2);
        return view('shop.index', ['blog' => $news]);
    }
}

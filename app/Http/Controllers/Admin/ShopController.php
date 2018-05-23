<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Auth;

use App\{
    Shop,
    Item
};

use App\Services\Text;

class ShopController extends Controller
{
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function delete($id) {
        Shop::where('id', $id)->delete();
        return redirect()->route('admin-shop-list');
    }

    public function save(Request $request) {
        Shop::where('id', $request->input('id'))->update([
            'title' => $request->input('title'),
            'price' => $request->input('price'),
            'short_code' => Text::createSlug($request->input('title')),
            'item_id' => $request->input('item_id'),
            'item_type' => $request->input('type')
        ]);
        return redirect()->route('admin-shop-list');
    }

    public function edit($id) {
        return view('admin.shop.edit', ['blog' => Shop::where('id', $id)->firstOrFail()]);
    }

    public function create()
    {
       return view('admin.shop.create');
    }

    public function list() {
        return view('admin.shop.list', ['list' => Shop::orderBy('created_at', 'desc')->simplePaginate(10)]);
    }

    public function createAction(Request $request) {
        $image_name = $request->file('img')->getClientOriginalName();
        $file = $request->file('img')->move(public_path('uploads/shop/'), $image_name);
        Shop::create([
            'title' => $request->input('title'),
            'price' => $request->input('price'),
            'short_code' => Text::createSlug($request->input('title')),
            'item_id' => $request->input('item_id'),
            'images' => $image_name,
            'item_type' => $request->input('type')
        ]);
        return redirect()->route('admin-shop-list');
    }
}
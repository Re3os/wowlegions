<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\{User, Account, Blog};

use Auth;

class AdminController extends Controller
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
   /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
   public function index()
   {
       return view('admin.home', [
            'account' => User::count(),
            'banned' => Account::banedUser(),
            'news' => Blog::count(),
       ]);
   }
}
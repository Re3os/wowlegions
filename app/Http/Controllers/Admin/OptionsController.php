<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\{User, Account};

use App\Services\Admin;

use Auth;

class OptionsController extends Controller
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
       $admin = new Admin();
       return view('admin.options.options', [
            'info' => $admin->infoEnv(),
       ]);
   }
}
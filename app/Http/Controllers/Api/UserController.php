<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Resources\{User, Navigation};

class UserController extends Controller
{

    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index() {
        return new User(\Auth::user());
    }

}
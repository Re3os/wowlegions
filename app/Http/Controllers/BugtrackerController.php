<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BugtrackerController extends Controller
{

    public function index() {
        return view('bugtracker.index');
    }
}

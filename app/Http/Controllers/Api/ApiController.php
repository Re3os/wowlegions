<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class ApiController extends Controller
{

    public function time() {
        $time = "{\"now\":" . time() . "}";
        return $time;
    }

    public function localized() {
        return view('api.localizedStrings');
    }

    public function user() {
        return view('api.user');
    }

}
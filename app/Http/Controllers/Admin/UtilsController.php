<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Auth;

use App\Services\Utils;

class UtilsController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }

    public function clearCache() {
        return Utils::clearCache();
    }
}
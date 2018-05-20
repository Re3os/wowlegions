<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\{Blog, Account};


class HomeController extends Controller
{

    public function index() {
        $featured = Blog::orderBy('title', 'desc')->limit(3)->get();
        $news = Blog::with('comments')->latest()->simplePaginate(2);
        return view('home', ['blog' => $news, 'featured' => $featured]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\{Blog, Account, Topic};


class HomeController extends Controller
{

    public function index() {
        //dd(\App::getLocale());
        $news = Blog::with('comments')->latest()->simplePaginate(4);
        $forum = Topic::with('category')->orderBy('created_at', 'desc')->get();
        return view('home', ['blog' => $news, 'forum' => $forum]);
    }
}

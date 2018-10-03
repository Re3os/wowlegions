<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Blog;
use App\Forum\Thread;


class HomeController extends Controller
{

    public function index() {
        $news = Blog::with('comments')->latest()->simplePaginate(4);
        $forum = Thread::whereNull('parent_id')->orderBy('updated_at', 'desc')->limit(7)->get();
        return view('home', ['blog' => $news, 'forum' => $forum]);
    }

    public function offline() {
        return view('maintenance.offline');
    }
}

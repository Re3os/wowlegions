<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\{Blog, Comment};

class BlogController extends Controller {

    public function index() {
        $featured = Blog::with('comments')->orderBy('created_at', 'desc')->limit(3)->get();
        $news = Blog::with('comments')->latest()->simplePaginate(10);
        return view('blog.index', ['blog' => $news, 'featured' => $featured]);
    }

    public function show($id) {
        $blog = Blog::where('id', $id)->firstOrFail();
        return view('blog.show', ['blog' => $blog]);
    }

    public function frag() {
        $news = Blog::with('comments')->simplePaginate(10);
        return view('blog.frag', ['blog' => $news]);
    }
}
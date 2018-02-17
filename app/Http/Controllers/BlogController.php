<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\{Blog, Comment};

class BlogController extends Controller {

    public function show(Blog $blog) {
        return view('blog.show', compact('blog'));
    }
}
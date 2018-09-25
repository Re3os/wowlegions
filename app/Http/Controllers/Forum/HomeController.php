<?php

namespace App\Http\Controllers\Forum;

use App\Http\Controllers\Controller;
use App\Forum\Channel;
use App\Forum\Thread;
use App\Forum\Pathnotes;

class HomeController extends Controller {

    public function index() {
        $threads = Channel::where('lang', '=', app()->getLocale())->whereNull('parent_id')->with('forums')->get();
        return view('forum.categories.index', compact('threads'));
    }

    public function patchNotes() {
        $threads = Channel::where('lang', '=', app()->getLocale())->whereNull('parent_id')->with('forums')->get();
        $pathNotes = Pathnotes::limit(10)->get();
        return view('forum.patch_notes', compact('threads', 'pathNotes'));
    }

    public function show($slug) {
        $threads = Channel::where('lang', '=', app()->getLocale())->whereNull('parent_id')->with('forums')->get();
        $category = Channel::where('id', $slug)->whereNotNull('parent_id')->firstOrFail();
        $topics = Thread::whereChannelId($category->id)->whereNull('parent_id')->orderBy('sticky', 'DESC')->orderBy('created_at', 'DESC')->with(['user' => function($query) {
          $query->select('id', 'name', 'role');
        }])->paginate(30);
        return view('forum.categories.show', compact('category', 'topics', 'threads'));
    }
}
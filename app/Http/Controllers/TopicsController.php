<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Topic, Category, Reply, User};

class TopicsController extends Controller
{

    public function store(Category $category)
    {
        $this->validate(request(), [
          'subject' => 'required|max:75',
          'messages' => 'required|max:2000'
        ]);

        $topic = Topic::create([
          'title'       => request('subject'),
          'content'     => request('messages'),
          'category_id' => $category->id,
          'user_id'  => \Auth::user()->id
        ]);

        return redirect()->route('forum.topic', [$category->id, $topic->id]);
    }

    public function store_reply($category, Topic $topic)
    {
        $this->validate(request(), [
            'detail' => 'required|max:2000'
        ]);

        $topic->replies()->create([
            'content'  => request('detail'),
            'user_id'  => \Auth::user()->id
        ]);

        return back();
    }

    public function show($category, Topic $topic)
    {
        $replies = $topic->replies()->simplePaginate(10);

        return view('forum.categories.topic', compact('category', 'topic', 'replies'));
    }

}

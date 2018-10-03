<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Auth;

use App\Services\ParserText;

use App\{
    Blog
};

class NewsController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }

    public function delete($id) {
        Blog::where('id', $id)->delete();
        return redirect()->route('admin-news-list');
    }

    public function save(Request $request) {
        $bb = new ParserText();
        Blog::where('id', $request->input('id'))->update([
          'title' => $request->input('title'),
          'desc_blog'     => $bb->bb_parse($request->input('short_story')),
          'full_blog'  => $bb->bb_parse($request->input('full_story'))
        ]);
        return redirect()->route('admin-news-list');
    }

    public function edit($id) {
        return view('admin.news.edit', ['blog' => Blog::where('id', $id)->firstOrFail()]);
    }

    public function create()
    {
       return view('admin.news.create');
    }

    public function list() {
        return view('admin.news.list', ['list' => Blog::orderBy('created_at', 'desc')->simplePaginate(10)]);
    }

    public function createAction(Request $request) {
        $bb = new ParserText();
        $image_name = $request->file('img')->getClientOriginalName();
        $file = $request->file('img')->move(public_path('uploads/images/'), $image_name);
        Blog::create([
            'title' => $request->input('title'),
            'desc_blog'     => $bb->bb_parse($request->input('short_story')),
            'full_blog'  => $bb->bb_parse($request->input('full_story')),
            'posted_by' => Auth::user()->id,
            'comments_key' => '0',
            'images' => $image_name
        ]);

        return redirect()->route('admin-news-list');
    }
}
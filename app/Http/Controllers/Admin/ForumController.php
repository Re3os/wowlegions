<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Auth;

use App\{
    Shop,
    Category
};

use App\Services\Text;

class ForumController extends Controller
{
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function delete($id) {
        Category::where('id', $id)->delete();
        return redirect()->route('admin-forum-list');
    }

    public function save(Request $request) {
        Category::where('id', $request->input('id'))->update([
            'name' => $request->input('cat_name'),
            'category_description' => $request->input('fulldescr'),
            'parent_id' => $request->input('parentid'),
            'icons' => $request->input('cat_icon')
        ]);
        return redirect()->route('admin-forum-list');
    }

    public function edit($id) {
       return view('admin.forum.edit', ['edit' => Category::where('id', $id)->firstOrFail(), 'list' => Category::whereNull('parent_id')->with('forums')->get()]);
    }

    public function create()
    {
       return view('admin.forum.create');
    }

    public function list() {
        $list = Category::whereNull('parent_id')->with('forums')->get();
        return view('admin.forum.list', ['list' => $list]);
    }

    public function createAction(Request $request) {
        $image_name = $request->file('img')->getClientOriginalName();
        $file = $request->file('img')->move(public_path('cms/forum_icon/'), $image_name);
        Category::create([
            'name' => $request->input('cat_name'),
            'category_description' => $request->input('fulldescr'),
            'parent_id' => $request->input('forum'),
            'icons' => $image_name
        ]);
        return redirect()->route('admin-forum-list');
    }
}
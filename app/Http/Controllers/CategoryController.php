<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Category, Topic};

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::whereNull('parent_id')->with('forums')->get();
        return view('forum.categories.index', compact('categories'));
    }

    public function show($slug)
    {
        $category = Category::where('id', $slug)->whereNotNull('parent_id')->firstOrFail();
        $topics = Topic::whereCategoryId($category->id)->with(['user' => function($query) {
          $query->select('id', 'name');
        }])->simplePaginate(15);

        return view('forum.categories.show', compact('category', 'topics'));
    }

    private function validateCategory()
    {
        $this->validate(request(), [
            'name' => 'required|min:3|max:25',
            'category_description' => 'nullable|max:145'
        ]);
    }

    private function validateSubcategory()
    {
        $this->validate(request(), [
            'name' => 'required|min:3|max:25',
            'category_description' => 'nullable|max:145',
            'parent_id' => 'integer',
            'category_slug' => 'required|alpha_dash'
        ]);
    }
}

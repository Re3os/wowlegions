<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cache;
use App\{Category, Topic};

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Cache::remember('category', "300", function () {
            return Category::whereNull('parent_id')->with('forums')->get();
        });

        return view('forum.categories.index', compact('categories'));
    }

    public function show($slug)
    {
        $category = Category::where('id', $slug)->whereNotNull('parent_id')->firstOrFail();
        $topics = Topic::whereCategoryId($category->id)->orderBy('sticky', 'DESC')->orderBy('created_at', 'DESC')->with(['user' => function($query) {
          $query->select('id', 'name', 'role');
        }])->paginate(30);

        return view('forum.categories.show', compact('category', 'topics'));
    }

}
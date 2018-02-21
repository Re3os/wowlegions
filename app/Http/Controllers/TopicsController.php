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


    public function search(Request $request) {
        $q = $request->input('q');
        $max_page = 1;
        $results = $this->searchForum($q, $max_page);
        return view('forum.search', [
            'include' => 'search.table',
            'result' => $results,
        ])->render();
    }

   public function searchForum($q, $count){
        $query = mb_strtolower($q, 'UTF-8');
        $arr = explode(" ", $query);
        $query = [];
        foreach ($arr as $word)
        {
            $len = mb_strlen($word, 'UTF-8');
            switch (true)
            {
                case ($len <= 3):
                {
                    $query[] = $word . "*";
                    break;
                }
                case ($len > 3 && $len <= 6):
                {
                    $query[] = mb_substr($word, 0, -1, 'UTF-8') . "*";
                    break;
                }
                case ($len > 6 && $len <= 9):
                {
                    $query[] = mb_substr($word, 0, -2, 'UTF-8') . "*";
                    break;
                }
                case ($len > 9):
                {
                    $query[] = mb_substr($word, 0, -3, 'UTF-8') . "*";
                    break;
                }
                default:
                {
                    break;
                }
            }
        }
        $query = array_unique($query, SORT_STRING);
        $qQeury = implode(" ", $query);
        $results = Topic::whereRaw("MATCH(title,content) AGAINST(? IN BOOLEAN MODE)", $qQeury)->paginate($count) ;
        return $results;
    }
}
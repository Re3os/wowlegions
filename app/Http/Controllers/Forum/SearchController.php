<?php

namespace App\Http\Controllers\Forum;

use App\Http\Controllers\Controller;

use App\Forum\Thread;

class SearchController extends Controller
{

    public function search() {
        $q = request('q');
        $max_page = 10;
        $results = $this->searchForum($q, $max_page);
        return view('forum.search', [
            'result' => $results,
        ])->render();
    }

   public function searchForum($q, $count){
        $query = mb_strtolower($q, 'UTF-8');
        $results = Thread::where('title','LIKE','%'.$query.'%')->orWhere('body','LIKE','%'.$query.'%')->paginate($count);
        return $results;
    }
}
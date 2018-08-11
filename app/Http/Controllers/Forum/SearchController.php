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
        $results = Thread::whereRaw("MATCH(title,body) AGAINST(? IN BOOLEAN MODE)", $qQeury)->paginate($count);
        return $results;
    }
}
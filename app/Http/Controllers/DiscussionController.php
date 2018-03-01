<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Comment;
use App\Blog;

class DiscussionController extends Controller {

    public function loadComments($id) {
        $post = Blog::where('id', $id)->first();
        if($post){
            $comments = $post->comments;
            $com = $comments->groupBy('parent_id')->sortByDesc('created_at');
        } else $com = false;
        return view('discussion.loadComments', ['com' => $com, 'count' => $comments->count()]);
    }

    public function commentJson($id) {
            Comment::create([
                'post_id' => $id,
                'user_id' => \Auth::user()->id,
                'blog_id' => $id,
                'text' => request('detail'),
                'parent_id'  => request('replyCommentId')
            ]);

            $result = array(
                "commentId" => $id,
                "articleId" => $id,
            );
            return response()->json($result);
    }

}
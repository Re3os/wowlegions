<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\{Comment, Blog, Characters};

class DiscussionController extends Controller {

    public function isCharacterEligible() {
        $response = Characters::verifyEligibility($_REQUEST['character'], $_REQUEST['service']);
        return response()->json($response);
    }

    public function pin($characters) {
        $user = \Auth::user();
        $user->charactersActive = $characters;
        $user->save();
    }

    public function version() {
        $result = array(
            "version" => '26124',
        );
        //return response()->json($result);
        echo 26124;
    }

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
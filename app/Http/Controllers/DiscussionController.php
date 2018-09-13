<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\{Comment, Blog, Characters};

class DiscussionController extends Controller {

    public function locales() {
        echo '{"locales":["ru-ru","en-gb","de-de","en-us","es-es","es-mx","fr-fr","it-it","pt-br","pl-pl","ko-kr","th-th","ja-jp","zh-tw"]}';
    }

    public function loadNoop() {
        echo '""';
    }

    public function notificationsList() {
        echo '{}';
    }

    public function notifications() {
        echo '{"totalNotifications":1,"notifications":[{"id":1894440545,"title":"Добро пожаловать","content":"Join the fight for the future now! Play Overwatch&#174; Free May 25-28 on PC, PlayStation&#174;4, or Xbox One! A PS Plus account is not required for PlayStation&#174;4 players.","httpLink":{"link":"https://playoverwatch.com/free-trial","content":"Learn More"},"img":{"mediaId":20817995,"url":"//bnetcmsus-a.akamaihd.net/cms/content_entry_media/po/PODTB474PHM81495814269940.PNG","mimeType":"image/png","type":"fullsize","size":4348,"width":100,"height":50,"originalFileName":"FreeWeekend-May2017_OW_WebNavIcon_JP.PNG","mediaType":13}}]}';
    }

    public function isCharacterEligible() {
        $response = Characters::verifyEligibility($_REQUEST['character'], $_REQUEST['service']);
        return response()->json($response);
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
        return view('discussion.loadComments', ['id' => $id, 'com' => $com, 'count' => $comments->count()]);
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
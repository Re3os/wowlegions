<?php

namespace App\Http\Controllers\Forum;

use App\Http\Controllers\Controller;

use App\Forum\Reply;
use App\Forum\Thread;
use App\Services\ParserText;

class RepliesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => 'index']);
    }


    public function index($channelId, Thread $thread)
    {
        return $thread->replies()->paginate(20);
    }

    public function store(Thread $thread)
    {
        if ($thread->locked) {
            return response('Thread is locked', 422);
        }

        $bb = new ParserText();

        $thread->addReply([
            'parent_id' => $thread->id,
            'body' => $bb->bb_parse(request('detail')),
            'user_id' => auth()->id(),
            'channel_id' => $thread->channel_id
        ])->load('creator');

        return back();
    }

    public function update(Reply $reply)
    {
        $this->authorize('update', $reply);

        $reply->update(request()->validate(['body' => 'required|spamfree']));
    }

    public function destroy(Reply $reply)
    {
        $this->authorize('update', $reply);

        $reply->delete();

        if (request()->expectsJson()) {
            return response(['status' => 'Reply deleted']);
        }

        return back();
    }
}

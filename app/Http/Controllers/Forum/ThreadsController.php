<?php

namespace App\Http\Controllers\Forum;

use App\Http\Controllers\Controller;

use App\Forum\Channel;
use App\Filters\ThreadFilters;
use App\Forum\Thread;

class ThreadsController extends Controller
{
    /**
     * Create a new ThreadsController instance.
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function up($id) {
        $thead = Thread::where('id', $id)->increment('up');
        return response()->json([
            'toggleRankMode' => 1
        ]);
    }

    public function down($id) {
        $thead = Thread::where('id', $id)->increment('down');
        if (request()->wantsJson()) {
            return response($thead, 200);
        }
    }

    public function edit($id) {
        $thead = Thread::where('id', $id)->update(['body' => request('detail')]);
        return response()->json([
            'detail' => request('detail')
        ]);
    }

    public function frag($id) {
        $thread = Thread::where('id', $id)->firstOrFail();
        return response()->json([
            'name' => $thread->id,
            'detail' => $thread->body
        ]);
    }

    public function index(Channel $channel, ThreadFilters $filters)
    {
        $threads = $this->getThreads($channel, $filters);

        if (request()->wantsJson()) {
            return $threads;
        }

        return view('forum.categories.show', [
            'threads' => $threads
        ]);
    }

    public function store()
    {
        request()->validate([
            'subject' => 'required',
            'messages' => 'required'
        ]);

        $thread = Thread::create([
            'user_id' => auth()->id(),
            'channel_id' => request('channel_id'),
            'title' => request('subject'),
            'body' => request('messages')
        ]);

        if (request()->wantsJson()) {
            return response($thread, 201);
        }

        return redirect($thread->path())
            ->with('flash', 'Your thread has been published!');
    }

    public function show($slug)
    {
        if (auth()->check()) {
            auth()->user()->read($slug);
        }
        $thread = Thread::where('id', $slug)->whereNull('parent_id')->firstOrFail();
        $topics = Thread::whereParentId($thread->id)->paginate(10);
        return view('forum.categories.topic', compact('thread', 'topics'));
    }

    public function update($channel, Thread $thread)
    {
        $this->authorize('update', $thread);

        $thread->update(request()->validate([
            'title' => 'required',
            'body' => 'required'
        ]));

        return $thread;
    }

    public function delete($topic)
    {
        $delete = Thread::where('id', $topic)->delete();

        if (request()->wantsJson()) {
            return response([], 204);
        }
        return response([], 200);
    }

    protected function getThreads(Channel $channel, ThreadFilters $filters)
    {
        $threads = Thread::latest()->filter($filters);

        if ($channel->exists) {
            $threads->where('channel_id', $channel->id);
        }

        return $threads->paginate(25);
    }
}

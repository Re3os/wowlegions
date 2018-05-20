<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\{Bugtracker, CommentBugtracker};
use App\Services\Server;

class CommunityController extends Controller
{

    public function Communityindex() {
        return view('community.index');
    }

    public function CommunityStatus() {
        $status = Server::status();
        $online = Server::playersOnline();
        return view('community.status.status', ['server' => $status, 'online' => $online]);
    }

    public function bugtrackerIndex() {
        $bugtracker = Bugtracker::orderBy('created_at', 'desc')->paginate(20);
        return view('community.bugtracker.bugtrackerIndex', ['bug' => $bugtracker]);
    }

    public function bugtrackerCreate() {
        return view('community.bugtracker.bugtrackerCreate');
    }

    public function bugtrackerView($id) {
        $bug = Bugtracker::where('id', $id)->firstOrFail();
        return view('community.bugtracker.bugtrackerView', ['bug' => $bug]);
    }

    public function bugtrackerCommentEdit($id) {
        $bug = CommentBugtracker::where('id', $id)->firstOrFail();
        return view('community.bugtracker.bugtrackerCommentEdit', ['bug' => $bug]);
    }

    public function bugtrackerCommentSubmit(Request $request) {
        CommentBugtracker::where('id', $request->get('id'))->update(['text' => $request->get('comment')]);
        return redirect()->route('bugtracker-view', [$request->get('issue_id')]);
    }

    public function bugtrackerComment(Request $request) {
        CommentBugtracker::create([
          'bugtracker_id'       => $request->get('issue_id'),
          'user_id'  => \Auth::user()->id,
          'text'  => $request->get('comment')
        ]);
        return redirect()->route('bugtracker-view', [$request->get('issue_id')]);
    }

    public function bugtrackerSubmit(Request $request) {
        $topic = Bugtracker::create([
          'title'       => $request->get('title'),
          'cat'     => $request->get('cat'),
          'subcat'  => $request->get('subcat'),
          'proprity'  => $request->get('priority'),
          'full_text'  => $request->get('issue'),
          'user_id'  => \Auth::user()->id
        ]);

        return redirect()->route('bugtracker-view', [$topic->id]);
    }
}

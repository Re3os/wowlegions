<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\{Bugtracker, CommentBugtracker, Arena};
use App\Services\Server;

class CommunityController extends Controller
{

    public function CommunityReturn() {
        return view('community.return');
    }

    public function recruitAFriend() {
        return view('community.recruitAFriend');
    }

    public function CommunityStart() {
        return view('community.start');
    }

    public function CommunityStatus() {
        $status = Server::status();
        $online = Server::playersOnline();
        return view('community.status.status', ['server' => $status, 'online' => $online]);
    }

    public function leaderboardsTwo() {
        $arena = Arena::where('type', '1')->orderBy('rating', 'desc')->get();
        return view('community.pvp.2x2', ['arena' => $arena]);
    }

    public function leaderboardsTree() {
        $arena = Arena::where('type', '1')->orderBy('rating', 'desc')->get();
        return view('community.pvp.3x3', ['arena' => $arena]);
    }

    public function battlegrounds() {
        $status = Server::status();
        $online = Server::playersOnline();
        return view('community.pvp.battlegrounds', ['server' => $status, 'online' => $online]);
    }
}

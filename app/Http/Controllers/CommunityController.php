<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\{Bugtracker, CommentBugtracker};
use App\Services\Server;

class CommunityController extends Controller
{

    public function CommunityReturn() {
        return view('community.return');
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
        $status = Server::status();
        $online = Server::playersOnline();
        return view('community.pvp.2x2', ['server' => $status, 'online' => $online]);
    }

    public function leaderboardsTree() {
        $status = Server::status();
        $online = Server::playersOnline();
        return view('community.pvp.3x3', ['server' => $status, 'online' => $online]);
    }

    public function battlegrounds() {
        $status = Server::status();
        $online = Server::playersOnline();
        return view('community.pvp.battlegrounds', ['server' => $status, 'online' => $online]);
    }
}

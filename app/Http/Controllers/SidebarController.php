<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\Server;
use App\Topic;

class SidebarController extends Controller
{
    public function SidebarStatus() {
        $status = Server::status();
        return view('sidebar.status', ['server' => $status]);
    }

    public function SidebarClient() {
        return view('sidebar.client');
    }

    public function SidebarEvents() {
        return view('sidebar.events');
    }

    public function SidebarForum() {
        $forum = Topic::with('category')->orderBy('created_at', 'desc')->get();
        return view('sidebar.forum', ['forum' => $forum]);
    }
}

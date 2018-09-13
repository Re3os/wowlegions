<?php

namespace App\Http\Controllers;
use App\User;
use App\Invite;
use App\Mail\InviteCreated;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class InviteController extends Controller
{

    public function invite() {
        return view('profiles.invite', [
            'profileUser' => \Auth::user()
        ]);
    }

    public function process(Request $request) {
        do {
            $token = str_random();
        }
        while (Invite::where('token', $token)->first());
        $invite = Invite::create([
            'email' => $request->get('email'),
            'invite_user' => \Auth::user()->name,
            'token' => $token
        ]);
        Mail::to($request->get('email'))->send(new InviteCreated($invite));
        return redirect()->back()->with("success","Ваше приглашение успешно отправлено.");
    }

    public function accept(Request $request) {
        if (!$invite = Invite::where('token', $request->get('token'))->first()) {
            abort(404);
        }
        return view('auth.invite', [
            'email' => $invite->email
        ]);
    }
}

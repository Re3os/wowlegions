<?php

namespace App\Http\Controllers;

use App\Account;
use App\Activity;
use App\Characters;
use App\User;

class ProfilesController extends Controller
{

    public function activity(User $user) {
        return view('profiles.activity', [
            'profileUser' => $user,
            'activities' => Activity::feed($user)
        ]);
    }

    public function show(User $user) {
        return view('profiles.show', [
            'profileUser' => $user,
            'char' => Characters::userCharactersList(Account::userGameID($user->email)[0]->id)
        ]);
    }
}

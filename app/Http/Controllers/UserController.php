<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Category, Topic, Account};

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showProfile() {
        return view('profiles.showProfile', [
            'profileUser' => \Auth::user(),
            'userGamrAccount' => Account::userGameAccount(),
        ]);
    }

    public function showWallet() {
        return view('profiles.showWallet', [
            'profileUser' => \Auth::user(),
            'userGamrAccount' => Account::userGameAccount(),
        ]);
    }

    public function changeEmail() {
        return view('profiles.settings.changeEmail', [
            'profileUser' => \Auth::user(),
            'userGamrAccount' => Account::userGameAccount(),
        ]);
    }

    public function changeEmailActoin(Request $request){
        if (!(\Hash::check($request->get('password'), \Auth::user()->password))) {
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }
        if($request->get('email') != $request->get('newEmailVerify')){
            return redirect()->back()->with("error","Mail does not match");
        }

        $validatedData = $request->validate([
            'email' => 'required|email',
        ]);

        $user = \Auth::user();

        $account = Account::newEmail($user->email, $request->get('email'));

        //Change Email
        $user->email = $request->get('email');
        $user->save();

        return redirect()->back()->with("success","Email changed successfully!");

    }

    public function changePassword() {
        return view('profiles.settings.changePassword', [
            'profileUser' => \Auth::user(),
            'userGamrAccount' => Account::userGameAccount(),
        ]);
    }

    public function changePasswordActoin(Request $request){
        if (!(\Hash::check($request->get('oldPassword'), \Auth::user()->password))) {
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }
        if(strcmp($request->get('oldPassword'), $request->get('newPassword')) == 0){
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }
        if($request->get('newPassword') != $request->get('newPasswordVerify')){
            return redirect()->back()->with("error","Passwords do not match");
        }

        $validatedData = $request->validate([
            'oldPassword' => 'required',
            'newPassword' => 'required|string|min:6',
        ]);

        //Change Password
        $user = \Auth::user();
        $user->password = bcrypt($request->get('newPassword'));
        $user->save();

        $account = Account::newPassword($user->email, $request->get('newPassword'));

        return redirect()->back()->with("success","Password changed successfully !");

    }
}
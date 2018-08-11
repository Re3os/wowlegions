<?php

namespace App\Http\Controllers\Auth;

use App\Mail\PleaseConfirmYourEmail;
use App\{Account, User};
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed'
        ]);
    }

    protected function create(array $data) {
        $passwordHash = strtoupper(bin2hex(strrev(hex2bin(strtoupper(hash("sha256",strtoupper(hash("sha256", strtoupper($data['email'])).":".strtoupper($data['password']))))))));

        return User::forceCreate([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $passwordHash,
            'password_game' => $data['password'],
            'balance' => '0',
            'question' => $data['question1'],
            'answer' => $data['answer1'],
            'receive' => $data['receiveNewsSpecialOffersThirdParty'],
            'confirmation_token' => str_limit(md5($data['email'] . str_random()), 25, '')
        ]);
    }

    protected function registered(Request $request, $user) {
        Mail::to($user)->send(new PleaseConfirmYourEmail($user));
    }
}
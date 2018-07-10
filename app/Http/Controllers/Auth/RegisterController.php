<?php

namespace App\Http\Controllers\Auth;

use App\{Account, User};
use App\Http\Controllers\Controller;
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
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'avatar' => 'image|dimensions:max_width=150,max_height=150'
        ]);
    }

    protected function create(array $data) {
        //$path = $data['avatar']->store('public/uploads/avatar') . "?alt=";
        $image_name = $data['avatar']->getClientOriginalName();
        $path = $data['avatar']->move(public_path('uploads/avatar/'), $image_name);
        Account::createBattleNet($data);
        $passwordHash = strtoupper(bin2hex(strrev(hex2bin(strtoupper(hash("sha256",strtoupper(hash("sha256", strtoupper($data['email'])).":".strtoupper($data['password']))))))));

        return User::create([
            'email' => $data['email'],
            'password' => $passwordHash,
            'balance' => '0',
            'question' => $data['question1'],
            'answer' => $data['answer1'],
            'receive' => $data['receiveNewsSpecialOffersThirdParty'],
            'avatar' => $image_name,
        ]);
    }
}
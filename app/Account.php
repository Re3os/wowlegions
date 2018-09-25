<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Account extends Authenticatable {

    protected $connection = 'auth';

    protected $table = 'account';

    protected $fillable = [
        'username', 'password', 'email', 'expansion'
    ];

    use Notifiable;

    public static function createBattleNet($data) {
        $accountBnet = \DB::connection('auth')->table('battlenet_accounts')->insert(['email' => $data['email'], 'sha_pass_hash' => $data['password'], 'last_login' => date("Y-m-d H:i:s")]);
        $bnetInfo = \DB::connection('auth')->table('battlenet_accounts')->where('email', $data['email'])->first();
        $passwordHashAccount = sha1(strtoupper($bnetInfo->id) . '#1'.  ":" . strtoupper($data['password_game']));
        $accountGame = \DB::connection('auth')->table('account')->insert(['username' => $bnetInfo->id.'#1', 'sha_pass_hash' => $passwordHashAccount, 'email' => $data['email'], 'reg_mail' => $data['email'], 'last_login' => date("Y-m-d H:i:s"), 'expansion' => '7', 'battlenet_account' => $bnetInfo->id, 'battlenet_index' => '1']);
    }

    public static function newPassword($user, $password) {
        $passwordHash = strtoupper(bin2hex(strrev(hex2bin(strtoupper(hash("sha256",strtoupper(hash("sha256", strtoupper($user)).":".strtoupper($password))))))));
        $accountBnet = \DB::connection('auth')->table('battlenet_accounts')->where('email', $user)->update(['sha_pass_hash' => $passwordHash]);
        $bnetInfo = \DB::connection('auth')->table('battlenet_accounts')->where('email', $user)->first();
        $passwordHashAccount = sha1(strtoupper($bnetInfo->id) . '#1'.  ":" . strtoupper($password));
        $accountGame = \DB::connection('auth')->table('account')->where('email', $user)->update(['sha_pass_hash' => $passwordHashAccount]);
        return true;
    }

    public static function newEmail($user, $email) {
        $accountBnet = \DB::connection('auth')->table('battlenet_accounts')->where('email', $user)->update(['email' => $email]);
        $accountGame = \DB::connection('auth')->table('account')->where('email', $user)->update(['email' => $email]);
        return true;
    }

    public static function userGameID($email) {
        return \DB::connection('auth')->table('account')->where('email', '=', $email)->get();
    }

    public static function userGameAccount() {
        return \DB::connection('auth')->table('account')->where('email', '=', \Auth::user()->email)->get();
    }

    public static function userGameCharacters($id) {
        return \DB::connection('characters')->table('characters')->where('account', '=', $id)->get();
    }

    public static function banedUser() {
        return \DB::connection('auth')->table('account_banned')->where('active', '=', 1)->count();
    }
}
<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;

use App\Mail\MailPasswordReset;
use DB;

class User extends Authenticatable {

    use Notifiable;

    protected $fillable = [
        'name', 'name_id', 'email', 'password', 'balance', 'role', 'is_admin',
    ];

    protected $hidden = [
        'remember_token',
    ];

    public function sendPasswordResetNotification($token)
    {
        \Mail::to($_POST['email'])->send(new MailPasswordReset($token));
    }
    
    public function comments() {
        return $this->belongsTo(Comment::class);
    }

    public function topics() {
        return $this->hasMany(Topic::class);
    }

    public function replies() {
        return $this->hasMany(Reply::class);
    }

    protected function getPostsCountAttribute() {
        return $this->topics->count() + $this->replies->count();
    }

    public static function createNameID($email, $tagName) {
        $tagNameID = 1;
        if(!self::isTagName($tagName)) {
            $tagNameID = self::getLastTagNameID($tagName);
        }
        self::updateUsersTagName($email, $tagName, $tagNameID);
        return array('tag' => $tagName, 'id' => $tagNameID);
    }

    private static function isTagName($tagName) {
        $name_id = DB::table('users')->select('name')->where('name', '=', $tagName)->get();
        if($name_id->count() > 0) {
            return true;
        } else {
            return false;
        }
    }

    private static function getLastTagNameID($tagName) {
        $name_id = DB::table('users')->select(DB::raw('MAX(name_id)+1 as new_id'))->where('name', '=', $tagName)->get();
        return $name_id[0]->new_id;
    }

    private static function updateUsersTagName($email, $tagName, $user_id) {
        $data = DB::table('users')->where('email', $email)->update(['name' => $tagName, 'name_id' => $user_id]);
        return true;
    }

    public static function SetBalance($UserID, $Balance) {
        $data = DB::table('users')->where('id', $UserID)->update(['balance' => $Balance]);
        return true;
    }

}
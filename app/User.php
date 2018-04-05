<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use \DB;

class User extends Authenticatable {

    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'balance', 'role',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
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

    public static function createNameID($email, $user) {
        $tagNameID = 1;
        if(!self::isTagNameFree($user)) {
            $tagNameID = self::getLastTagNameID($user);
        }
        self::updateUsersTagName($email, $tagNameID);
        return array('tag' => $user, 'id' => $tagNameID);
    }

    private static function isTagNameFree($user) {
        $name_id = DB::table('users')->select('name')->where('name', '=', $user)->get();
        if($name_id->count() > 0) {
            return false;
        } else {
            return true;
        }
    }

    private static function getLastTagNameID($user) {
        $name_id = DB::table('users')->select(DB::raw('MAX(name_id)+1 as new_id'))->where('name', '=', $user)->get();
        return $name_id[0]->new_id;
    }

    private static function updateUsersTagName($email, $user_id) {
        $data = DB::table('users')->where('email', $email)->update(['name_id' => $user_id]);
        return true;
    }

}
<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Carbon\Carbon;
use App\Mail\MailPasswordReset;
use DB;
use App\Forum\Thread;
use App\Forum\Reply;

class User extends Authenticatable {

    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'avatar',
        'balance',
        'role',
        'is_admin',
        'question',
        'receive',
        'answer'
    ];

    protected $hidden = [
        'remember_token',
    ];

    protected $casts = [
        'confirmed' => 'boolean'
    ];

    public function getRouteKeyName()
    {
        return 'name';
    }

    public function getAvatarPathAttribute($avatar)
    {
        return asset($avatar ?: 'images/avatars/default.png');
    }

    public function confirm() {
        $this->confirmed = true;
        $this->confirmation_token = null;
        $this->save();
    }

    public function sendPasswordResetNotification($token) {
        \Mail::to($_POST['email'])->send(new MailPasswordReset($token));
    }

    public function comments() {
        return $this->belongsTo(Comment::class);
    }

    public function topics() {
        return $this->hasMany(Thread::class);
    }

    protected function getPostsCountAttribute() {
        return $this->topics->count();
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

    public function read($thread) {
        cache()->forever(
            $this->visitedThreadCacheKey($thread),
            Carbon::now()
        );
    }

    public function visitedThreadCacheKey($thread) {
        return sprintf("users.%s.visits.%s", $this->id, $thread);
    }
}
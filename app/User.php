<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {

    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'balance',
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
}
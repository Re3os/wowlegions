<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Invite extends Model {

    protected $fillable = [
        'email',
        'invite_user',
        'token'
    ];
    protected $with = ['user'];

    public function user() {
        return $this->hasMany(User::class, 'email', 'email');
    }
}
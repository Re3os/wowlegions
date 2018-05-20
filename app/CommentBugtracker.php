<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;

class CommentBugtracker extends Model {

    protected $fillable = ['bugtracker_id', 'user_id', 'text', 'created_at', 'updated_at'];

    protected $connection = 'mysql';

    public function user() {
        return $this->belongsTo(User::class);
    }

}
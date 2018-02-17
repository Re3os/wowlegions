<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;

class Comment extends Model {

    protected $fillable = ['post_id', 'user_id', 'blog_id', 'text', 'replied_to'];

    protected $connection = 'mysql';

    public function user() {
        return $this->belongsTo(User::class);
    }

}
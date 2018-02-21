<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;

class Comment extends Model {

    protected $fillable = ['post_id', 'user_id', 'blog_id', 'text', 'replied_to', 'created_at', 'updated_at'];

    protected $connection = 'mysql';

    public function user() {
        return $this->belongsTo(User::class);
    }

}
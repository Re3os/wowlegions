<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;

class Comment extends Model {

    protected $fillable = ['post_id', 'user_id', 'blog_id', 'text', 'parent_id', 'created_at', 'updated_at'];
    protected $with = ['user'];
    protected $connection = 'mysql';

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

}
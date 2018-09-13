<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Traits\ {StringManipulation, TimezoneAccessor};

use App\{User, Comment};

class Blog extends Model
{

    protected $fillable = ['title', 'desc_blog', 'full_blog', 'id', 'posted_by', 'images', 'comments_key'];

    protected $dateFormat = 'Y-m-d H:i:s';

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function user() {
        return $this->belongsTo(User::class, 'posted_by', 'id');
    }

    public function setContentAttribute($value) {
        $this->attributes['full_blog'] = trim($value);
    }

}
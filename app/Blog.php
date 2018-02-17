<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Traits\ {StringManipulation, TimezoneAccessor};

use App\{User, Comment};

class Blog extends Model
{

    protected $fillable = ['title', 'short_description', 'full_description', 'id', 'posted_by'];

    protected $dateFormat = 'Y-m-d H:i:s';

    public function comments()
    {
     return $this->hasMany(Comment::class );
    }

    public function user() {
        return $this->belongsTo(User::class, 'posted_by', 'id');
    }

    public function setContentAttribute($value) {
        $this->attributes['full_description'] = trim($value);
    }

}
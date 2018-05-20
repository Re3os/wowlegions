<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Traits\ {StringManipulation, TimezoneAccessor};

class Bugtracker extends Model
{

    protected $fillable = ['title', 'cat', 'vote', 'subcat', 'status', 'proprity', 'closed', 'full_text', 'user_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
     return $this->hasMany(CommentBugtracker::class );
    }

}
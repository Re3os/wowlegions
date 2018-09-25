<?php

namespace App\Forum;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Pathnotes extends Model
{

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function mentionedUsers()
    {
        preg_match_all('/@([\w\-]+)/', $this->body, $matches);

        return $matches[1];
    }

    public function setBodyAttribute($body)
    {
        $this->attributes['body'] = preg_replace(
            '/@([\w\-]+)/',
            '<a href="/profiles/$1">$0</a>',
            $body
        );
    }

}
<?php

namespace App\Forum;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function threads()
    {
        return $this->hasMany(Thread::class);
    }

    public function forums()
    {
        return $this->hasMany(Channel::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Thread::class, 'parent_id');
    }
}

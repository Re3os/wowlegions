<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\StringManipulation;

class Topic extends Model
{
    use StringManipulation;

    protected $connection = 'mysql';

    protected $fillable = ['title', 'content', 'user_id', 'characters_id', 'category_id', 'closed', 'sticky'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function characters() {
        return $this->belongsTo(Characters::class, 'characters_id', 'guid');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

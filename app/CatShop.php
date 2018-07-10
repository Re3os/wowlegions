<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatShop extends Model
{
    protected $connection = 'mysql';

    protected $fillable = ['id', 'title', 'description', 'key', 'order'];

    public function shop()
    {
        return $this->hasMany(Shop::class, 'category_id');
    }

}

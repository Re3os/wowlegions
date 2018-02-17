<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $connection = 'mysql';

    protected $fillable = ['id', 'name', 'category_description', 'parent_id', 'category_slug', 'icons'];  

    public function forums()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }
}

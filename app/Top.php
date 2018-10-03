<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Top extends Model {

    protected $connection = 'mysql';

    protected $fillable = ['id', 'topname', 'toplink', 'reward', 'topaward'];

    public $timestamps = false;

}
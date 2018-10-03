<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usertop extends Model
{

    protected $fillable = ['topid', 'user', 'votetime', 'usertop'];

    public $timestamps = false;

}
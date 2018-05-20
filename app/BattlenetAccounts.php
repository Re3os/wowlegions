<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BattlenetAccounts extends Model {

    protected $connection = 'auth';

    protected $fillable = [
        'email', 'password', 'expansion'
    ];

    protected $hidden = [
        'sha_pass_hash',
    ];
    protected $dates = ['last_login'];

    public $timestamps = false;

    public static function boot()
    {
        parent::boot();

        static::creating( function ($model) {
            $model->attributes['last_login'] = $model->freshTimestamp();
        });
    }

    public function getRememberTokenName()
    {
      return null;
    }

    protected function setPasswordAttribute($value)
    {
        $this->attributes['sha_pass_hash'] = strtoupper(bin2hex(strrev(hex2bin(strtoupper(hash("sha256",strtoupper(hash("sha256", strtoupper($this->attributes['username'])).":".strtoupper($value))))))));
    }
}
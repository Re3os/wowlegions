<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentDetails extends Model {

    protected $connection = 'mysql';

    protected $fillable = ['userid', 'service', 'item_name', 'price', 'digital_key', 'status'];

}
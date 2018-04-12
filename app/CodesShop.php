<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CodesShop extends Model {

    protected $connection = 'mysql';

    protected $fillable = ['purchased_item', 'purchase_code', 'purchase_date', 'purchased_for_account', 'code_activated'];

    public static function generateItemCode() {
        $tokens = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $segment_chars = 7;
        $num_segments = 8;
        $key_string = '';

        for ($i = 0; $i < $num_segments; $i++)
        {
            $segment = '';
            for ($j = 0; $j < $segment_chars; $j++)
                $segment .= $tokens[rand(0, 35)];
            $key_string .= $segment;
            if ($i < ($num_segments - 1))
                $key_string .= '-';
        }

        return $key_string;
    }

}
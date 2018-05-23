<?php

namespace App\Services;

use Illuminate\Support\Facades\{Cache, DB};

class Item {

    public function LoadSsd($data) {
        return DB::connection('mysql')->table('ssd')->where('entry', $data)->get();
    }

    public function LoadSsv($data) {
        return DB::connection('mysql')->table('ssv')->where('level', $data)->get();
    }
}
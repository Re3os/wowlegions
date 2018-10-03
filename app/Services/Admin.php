<?php

namespace App\Services;

use Illuminate\Support\Facades\{Cache, DB};

class Admin {

    public function infoEnv() {
        $file = file_get_contents(__DIR__.'/../../.env');
        $out = implode("\n", preg_replace('/(?:(?:25[0-5]|2[0-4]\d|[01]?\d\d?)\.){3}(?:25[0-5]|2[0-4]\d|[01]?\d\d?):(\d+)/', 'IP: $0, Port: $1', explode("\n", $file)));
        dd($out);
        return $out;
    }
}
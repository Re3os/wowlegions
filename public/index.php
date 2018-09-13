<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

if (file_exists(__DIR__.'/../install_files') && ! file_exists(__DIR__.'/../.env')) {
    require_once __DIR__.'/../install_files/install.php';
    exit;
}

define('LARAVEL_START', microtime(true));
define('CACHE', dirname(__DIR__) . '/storage/framework/cache/data');

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);

getNotLicense();
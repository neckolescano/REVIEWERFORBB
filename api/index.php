<?php
// Set the root directory
$root = __DIR__ . '/..';

// Load composer autoloader
require_once $root . '/vendor/autoload.php';

// Initialize Laravel application
$app = require_once $root . '/bootstrap/app.php';

// Handle the request
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);
$response->send();
$kernel->terminate($request, $response);
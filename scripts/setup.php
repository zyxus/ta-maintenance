<?php

// Runs after composer install. Safe to run again; never replaces an existing key.
$root = dirname(__DIR__);
foreach (['bootstrap/cache', 'storage/framework/cache/data', 'storage/framework/sessions', 'storage/framework/views', 'storage/logs'] as $dir) {
    $path = $root.'/'.$dir;
    if (!is_dir($path) && !mkdir($path, 0775, true) && !is_dir($path)) {
        throw new RuntimeException('Cannot create directory: '.$path);
    }
}
$envPath = $root.'/.env';
if (!file_exists($envPath) && !copy($root.'/.env.example', $envPath)) {
    throw new RuntimeException('Cannot create .env');
}
$env = file_get_contents($envPath);
if ($env === false) {
    throw new RuntimeException('Cannot read .env');
}
if (preg_match('/^APP_KEY=(?:[ \t]*|""|\'\')[ \t]*\r?$/m', $env)) {
    $env = preg_replace('/^APP_KEY=.*$/m', 'APP_KEY=base64:'.base64_encode(random_bytes(32)), $env);
    if (file_put_contents($envPath, $env) === false) {
        throw new RuntimeException('Cannot write APP_KEY to .env');
    }
}
echo "Environment ready. Set APP_URL in .env before deploying.\n";

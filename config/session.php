<?php
return [
    'driver' => env('SESSION_DRIVER', 'file'),//The file driver is used by default, you can configure it in .env
    'lifetime' => 120,//Cache invalidation time
    'expire_on_close' => false,
    'encrypt' => false,
    'files' => storage_path('framework/session'),//file cache save path
    'connection' => null,
    'table' => 'sessions',
    'lottery' => [2, 100],
    'cookie' => 'laravel_session',
    'path' => '/',
    'domain' => null,
    'secure' => false,
];

<?php

return [
    'driver' => 'array',
    'lifetime' => 120,
    'encrypt' => false,
    'files' => storage_path('framework/sessions'),
    'cookie' => 'technoavia_session',
    'path' => '/',
    'http_only' => true,
    'same_site' => 'lax',
];

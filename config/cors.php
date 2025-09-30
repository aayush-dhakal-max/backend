<?php

return
    [
        'paths' => ['api/*', 'sanctum/csrf-cookie'],
        'allowed_origins' => ['*'],
        'allowed_origins_patterns' => [],
        'allowed_headers' => ['*'],
        'allowed_methods' => ['*'],
        'exposed_headers' => [],
        'supports_credentials' => false,
    ];
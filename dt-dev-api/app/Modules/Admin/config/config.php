<?php

return [
    'auth' => [
        'expires' => [
            'access_token' => 60 * 24, // minutes,
            'refresh_token' => 60 * 24 * 7, // minutes
        ],
    ],
    'per_page' => 100,
];

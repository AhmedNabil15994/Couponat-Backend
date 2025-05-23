<?php

return [
    'dashboard' => [
        'auth' => [
            'web',
            'localeSessionRedirect',
            'localizationRedirect',
            'localeViewPath',
            'localize',
            'dashboard.auth',
            'check.permission',
            'last.login',
        ],
        'guest' => [
            'web',
            'localeSessionRedirect',
            'localizationRedirect',
            'localeViewPath',
            'localize',
        ]
    ],

    'frontend' => [
        'auth' => [
            'web',
            'localeSessionRedirect',
            'localizationRedirect',
            'localeViewPath',
            'localize',
            'auth:web',
        ],
        'guest' => [
            'web',
            'localeSessionRedirect',
            'localizationRedirect',
            'localeViewPath',
            'localize',
        ]
    ],

    'vendor' => [
        'auth' => [
            'web',
            'localeSessionRedirect',
            'localizationRedirect',
            'localeViewPath',
            'localize',
            'vendor.auth',
            'check.permission',
            'last.login',
        ],
        'guest' => [
            'web',
            'localeSessionRedirect',
            'localizationRedirect',
            'localeViewPath',
            'localize',
        ]
    ],

    'api' => [
        'auth' => [
            'api',
             'auth:sanctum',
        ],
        'guest' => [
            'api',
        ]
    ],
];

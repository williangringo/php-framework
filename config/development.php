<?php

return [
    'app'      => [
        'id'      => APP_ID,
        'temp'    => $container->params['app']['tmp'],
        'cpanels' => ['admin'],
        // Generate a new salt at: https://www.grc.com/passwords.htm
        'salt'    => 'oChmYEsPJM2FB6sdRhWKcyot49uxpzrAkmXxt5dhiufmtGr0Oo5jhA9Sl7gAm9F'
    ],
    'cache'    => [
        'apc'      => [
            'ttl'       => 3600,
            'namespace' => APP_ID
        ],
        'file'     => [
            'path' => $container->params['app']['tmp']
        ],
        'memcache' => [
            'servers' => [
                ['127.0.0.1', '11211']
            ]
        ],
        'redis'    => [
            'servers' => [
                ['127.0.0.1', '6379']
            ]
        ]
    ],
    'db'       => [
        'default' => [
            'driver'    => 'pgsql',
            'host'      => 'localhost',
            'database'  => 'test',
            'username'  => 'user',
            'password'  => 'pass',
            'charset'   => 'utf8',
            'collation' => 'utf8_general_ci'
        ]
    ],
    'dmi'      => [
        'enabled' => true,
        'users'   => [
            'admin' => 'admin'
        ]
    ],
    'log'      => [
        'level' => Monolog\Logger::DEBUG
    ],
    'mongo'    => [
        'dsn' => 'mongodb://localhost:27017/test'
    ],
    'session'  => [
        'options' => [
            'name' => 'APPSID'
        ]
    ],
    'template' => [
        'inject_prefix' => true,
        'prefix'        => [
            'mobile'  => 'm.',
            'tablet'  => 't.',
            'desktop' => ''
        ]
    ],
    'trans'    => [
        'default' => 'pt_BR'
    ],
    'twig'     => [
        'options' => [
            'debug'            => true,
            'cache'            => false,
            'auto_reload'      => true,
            'strict_variables' => false
        ],
        'paths'   => [
            APP_DIR . '/app/template'
        ]
    ]
];

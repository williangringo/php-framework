<?php

$temp = sprintf('%s/%s', $tmp, APP_ID);

if (!file_exists($temp)) {
    @mkdir($temp, 0775, true);
}

return [
    'app'     => [
        'id'   => APP_ID,
        'temp' => $temp
    ],
    'cache'   => [
        'apc'      => [
            'ttl'       => 3600,
            'namespace' => APP_ID
        ],
        'file'     => [
            'path' => $temp
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
    'db'      => [
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
    'log'     => [
        'level' => Monolog\Logger::NOTICE
    ],
    'mongo'   => [
        'dsn' => 'mongodb://localhost:27017/test'
    ],
    'session' => [
        'options' => [
            'name' => 'APPSID'
        ]
    ],
    'twig'    => [
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

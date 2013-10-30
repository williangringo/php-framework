<?php

return [
    'app'     => [
        'id' => 'my-app'
    ],
    'db'      => [
        'pgsql', 'host=localhost;dbname=test', 'user', 'pass'
    ],
    'log'     => [
        'level' => Monolog\Logger::DEBUG
    ],
    'session' => [
    ],
    'twig'    => [
        'options' => [
        ],
        'paths'   => [
        ]
    ]
];

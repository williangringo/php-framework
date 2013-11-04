<?php

include __DIR__ . '/../../init.php';
$config = container()->get('config')['db']['default'];

return array(
    'driver'   => 'pdo_' . $config['driver'],
    'host'     => $config['host'],
    'user'     => $config['username'],
    'password' => $config['password'],
    'dbname'   => $config['database']
);

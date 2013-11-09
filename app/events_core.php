<?php

//------------------------------------------------------------------------------------------------------
// Framework default events
//------------------------------------------------------------------------------------------------------
$events->addListener('kernel.route', function(\App\Event\KernelRoute $event) {

    $route = $event->getRoute();

    if (substr($route->name, 0, 3) !== 'dmi') {
        return;
    }

    $config = container()->get('config');

    if (!isset($config['dmi'])) {
        return;
    }

    if ($config['dmi']['enabled'] !== true) {
        container()->get('log')->addError('DMI not enabled');
        throw new \App\Exception\NotFound('Not found');
    }

    $authenticator = function($user, $pass) use ($config) {
        if (empty($user) || empty($pass)) {
            return false;
        }

        $users = $config['dmi']['users'];

        foreach ($users as $u => $p) {
            if ($user === $u && $pass === $p) {
                return true;
            }
        }

        return false;
    };

    (new \App\Middleware\Auth\HttpBasic($authenticator))->call();
});

<?php

//------------------------------------------------------------------------------------------------------
// Container initialization
//------------------------------------------------------------------------------------------------------
$container                = new \Aura\Di\Container(new \Aura\Di\Forge(new \Aura\Di\Config()));
$GLOBALS['app.container'] = $container;

/**
 * Service locator container (IoC, Dependency Injection, ...)
 * @return \Aura\Di\Container
 */
function container() {
    return $GLOBALS['app.container'];
}

include __DIR__ . '/container_core.php';
include __DIR__ . '/container_custom.php';

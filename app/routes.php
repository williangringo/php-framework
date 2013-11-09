<?php

//------------------------------------------------------------------------------------------------------
// Documentation for routing creation
// http://auraphp.com/packages/Aura.Router/1.1.1/
//------------------------------------------------------------------------------------------------------
$router = container()->get('router');
/* @var $router Aura\Router\Map */

include __DIR__ . '/routes_core.php';
include __DIR__ . '/routes_custom.php';

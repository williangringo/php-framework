<?php

define('APP_ENV', getenv('APP_ENV')? : 'development');
define('APP_DIR', strtr(__DIR__, '\\', '/'));
$lib = APP_DIR . '/lib';

//------------------------------------------------------------------------------------------------------
// PHP configuration
//------------------------------------------------------------------------------------------------------
date_default_timezone_set('UTC');
ini_set('display_errors', (int) $env !== 'production');
ini_set('memory_limit', '256M');

//------------------------------------------------------------------------------------------------------
// Autoload configuration
//------------------------------------------------------------------------------------------------------
set_include_path(implode(PATH_SEPARATOR, [$dir]));
include $lib . '/Symfony/Component/ClassLoader/UniversalClassLoader.php';
$loader = new \Symfony\Component\ClassLoader\UniversalClassLoader();

$loader->registerNamespaces([
    'Aura'    => $lib,
    'Symfony' => $lib
]);

$loader->registerPrefixes([
    'Twig_' => $lib
]);

$loader->useIncludePath(true);
$loader->register(true);

//------------------------------------------------------------------------------------------------------
// File inclusions
//------------------------------------------------------------------------------------------------------
include APP_DIR . '/container.php';

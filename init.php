<?php

//------------------------------------------------------------------------------------------------------
// Application constants
//------------------------------------------------------------------------------------------------------
define('APP_ID', 'myapp');
define('APP_ENV', getenv('APP_ENV')? : 'development');
define('APP_DIR', strtr(__DIR__, '\\', '/'));
define('HTMLPURIFIER_PREFIX', APP_DIR . '/lib');
$tmp = strtr(sys_get_temp_dir(), '\\', '/');
$lib = APP_DIR . '/lib';

//------------------------------------------------------------------------------------------------------
// PHP configuration
//------------------------------------------------------------------------------------------------------
mb_internal_encoding('UTF-8');
date_default_timezone_set('UTC');
ini_set('display_startup_errors', 0);
ini_set('display_errors', (int) APP_ENV !== 'production');
ini_set('html_errors', (int) APP_ENV !== 'production');
ini_set('memory_limit', '256M');
ini_set('allow_url_include', 0);
ini_set('log_errors', 1);
ini_set('error_log', 'syslog');
ini_set('log_errors_max_len', 0);


//------------------------------------------------------------------------------------------------------
// Autoload configuration
//------------------------------------------------------------------------------------------------------
ini_set('open_basedir', implode(PATH_SEPARATOR, [APP_DIR, $tmp]));
set_include_path(implode(PATH_SEPARATOR, [APP_DIR . '/app/src', $lib, APP_DIR]));
include $lib . '/Symfony/Component/ClassLoader/UniversalClassLoader.php';
include $lib . '/Symfony/Component/ClassLoader/ApcUniversalClassLoader.php';

if (extension_loaded('apc') && APP_ENV !== 'development') {
    $loader = new \Symfony\Component\ClassLoader\UniversalClassLoader();
} else {
    $loader = new \Symfony\Component\ClassLoader\UniversalClassLoader();
}

$loader->registerNamespaces([
    'App'               => $lib,
    'Aura'              => $lib,
    'Browser'           => $lib,
    'Carbon'            => $lib,
    'emberlabs'         => $lib,
    'Faker'             => $lib,
    'Geocoder'          => $lib,
    'Gregwar'           => $lib,
    'Guzzle'            => $lib,
    'Hashids'           => $lib,
    'Illuminate'        => $lib,
    'Imagine'           => $lib,
    'Knp'               => $lib,
    'Monolog'           => $lib,
    'Moontoast'         => $lib,
    'Mremi'             => $lib,
    'Multiplayer'       => $lib,
    'Negotiation'       => $lib,
    'Nocarrier'         => $lib,
    'Pagerfanta'        => $lib,
    'PasswordLib'       => $lib,
    'PhpAmqpLib'        => $lib,
    'PhpUnitsOfMeasure' => $lib,
    'Psr'               => $lib,
    'Respect'           => $lib,
    'Rhumsaa'           => $lib,
    'Stash'             => $lib,
    'Stringy'           => $lib,
    'Symfony'           => $lib,
    'Underscore'        => $lib,
    'Upload'            => $lib,
    'Whoops'            => $lib
]);

$loader->registerPrefixes([
    'HTMLPurifier_' => $lib,
    'Swift_'        => $lib . '/SwiftMailer/classes',
    'Twig_'         => $lib
]);

$loader->useIncludePath(true);
$loader->register(true);

//------------------------------------------------------------------------------------------------------
// Error handling configuration
//------------------------------------------------------------------------------------------------------
if (php_sapi_name() !== 'cli') {
    \Symfony\Component\Debug\ErrorHandler::register();

    if (APP_ENV === 'development') {
        $xhr    = 'HTTP_X_REQUESTED_WITH';
        $whoops = new \Whoops\Run();
        $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler());

        if (!empty($_SERVER[$xhr]) && strtolower($_SERVER[$xhr]) === 'xmlhttprequest') {
            $whoops->pushHandler(new \Whoops\Handler\JsonResponseHandler());
        }

        $whoops->register();
    } else {
        \App\ExceptionHandler::register(APP_ENV !== 'production');
    }
}

//------------------------------------------------------------------------------------------------------
// File inclusions
//------------------------------------------------------------------------------------------------------
include APP_DIR . '/container.php';
include APP_DIR . '/lib/Illuminate/Support/helpers.php';

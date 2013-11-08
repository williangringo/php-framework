<?php

//------------------------------------------------------------------------------------------------------
// Application constants
//------------------------------------------------------------------------------------------------------
define('APP_ID', getenv('APP_ID')? : 'myapp');
define('APP_ENV', getenv('APP_ENV')? : 'development');
define('APP_DIR', strtr(__DIR__, '\\', '/'));
define('HTMLPURIFIER_PREFIX', APP_DIR . '/lib');
define('ESSENCE_LIB', APP_DIR . '/lib/Essence/');
define('ESSENCE_DEFAULT_PROVIDERS', ESSENCE_LIB . 'providers.php');
$tmp = strtr(sys_get_temp_dir(), '\\', '/');
$lib = APP_DIR . '/lib';

$temp = sprintf('%s/%s', $tmp, APP_ID);

if (!file_exists($temp)) {
    @mkdir($temp, 0775, true);
}

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
ignore_user_abort(true);


//------------------------------------------------------------------------------------------------------
// Autoload configuration
//------------------------------------------------------------------------------------------------------
if (php_sapi_name() !== 'cli') {
    ini_set('open_basedir', implode(PATH_SEPARATOR, [APP_DIR, $tmp]));
}

set_include_path(implode(PATH_SEPARATOR, [APP_DIR . '/app/src', $lib, APP_DIR]));

// if any lib is installed using Composer, we include the Composer autoloader
$composer = APP_DIR . '/vendor/autoload.php';

if (file_exists($composer)) {
    include $composer;
}

include $lib . '/Symfony/Component/ClassLoader/UniversalClassLoader.php';
include $lib . '/Symfony/Component/ClassLoader/ApcUniversalClassLoader.php';

if (extension_loaded('apc') && APP_ENV !== 'development') {
    $loader = new \Symfony\Component\ClassLoader\ApcUniversalClassLoader(APP_ID);
} else {
    $loader = new \Symfony\Component\ClassLoader\UniversalClassLoader();
}

$loader->registerNamespaces([
    'App'               => $lib,
    'Aura'              => $lib,
    'Browser'           => $lib,
    'CalendR'           => $lib,
    'Carbon'            => $lib,
    'Enum'              => $lib,
    'Essence'           => $lib . '/Essence',
    'emberlabs'         => $lib,
    'Faker'             => $lib,
    'Geocoder'          => $lib,
    'Gregwar'           => $lib,
    'Guzzle'            => $lib,
    'Hashids'           => $lib,
    'Illuminate'        => $lib,
    'Imagine'           => $lib,
    'IsoCodes'          => $lib,
    'Knp'               => $lib,
    'Michelf'           => $lib,
    'MongoQB'           => $lib,
    'Monolog'           => $lib,
    'Moontoast'         => $lib,
    'Mremi'             => $lib,
    'Multiplayer'       => $lib,
    'Negotiation'       => $lib,
    'Nocarrier'         => $lib,
    'OAuth'             => $lib,
    'OAuth2'            => $lib,
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
    'utilphp'           => $lib,
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

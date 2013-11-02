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

//------------------------------------------------------------------------------------------------------
// Container application parameters
//------------------------------------------------------------------------------------------------------
$container->params['app'] = [
    'env' => APP_ENV,
    'dir' => APP_DIR,
    'tmp' => $tmp
];

//------------------------------------------------------------------------------------------------------
// Cache service
// Instance of: \Stash\Pool
// Docs: http://stash.tedivm.com/
//------------------------------------------------------------------------------------------------------
$container->set('cache', function() use ($container) {
    $config  = $container->get('config')['cache'];
    $drivers = [new \Stash\Driver\Ephemeral()];
    if (extension_loaded('apc')) {
        $drivers[] = new \Stash\Driver\Apc($config['apc']);
    }
    if (extension_loaded('memcache') || extension_loaded('memcached')) {
        $drivers[] = new \Stash\Driver\Memcache($config['memcache']);
    }
    if (extension_loaded('redis')) {
        $drivers[] = new \Stash\Driver\Redis($config['redis']);
    }
    $drivers[] = new \Stash\Driver\FileSystem($config['file']);
    return new \Stash\Pool(new \Stash\Driver\Composite(compact('drivers')));
});

//------------------------------------------------------------------------------------------------------
// Application configuration data
// Array
// See the /config folder
//------------------------------------------------------------------------------------------------------
$container->set('config', function() use ($tmp) {
    return include sprintf('%s/config/%s.php', APP_DIR, APP_ENV);
});

//------------------------------------------------------------------------------------------------------
// Container service
// Instance of: \App\Container
// It's simply a class to use autocompletion
//------------------------------------------------------------------------------------------------------
$container->set('container', function() use ($container) {
    return new \App\Container($container);
});

//------------------------------------------------------------------------------------------------------
// Database service
// Instance of: \Illuminate\Database\Capsule\Manager
// Docs: https://github.com/illuminate/database
//       http://laravel.com/docs/database
//------------------------------------------------------------------------------------------------------
$container->set('db', function() use ($container) {
    $config  = $container->get('config')['db'];
    $capsule = new \Illuminate\Database\Capsule\Manager();
    foreach ($config as $name => $params) {
        $capsule->addConnection($params, $name);
    }
    $capsule->setEventDispatcher(new \Illuminate\Events\Dispatcher(new \Illuminate\Container\Container()));
    return $capsule;
});

//------------------------------------------------------------------------------------------------------
// Event Dispatcher service
// Instance of: \Symfony\Component\EventDispatcher\EventDispatcher
// Docs: http://symfony.com/doc/current/components/event_dispatcher/introduction.html
//------------------------------------------------------------------------------------------------------
$container->set('events', function() {
    return new \Symfony\Component\EventDispatcher\EventDispatcher();
});

//------------------------------------------------------------------------------------------------------
// Helper service
// Instance of: \App\Helper
//------------------------------------------------------------------------------------------------------
$container->set('helper', function() use ($container) {
    return new \App\Helper($container->get('container'));
});

//------------------------------------------------------------------------------------------------------
// Kernel service
// Instance of: \App\Kernel
//------------------------------------------------------------------------------------------------------
$container->set('kernel', function() use ($container) {
    return new \App\Kernel($container->get('container'));
});

//------------------------------------------------------------------------------------------------------
// Class loader service
// Instance of: \Symfony\Component\ClassLoader\UniversalClassLoader
// Docs: http://symfony.com/doc/2.1/components/class_loader.html
//------------------------------------------------------------------------------------------------------
$container->set('loader', $loader);

//------------------------------------------------------------------------------------------------------
// Logger service
// Instance of: \Monolog\Logger
// Docs: https://github.com/Seldaek/monolog
//------------------------------------------------------------------------------------------------------
$container->set('log', function() use ($container) {
    $config = $container->get('config');
    $logger = new \Monolog\Logger($config['app']['id']);
    $syslog = new \Monolog\Handler\SyslogHandler($config['app']['id'], LOG_USER, $config['log']['level']);
    $logger->pushHandler($syslog);
    return $logger;
});

//------------------------------------------------------------------------------------------------------
// Mobile detection service
// Instance of: Mobile_Detect
// Docs: http://mobiledetect.net/
//------------------------------------------------------------------------------------------------------
$container->set('mobile', function() use ($container) {
    include APP_DIR . '/lib/Mobile_Detect.php';
    return new \Mobile_Detect($container->get('request')->server->all());
});

//------------------------------------------------------------------------------------------------------
// Purifier service
// Instance of: HTMLPurifier
// Docs: http://htmlpurifier.org/
//------------------------------------------------------------------------------------------------------
$container->set('purifier', function() use ($container) {
    $container->get('loader')->loadClass('HTMLPurifier');
    $config = \HTMLPurifier_Config::createDefault();
    $config->set('Cache.SerializerPath', $container->get('config')['app']['temp']);
    return new \HTMLPurifier($config);
});

//------------------------------------------------------------------------------------------------------
// Request service
// Instance of: \Symfony\Component\HttpFoundation\Request
// Docs: http://symfony.com/doc/current/components/http_foundation/introduction.html
//------------------------------------------------------------------------------------------------------
$container->set('request', function() use ($container) {
    $request  = \Symfony\Component\HttpFoundation\Request::createFromGlobals();
    $items    = ['query', 'request'];
    $purifier = $container->get('purifier');
    foreach ($items as $item) {
        $data = $request->$item->all();
        foreach ($data as $key => $value) {
            $request->$item->set($key, $purifier->purify($value));
        }
    }
    return $request;
});

//------------------------------------------------------------------------------------------------------
// Router service
// Instance of: \Aura\Router\Map
// Docs: http://auraphp.com/packages/Aura.Router/1.1.1/
//------------------------------------------------------------------------------------------------------
$container->set('router', function() {
    return new \Aura\Router\Map(new \Aura\Router\DefinitionFactory(), new \Aura\Router\RouteFactory());
});

//------------------------------------------------------------------------------------------------------
// Session service
// Instance of: \Symfony\Component\HttpFoundation\Session\Session
// Docs: http://symfony.com/doc/current/components/http_foundation/sessions.html
//------------------------------------------------------------------------------------------------------
$container->set('session', function() use ($container) {
    $config  = $container->get('config')['session'];
    $handler = new \Symfony\Component\HttpFoundation\Session\Storage\Handler\NativeSessionHandler();
    $storage = new \Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage($config['options'], $handler);
    return new \Symfony\Component\HttpFoundation\Session\Session($storage);
});

//------------------------------------------------------------------------------------------------------
// Twig service
// Instance of: Twig_Environment
// Docs: http://twig.sensiolabs.org/
//------------------------------------------------------------------------------------------------------
$container->set('twig', function() use ($container) {
    $config = $container->get('config')['twig'];
    $loader = new \Twig_Loader_Filesystem($config['paths']);
    $engine = new \Twig_Environment($loader, $config['options']);
    $engine->addGlobal('h', $container->get('helper'));
    return $engine;
});

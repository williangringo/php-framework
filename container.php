<?php

$container                = new \Aura\Di\Container(new Aura\Di\Forge(new \Aura\Di\Config()));
$GLOBALS['app.container'] = $container;

/**
 * Service locator container (IoC, Dependency Injection, ...)
 * @return \Aura\Di\Container
 */
function container() {
    return $GLOBALS['app.container'];
}

$container->params['app'] = [
    'env' => APP_ENV,
    'dir' => APP_DIR
];

$container->set('loader', $loader);

$container->set('cache', function() {
    
});

$container->set('config', function() {
    return include sprintf('%s/config/%s.php', APP_DIR, APP_ENV);
});

$container->set('db', function() use ($container) {
    $factory = new \Aura\Sql\ConnectionFactory();
    return call_user_func_array([$factory, 'newInstance'], $container->get('config')['db']);
});

$container->set('events', function() {
    return new \Symfony\Component\EventDispatcher\EventDispatcher();
});

$container->set('log', function() use ($container) {
    $config = $container->get('config');
    $logger = new \Monolog\Logger($config['app']['id']);
    $syslog = new \Monolog\Handler\SyslogHandler($config['app']['id'], LOG_USER, $config['log']['level']);
    $logger->pushHandler($syslog);
    return $logger;
});

$container->set('request', function() {
    return \Symfony\Component\HttpFoundation\Request::createFromGlobals();
});

$container->set('session', function() use ($container) {
    $config  = $container->get('config')['session'];
    $handler = new Symfony\Component\HttpFoundation\Session\Storage\Handler\NativeSessionHandler();
    $storage = new Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage($config['options'], $handler);
    return new Symfony\Component\HttpFoundation\Session\Session($storage);
});

$container->set('twig', function() use ($container) {
    $config = $container->get('config')['twig'];
    $loader = new Twig_Loader_Filesystem($config['paths']);
    return new Twig_Environment($loader, $config['options']);
});

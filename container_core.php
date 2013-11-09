<?php

/* @var $container Aura\Di\Container */

//------------------------------------------------------------------------------------------------------
// Container application parameters
//------------------------------------------------------------------------------------------------------
$container->params['app'] = [
    'id'     => APP_ID,
    'env'    => APP_ENV,
    'dir'    => APP_DIR,
    'tmp'    => $temp,
    'locale' => ''
];

/**
 * Aura\View\Helper\DateTime
 */
$container->params['Aura\View\Helper\Datetime']['format'] = [
    'date'     => 'Y-m-d H:i:s',
    'time'     => 'H:i:s',
    'datetime' => 'Y-m-d H:i:s',
    'default'  => 'Y-m-d H:i:s',
];

/**
 * Aura\View\Helper\Escape
 */
$container->params['Aura\View\Helper\Escape'] = [
    'escaper_factory' => $container->lazyNew('Aura\View\EscaperFactory'),
];

/**
 * Aura\View\Helper\Form\Field
 */
$container->params['Aura\View\Helper\Form\Field']['registry'] = [
    'button'         => $container->lazyNew('Aura\View\Helper\Form\Input\Generic'),
    'checkbox'       => $container->lazyNew('Aura\View\Helper\Form\Input\Checked'),
    'color'          => $container->lazyNew('Aura\View\Helper\Form\Input\Value'),
    'date'           => $container->lazyNew('Aura\View\Helper\Form\Input\Value'),
    'datetime'       => $container->lazyNew('Aura\View\Helper\Form\Input\Value'),
    'datetime-local' => $container->lazyNew('Aura\View\Helper\Form\Input\Value'),
    'email'          => $container->lazyNew('Aura\View\Helper\Form\Input\Value'),
    'file'           => $container->lazyNew('Aura\View\Helper\Form\Input\Generic'),
    'hidden'         => $container->lazyNew('Aura\View\Helper\Form\Input\Value'),
    'image'          => $container->lazyNew('Aura\View\Helper\Form\Input\Generic'),
    'month'          => $container->lazyNew('Aura\View\Helper\Form\Input\Value'),
    'number'         => $container->lazyNew('Aura\View\Helper\Form\Input\Value'),
    'password'       => $container->lazyNew('Aura\View\Helper\Form\Input\Value'),
    'radio'          => $container->lazyNew('Aura\View\Helper\Form\Input\Checked'),
    'range'          => $container->lazyNew('Aura\View\Helper\Form\Input\Value'),
    'reset'          => $container->lazyNew('Aura\View\Helper\Form\Input\Generic'),
    'search'         => $container->lazyNew('Aura\View\Helper\Form\Input\Value'),
    'submit'         => $container->lazyNew('Aura\View\Helper\Form\Input\Generic'),
    'tel'            => $container->lazyNew('Aura\View\Helper\Form\Input\Value'),
    'text'           => $container->lazyNew('Aura\View\Helper\Form\Input\Value'),
    'time'           => $container->lazyNew('Aura\View\Helper\Form\Input\Value'),
    'url'            => $container->lazyNew('Aura\View\Helper\Form\Input\Value'),
    'week'           => $container->lazyNew('Aura\View\Helper\Form\Input\Value'),
    'radios'         => $container->lazyNew('Aura\View\Helper\Form\Radios'),
    'checkboxes'     => $container->lazyNew('Aura\View\Helper\Form\Checkboxes'),
    'select'         => $container->lazyNew('Aura\View\Helper\Form\Select'),
    'textarea'       => $container->lazyNew('Aura\View\Helper\Form\Textarea'),
    'repeat'         => $container->lazyNew('Aura\View\Helper\Form\Repeat'),
];

/**
 * Aura\View\Helper\Form\Input
 */
$container->params['Aura\View\Helper\Form\Input']['registry'] = [
    'button'         => $container->lazyNew('Aura\View\Helper\Form\Input\Generic'),
    'checkbox'       => $container->lazyNew('Aura\View\Helper\Form\Input\Checked'),
    'color'          => $container->lazyNew('Aura\View\Helper\Form\Input\Value'),
    'date'           => $container->lazyNew('Aura\View\Helper\Form\Input\Value'),
    'datetime'       => $container->lazyNew('Aura\View\Helper\Form\Input\Value'),
    'datetime-local' => $container->lazyNew('Aura\View\Helper\Form\Input\Value'),
    'email'          => $container->lazyNew('Aura\View\Helper\Form\Input\Value'),
    'file'           => $container->lazyNew('Aura\View\Helper\Form\Input\Generic'),
    'hidden'         => $container->lazyNew('Aura\View\Helper\Form\Input\Value'),
    'image'          => $container->lazyNew('Aura\View\Helper\Form\Input\Generic'),
    'month'          => $container->lazyNew('Aura\View\Helper\Form\Input\Value'),
    'number'         => $container->lazyNew('Aura\View\Helper\Form\Input\Value'),
    'password'       => $container->lazyNew('Aura\View\Helper\Form\Input\Value'),
    'radio'          => $container->lazyNew('Aura\View\Helper\Form\Input\Checked'),
    'range'          => $container->lazyNew('Aura\View\Helper\Form\Input\Value'),
    'reset'          => $container->lazyNew('Aura\View\Helper\Form\Input\Generic'),
    'search'         => $container->lazyNew('Aura\View\Helper\Form\Input\Value'),
    'submit'         => $container->lazyNew('Aura\View\Helper\Form\Input\Generic'),
    'tel'            => $container->lazyNew('Aura\View\Helper\Form\Input\Value'),
    'text'           => $container->lazyNew('Aura\View\Helper\Form\Input\Value'),
    'time'           => $container->lazyNew('Aura\View\Helper\Form\Input\Value'),
    'url'            => $container->lazyNew('Aura\View\Helper\Form\Input\Value'),
    'week'           => $container->lazyNew('Aura\View\Helper\Form\Input\Value'),
];

/**
 * Aura\View\Helper\Repeat
 */
$container->params['Aura\View\Helper\Form\Repeat']['registry'] = [
    'button'         => $container->lazyNew('Aura\View\Helper\Form\Input\Generic'),
    'checkbox'       => $container->lazyNew('Aura\View\Helper\Form\Input\Checked'),
    'color'          => $container->lazyNew('Aura\View\Helper\Form\Input\Value'),
    'date'           => $container->lazyNew('Aura\View\Helper\Form\Input\Value'),
    'datetime'       => $container->lazyNew('Aura\View\Helper\Form\Input\Value'),
    'datetime-local' => $container->lazyNew('Aura\View\Helper\Form\Input\Value'),
    'email'          => $container->lazyNew('Aura\View\Helper\Form\Input\Value'),
    'file'           => $container->lazyNew('Aura\View\Helper\Form\Input\Generic'),
    'hidden'         => $container->lazyNew('Aura\View\Helper\Form\Input\Value'),
    'image'          => $container->lazyNew('Aura\View\Helper\Form\Input\Generic'),
    'month'          => $container->lazyNew('Aura\View\Helper\Form\Input\Value'),
    'number'         => $container->lazyNew('Aura\View\Helper\Form\Input\Value'),
    'password'       => $container->lazyNew('Aura\View\Helper\Form\Input\Value'),
    'radio'          => $container->lazyNew('Aura\View\Helper\Form\Input\Checked'),
    'range'          => $container->lazyNew('Aura\View\Helper\Form\Input\Value'),
    'reset'          => $container->lazyNew('Aura\View\Helper\Form\Input\Generic'),
    'search'         => $container->lazyNew('Aura\View\Helper\Form\Input\Value'),
    'submit'         => $container->lazyNew('Aura\View\Helper\Form\Input\Generic'),
    'tel'            => $container->lazyNew('Aura\View\Helper\Form\Input\Value'),
    'text'           => $container->lazyNew('Aura\View\Helper\Form\Input\Value'),
    'time'           => $container->lazyNew('Aura\View\Helper\Form\Input\Value'),
    'url'            => $container->lazyNew('Aura\View\Helper\Form\Input\Value'),
    'week'           => $container->lazyNew('Aura\View\Helper\Form\Input\Value'),
    'radios'         => $container->lazyNew('Aura\View\Helper\Form\Radios'),
    'checkboxes'     => $container->lazyNew('Aura\View\Helper\Form\Checkboxes'),
    'select'         => $container->lazyNew('Aura\View\Helper\Form\Select'),
    'textarea'       => $container->lazyNew('Aura\View\Helper\Form\Textarea'),
];

/**
 * Aura\View\Helper\Radios
 */
$container->params['Aura\View\Helper\Form\Radios'] = [
    'input' => $container->lazyNew('Aura\View\Helper\Form\Input\Checked'),
];

/**
 * Aura\View\Helper\Checkboxes
 */
$container->params['Aura\View\Helper\Form\Checkboxes'] = [
    'input' => $container->lazyNew('Aura\View\Helper\Form\Input\Checked'),
];

/**
 * Aura\View\HelperLocator
 */
$container->params['Aura\View\HelperLocator']['registry'] = [
    'anchor'      => $container->lazyNew('Aura\View\Helper\Anchor'),
    'attribs'     => $container->lazyNew('Aura\View\Helper\Attribs'),
    'base'        => $container->lazyNew('Aura\View\Helper\Base'),
    'datetime'    => $container->lazyNew('Aura\View\Helper\Datetime'),
    'escape'      => $container->lazyNew('Aura\View\Helper\Escape'),
    'field'       => $container->lazyNew('Aura\View\Helper\Form\Field'),
    'image'       => $container->lazyNew('Aura\View\Helper\Image'),
    'input'       => $container->lazyNew('Aura\View\Helper\Form\Input'),
    'links'       => $container->lazyNew('Aura\View\Helper\Links'),
    'metas'       => $container->lazyNew('Aura\View\Helper\Metas'),
    'ol'          => $container->lazyNew('Aura\View\Helper\Ol'),
    'radios'      => $container->lazyNew('Aura\View\Helper\Form\Radios'),
    'checkboxes'  => $container->lazyNew('Aura\View\Helper\Form\Checkboxes'),
    'repeat'      => $container->lazyNew('Aura\View\Helper\Form\Repeat'),
    'scripts'     => $container->lazyNew('Aura\View\Helper\Scripts'),
    'scriptsFoot' => $container->lazyNew('Aura\View\Helper\Scripts'),
    'select'      => $container->lazyNew('Aura\View\Helper\Form\Select'),
    'styles'      => $container->lazyNew('Aura\View\Helper\Styles'),
    'tag'         => $container->lazyNew('Aura\View\Helper\Tag'),
    'title'       => $container->lazyNew('Aura\View\Helper\Title'),
    'textarea'    => $container->lazyNew('Aura\View\Helper\Form\Textarea'),
    'ul'          => $container->lazyNew('Aura\View\Helper\Ul'),
];

/**
 * Aura\View\Template
 */
$container->params['Aura\View\Template'] = [
    'escaper_factory' => $container->lazyNew('Aura\View\EscaperFactory'),
    'helper_locator'  => $container->lazyNew('Aura\View\HelperLocator'),
    'template_finder' => $container->lazyNew('Aura\View\TemplateFinder'),
];

/**
 * Aura\View\TwoStep
 */
$container->params['Aura\View\TwoStep'] = [
    'template'     => $container->lazyNew('Aura\View\Template'),
    'format_types' => $container->lazyNew('Aura\View\FormatTypes'),
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
$container->set('config', function() use ($container) {
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
// MongoDB service
// Instance of: \MongoQB\Builder
// Docs: https://github.com/alexbilbie/MongoQB
//------------------------------------------------------------------------------------------------------
$container->set('mongo', function() use ($container) {
    return new \MongoQB\Builder($container->get('config')['mongo']);
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
            if (is_array($value) === false) {
                $request->$item->set($key, $purifier->purify($value));
            }
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
// Translator service
// Instance of: \Symfony\Component\Translation\Translator
// Docs: http://symfony.com/doc/master/book/translation.html
//------------------------------------------------------------------------------------------------------
$container->set('trans', function() use ($container) {
    $locale   = $container->params['app']['locale']? : $container->get('config')['trans']['default'];
    $selector = new \Symfony\Component\Translation\MessageSelector();
    $trans    = new \Symfony\Component\Translation\Translator($locale, $selector);
    $trans->setFallbackLocales([explode('_', $locale)[0]]);
    $trans->addLoader('array', new \Symfony\Component\Translation\Loader\ArrayLoader());
    return $trans;
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

<?php

namespace App;

/**
 * @property array $config 
 * @property \Stash\Pool $cache 
 * @property \App\Kernel $kernel
 * @property \App\Helper $helper 
 * @property \Monolog\Logger $log 
 * @property \Mobile_Detect $mobile
 * @property \HTMLPurifier $purifier
 * @property \Twig_Environment $twig 
 * @property \MongoQB\Builder $mongo
 * @property \Aura\Router\Map $router
 * @property \Aura\Di\Container $container
 * @property \Illuminate\Database\Capsule\Manager $db
 * @property \Symfony\Component\Translation\Translator $trans
 * @property \Symfony\Component\HttpFoundation\Request $request
 * @property \Symfony\Component\HttpFoundation\Session\Session $session 
 * @property \Symfony\Component\EventDispatcher\EventDispatcher $events
 * @property \Symfony\Component\ClassLoader\UniversalClassLoader $loader 
 */
class Container {

    /**
     * Service locator container
     * @var \Aura\Di\Container
     */
    protected $container;

    public function __construct($container) {
        $this->container = $container;
    }

    public function __get($name) {
        if ($name === 'container') {
            return $this->container;
        }

        return $this->container->has($name) ? $this->container->get($name) : null;
    }

}

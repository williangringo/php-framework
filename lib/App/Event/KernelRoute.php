<?php

namespace App\Event;

class KernelRoute extends \Symfony\Component\EventDispatcher\Event {

    /**
     * Route instance
     * @var \Aura\Router\Route
     */
    protected $route;

    public function __construct($route) {
        $this->route = $route;
    }

    public function getRoute() {
        return $this->route;
    }

}

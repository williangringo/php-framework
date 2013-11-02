<?php

namespace App\Event;

class KernelBefore extends \App\Event\KernelRoute {

    /**
     * Controller instance
     * @var App\Controller
     */
    protected $controller;

    public function __construct($route, $controller) {
        parent::__construct($route);
        $this->controller = $controller;
    }

    public function getController() {
        return $this->controller;
    }

}

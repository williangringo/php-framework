<?php

namespace App\Event;

class KernelAfter extends \App\Event\KernelBefore {

    /**
     * Response instance
     * @var \Symfony\Component\HttpFoundation\Response
     */
    protected $response;

    public function __construct($route, $controller, $response) {
        parent::__construct($route, $controller);
        $this->response = $response;
    }

    public function getResponse() {
        return $this->response;
    }

}

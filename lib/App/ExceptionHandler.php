<?php

namespace App;

class ExceptionHandler {

    protected $debug;

    public function __construct($debug) {
        $this->debug = $debug;
    }

    public static function register($debug) {
        $handler = new static($debug);
        set_exception_handler(array($handler, 'handle'));
    }

    public function handle(\Exception $e) {
        $request = \Symfony\Component\HttpFoundation\Request::createFromGlobals();
        /* @var $request \Symfony\Component\HttpFoundation\Request */

        if ($request->isXmlHttpRequest()) {
            $data = [
                'error'    => true,
                'messages' => [
                    $e->getMessage()
                ]
            ];

            (new \Symfony\Component\HttpFoundation\JsonResponse($data))->send();
        } else {
            $sfDebug = new \Symfony\Component\Debug\ExceptionHandler($this->debug);
            $sfDebug->handle($e);
        }
    }

}

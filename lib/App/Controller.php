<?php

namespace App;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;

class Controller {

    /**
     * Service locator container
     * @var Container
     */
    protected $container;

    /**
     * Response variables
     * @var array
     */
    protected $out = [];

    public function __construct($container) {
        $this->container = $container;
    }

    public function html($content = null, $status = 200) {
        $response = new Response($content, $status);
        $response->headers->set('Content-Type', 'text/html; charset=utf-8');
        $response->setCharset('UTF-8');
        return $response;
    }

    public function text($content = null, $status = 200) {
        $response = new Response($content, $status);
        $response->headers->set('Content-Type', 'text/plain; charset=utf-8');
        $response->setCharset('UTF-8');
        return $response;
    }

    public function xml($content = null, $status = 200) {
        $response = new Response($content, $status);
        $response->headers->set('Content-Type', 'text/xml; charset=utf-8');
        $response->setCharset('UTF-8');
        return $response;
    }

    public function json($data = null, $status = 200) {
        $response = new JsonResponse($data, $status);
        $response->headers->set('Content-Type', 'application/json; charset=utf-8');
        $response->setCharset('UTF-8');
        return $response;
    }

    public function redirect($url, $status = 302) {
        return new RedirectResponse($url, $status);
    }

    public function view($file, $out = null, $merge = false) {
        $context = is_array($out) ? $merge ? array_merge($this->out, $out) : $out  : $this->out;
        return $this->container->twig->render($file, $context);
    }

    public function out($name, $value = null) {
        if (func_num_args() === 1) {
            return array_key_exists($name, $this->out) ? $this->out[$name] : null;
        }

        $this->out[$name] = $value;
        return $this;
    }

    public function clear($name) {
        if (array_key_exists($name, $this->out)) {
            unset($this->out[$name]);
        }

        return $this;
    }

}

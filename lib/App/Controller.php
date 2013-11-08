<?php

namespace App;

use App\Response\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
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

    /**
     * Send a HTML response
     * @param string $content
     * @param int $status
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function html($content = null, $status = 200) {
        $response = new Response($content, $status);
        $response->headers->set('Content-Type', 'text/html; charset=utf-8');
        $response->setCharset('UTF-8');
        return $response;
    }

    /**
     * Send a PLAIN TEXT response
     * @param string $content
     * @param int $status
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function text($content = null, $status = 200) {
        $response = new Response($content, $status);
        $response->headers->set('Content-Type', 'text/plain; charset=utf-8');
        $response->setCharset('UTF-8');
        return $response;
    }

    /**
     * Send a XML response
     * @param string $content
     * @param int $status
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function xml($content = null, $status = 200) {
        $response = new Response($content, $status);
        $response->headers->set('Content-Type', 'text/xml; charset=utf-8');
        $response->setCharset('UTF-8');
        return $response;
    }

    /**
     * Send a JSON response
     * @param mixed $data
     * @param int $status
     * @return \App\Response\JsonResponse
     */
    public function json($data = null, $status = 200) {
        $response = new JsonResponse($data, $status);
        $response->headers->set('Content-Type', 'application/json; charset=utf-8');
        $response->setCharset('UTF-8');
        return $response;
    }

    /**
     * Send a JSON-P response
     * @param mixed $data
     * @param int $status
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function jsonp($data = null, $status = 200) {
        $callback = $this->getParam('callback', $this->getParam('jsonp'));

        if (!$callback) {
            $callback = 'throw';
            $status   = 500;
        }

        $response = new Response(htmlspecialchars($callback) . "(" . json_encode($data) . ")", $status);
        $response->headers->set('Content-Type', 'application/javascript; charset=utf-8');
        $response->setCharset('UTF-8');
        return $response;
    }

    /**
     * Send a REDIRECT response
     * @param string $url
     * @param int $status
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirect($url, $status = 302) {
        $response = new RedirectResponse($url, $status);
        $response->setCharset('UTF-8');
        return $response;
    }

    /**
     * Render a view file
     * @param string $file
     * @param array $out Variables to be passed to the view
     * @param bool $merge Merge the $out param with the class $out variables?
     * @return string
     */
    public function view($file, $out = null, $merge = false) {
        $context = is_array($out) ? $merge ? array_merge($this->out, $out) : $out  : $this->out;
        $config  = $this->container->config['template'];

        if ($config['inject_prefix']) {
            $prefix     = $this->container->helper->displayPrefix();
            $file       = explode('/', $file);
            $pos        = count($file) - 1;
            $file[$pos] = $prefix . $file[$pos];
            $file       = implode('/', $file);
        }

        return $this->container->twig->render($file, $context);
    }

    /**
     * Assign a variable to the response
     * @param string $name
     * @param mixed $value
     * @return \App\Controller
     */
    public function out($name, $value = null) {
        if (func_num_args() === 1) {
            return array_key_exists($name, $this->out) ? $this->out[$name] : null;
        }

        $this->out[$name] = $value;
        return $this;
    }

    /**
     * Clear a response variable
     * @param string $name
     * @return \App\Controller
     */
    public function clear($name) {
        if (array_key_exists($name, $this->out)) {
            unset($this->out[$name]);
        }

        return $this;
    }

    /**
     * Get a request variable
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function getParam($key, $default = null) {
        $r = null;

        if ($r === null) {
            $r = $this->container->request;
        }

        return $r->get($key, $r->files->get($key, $default));
    }

}

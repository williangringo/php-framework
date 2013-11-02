<?php

namespace App;

use Stringy\Stringy as s;
use App\Event\KernelAfter;
use App\Event\KernelRoute;
use App\Exception\NotFound;
use App\Event\KernelBefore;
use App\Exception\InvalidResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class Kernel {

    /**
     * Service locator container
     * @var Container
     */
    protected $container;

    public function __construct($container) {
        $this->container = $container;
    }

    public function dispatch() {
        try {
            $this->container->events->dispatch('kernel.always');
            $this->loadRoutes();

            $path   = $this->container->request->getPathInfo();
            $server = $this->container->request->server->all();
            $route  = $this->container->router->match($path, $server);

            if (!$route) {
                $this->container->log->addError("Route {$path} not found");
                throw new NotFound('Not found');
            }

            $evtKr = new KernelRoute($route);
            $this->container->events->dispatch('kernel.route', $evtKr);

            $m = isset($route->values['m']) ? $route->values['m'] : 'base';
            $c = isset($route->values['c']) ? $route->values['c'] : 'index';
            $a = isset($route->values['a']) ? $route->values['a'] : 'index';

            $m = s::create($m)->upperCamelize()->str;
            $c = s::create($c)->upperCamelize()->str;
            $a = s::create($a)->camelize()->str;

            $class = sprintf('\%s\%s\%sController', $m, $c, $c);

            if ($this->container->loader->findFile($class) === null) {
                $this->container->log->addError("Controller {$class} not found");
                throw new NotFound('Not found');
            }

            $controller = new $class($this->container);
            $action     = sprintf('%sAction', $a);

            if (!method_exists($controller, $action)) {
                $this->container->log->addError("Action {$action} not found in Controller class {$class}");
                throw new NotFound('Not found');
            }

            $evtKb = new KernelBefore($route, $controller);
            $this->container->events->dispatch('kernel.before', $evtKb);

            $response = $controller->$action($this->container);

            if (!($response instanceof Response)) {
                $this->container->log->addError("You must send an instance of a Response object");
                throw new InvalidResponse('Invalid response');
            }

            $evtKa = new KernelAfter($route, $controller, $response);
            $this->container->events->dispatch('kernel.after', $evtKa);

            $response->send();
        } catch (NotFound $ex) {
            $this->handleNotFound($ex);
        } catch (\Exception $ex) {
            $this->handleException($ex, 500);
        }
    }

    protected function loadRoutes() {
        if (APP_ENV === 'development') {
            include APP_DIR . '/app/routes.php';
            return;
        }

        $cache = $this->container->cache->getItem('app', 'routes');
        /* @var $cache \Stash\Interfaces\ItemInterface */

        $routes = $cache->get();

        if ($cache->isMiss()) {
            include APP_DIR . '/app/routes.php';
            $cache->set($this->container->router);
        } else {
            $this->container->container->set('router', $routes);
        }
    }

    protected function handleNotFound(\Exception $e) {
        if ($this->container->container->has('error404')) {
            $fn = $this->container->container->get('error404');
            return $fn($e);
        }

        $this->handleException($e, 404);
    }

    protected function handleError(\Exception $e) {
        if ($this->container->container->has('error500')) {
            $fn = $this->container->container->get('error500');
            return $fn($e);
        }

        $this->handleException($e, 500);
    }

    protected function handleException(\Exception $e, $status = 200) {
        $fmt = strtolower($this->container->request->getAcceptableContentTypes()[0]);

        if ($this->container->request->isXmlHttpRequest()) {

            if ($fmt === 'application/json') {
                $data = [
                    'error'    => true,
                    'messages' => [
                        $e->getMessage()
                    ]
                ];

                return (new JsonResponse($data, $status))->send();
            }
        }

        return (new Response($e->getMessage(), $status))->send();
    }

}

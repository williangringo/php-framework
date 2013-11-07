<?php

namespace App\Middleware\Auth;

use Symfony\Component\HttpFoundation\Response;

class HttpBasic implements \App\Middleware\IMiddleware {

    protected $authenticator;
    protected $realm;

    public function __construct(callable $authenticator, $realm = 'Protected') {
        $this->authenticator = $authenticator;
        $this->realm         = $realm;
    }

    public function call() {
        $request  = container()->get('request');
        $purifier = container()->get('purifier');
        $user     = $purifier->purify($request->server->get('PHP_AUTH_USER'));
        $pass     = $purifier->purify($request->server->get('PHP_AUTH_PW'));

        if ($user && $pass && call_user_func_array($this->authenticator, [$user, $pass]) === true) {
            return;
        }

        $response = new Response();
        $response->headers->set('WWW-Authenticate', sprintf('Basic realm="%s"', $this->realm));
        $response->setStatusCode(401);
        $response->send();
        exit(0);
    }

}

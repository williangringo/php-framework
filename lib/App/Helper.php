<?php

namespace App;

use Stringy\Stringy as s;

class Helper {

    /**
     * Service locator container
     * @var Container
     */
    protected $container;

    public function __construct($container) {
        $this->container = $container;
    }

    public function slugify($str) {
        return s::create($str)->slugify()->str;
    }

    public function route($name, array $params = []) {
        return $this->container->router->generate($name, $params);
    }

    public function displayPrefix() {
        $m = $this->container->mobile;

        if ($m->isTablet()) {
            return 't.';
        } elseif ($m->isMobile() && !$m->isTablet()) {
            return 'm.';
        } else {
            return '';
        }
    }

}

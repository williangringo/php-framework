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

    /**
     * Convert a string to a slug value for URL usage
     * @param string $str
     * @return string
     */
    public function slugify($str) {
        return s::create($str)->slugify()->str;
    }

    /**
     * Generate a URI based on a route
     * @param string $name
     * @param array $params
     * @return string
     */
    public function route($name, array $params = []) {
        return $this->container->router->generate($name, $params);
    }

    /**
     * Get a prefix for view files based on request device (m = mobile, t = tablet or empty = desktop)
     * @return string
     */
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

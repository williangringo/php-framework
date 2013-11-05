<?php

// Define webroot
define('WEBROOT', __DIR__);

// Define cache folder
define('MUNEE_CACHE', __DIR__ . '/cache');

// Include munee.phar
require __DIR__ . '/../lib/munee.phar';

// Echo out the response
echo \Munee\Dispatcher::run(new \Munee\Request());

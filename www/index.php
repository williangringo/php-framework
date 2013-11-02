<?php

chdir(dirname(__DIR__));
include './init.php';

container()->get('kernel')->dispatch();

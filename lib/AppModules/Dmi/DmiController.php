<?php

namespace AppModules\Dmi;

class DmiController extends \App\Controller {

    public function dbAction() {
        include APP_DIR . '/lib/adminer.php';
        return -1;
    }

    public function mongoAction() {
        include APP_DIR . '/lib/mongodbadmin.php';
        return -1;
    }

}

<?php

/**
 * Created by PhpStorm.
 * User: AwH
 * Date: 20/01/16
 * Time: 09:40
 */

namespace App;

use Symfony\Component\Yaml\Yaml;

class Routing
{
    public function __construct() {

    }

    public function getRoute() {
        return $_SERVER["REQUEST_URI"];
    }


}
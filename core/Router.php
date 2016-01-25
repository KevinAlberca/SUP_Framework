<?php

/**
 * Created by PhpStorm.
 * User: AwH
 * Date: 20/01/16
 * Time: 09:40
 */

namespace Core;

use Symfony\Component\Yaml\Yaml;

class Router
{
    private $_env;

    public function __construct($env) {
        $this->_env = $env;
    }

    public static function getRoute() {
        return $_SERVER["REQUEST_URI"];
    }

    public function checkIfRouteExist($currentRoute) {
        $routing = $this->readRoutes();
        $allRoutes = array_search($currentRoute, array_column($routing, "route"));
        if ($allRoutes !== false) {
            return true;
        } else {
            throw new \Error("Any route match");
        }
    }

    public function readRoutes() {
        $file = file_get_contents(__DIR__."/../app/routing-".$this->_env.".yml");
        return Yaml::parse($file);
    }

}
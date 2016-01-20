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

    public function getRoute() {
        return $_SERVER["REQUEST_URI"];
    }

    public function checkIfRouteExist() {
        $routing = $this->readRoutes();
        $route = $this->getRoute();
        foreach ($routing as $routes) {
            if ($routes["route"] == $route) {
                return true;
            } else {
                return false;
            }
        }
    }

    private function readRoutes() {
        $file = file_get_contents(__DIR__."/../app/routing-".$this->_env.".yml");
        return Yaml::parse($file);
    }
}
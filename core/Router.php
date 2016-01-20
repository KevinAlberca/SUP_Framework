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

        var_dump($this->checkIfRouteExist());
    }

    public function getRoute() {
        return $_SERVER["REQUEST_URI"];
    }

    private function readRoutes() {
        $file = file_get_contents(__DIR__."/../app/routing-".$this->_env.".yml");
        return Yaml::parse($file);
    }

    private function checkIfRouteExist() {
        $routing = $this->readRoutes();
        $route = $this->getRoute();
        foreach ($routing as $routes) {
            if ($routes["route"] == $route) {
                return "exists";
            } else {
                return "not found";
            }
        }
    }
}
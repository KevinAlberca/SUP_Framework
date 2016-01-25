<?php
/**
 * Created by PhpStorm.
 * User: AwH
 * Date: 25/01/16
 * Time: 08:56
 */

namespace Core;


use Symfony\Component\Yaml\Yaml;

class Controller
{
    private $_route;
    private $_env;

    public function __construct($env) {
        $this->_env = $env;
        $this->_route = Router::getRoute();
    }

    public function getControllerOfRoute() {

    }

    private function readThisRoute($route) {
        $routing = Yaml::parse(file_get_contents(__DIR__."/../app/routing-".$this->_env.".yml"));
        foreach ($routing as $routes) {
            if($routes["route"] == $route) {
                return $routes["controller"];
            }
        }
        return null;
    }


}
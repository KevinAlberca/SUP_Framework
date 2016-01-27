<?php

/**
 * Created by PhpStorm.
 * User: AwH
 * Date: 20/01/16
 * Time: 09:40
 */

namespace Core\Router;

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
        $file = file_get_contents(APP_ROUTE."/routing-".$this->_env.".yml");
        return Yaml::parse($file);
    }

    public function getControllerOfRoute() {
        $c = $this->readThisRoute($this->getRoute());
        $controllerName = explode(":", $c)[0]."Controller";
        $actionName = explode(":", $c)[1]."Action";

        require_once(SRC_ROUTE."/Controller/" .$controllerName.".php");
        $controllerWithNamespace = "\\Controller\\".$controllerName;
        $controller = new $controllerWithNamespace;

        return $controller->$actionName();
    }

    private function readThisRoute($route) {
        $routing = $this->readRoutes();
        foreach ($routing as $routes) {
            if($routes["route"] == $route) {
                return $routes["controller"];
            }
        }
        throw new \Exception("There is any route for you");
    }

}
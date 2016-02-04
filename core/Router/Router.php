<?php

/**
 * Created by PhpStorm.
 * User: AwH
 * Date: 20/01/16
 * Time: 09:40
 */

namespace Core\Router;
use Core\Logs\Error;
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

    public function readRoutes() {
        $file = file_get_contents(APP_ROUTE."/routing.yml");
        return Yaml::parse($file);
    }

    public function getControllerOfRoute() {
        if($this->readThisRoute($this->getRoute())) {
            $c = $this->readThisRoute($this->getRoute());
            $controllerName = explode(":", $c["controller"])[0]."Controller";
            $actionName = explode(":", $c["controller"])[1]."Action";

            require_once(SRC_ROUTE."/Controller/" .$controllerName.".php");
            $controllerWithNamespace = "\\Controller\\".$controllerName;
            $controller = new $controllerWithNamespace;

            return call_user_func_array(array($controller, $actionName), $c["arguments"]);
        }
        return null;
    }

    public function readThisRoute($route) {
        $routing = $this->readRoutes();
        foreach ($routing as $routes) {

            if((preg_match_all("/\\/<*[a-zA-Z0-9]*>/", $routes["route"]) === preg_match_all("/\\/[a-zA-Z0-9]*/", $route)-1)){
                $args = explode("/", $routes["route"]);
                $vars = explode("/",$route);

                $arguments = [];
                $keysToExtract = array_keys(array_diff($args, $vars));

                foreach ($keysToExtract as $keyToExtract) {
                    $arguments[] = $vars[$keyToExtract];
                }

                return [
                    "controller" => $routes["controller"], 
                    "arguments" => $arguments,
                ];
            }
        }

        new Error("This route is unreadable");
        return null;
    }

}

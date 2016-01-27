<?php
/**
 * Created by PhpStorm.
 * User: AwH
 * Date: 25/01/16
 * Time: 08:56
 */

namespace Core\Controller;

use Core\Kernel;
use Core\Router\Router;
use Symfony\Component\Yaml\Yaml;

class Controller extends Kernel
{
    private $_route;
    private $_env;

    public function __construct($env) {
        $this->_env = $env;
        $this->_route = Router::getRoute();
    }

    protected function getControllerOfRoute() {
        $c = $this->readThisRoute($this->_route);
        $controllerName = explode(":", $c)[0]."Controller";
        $actionName = explode(":", $c)[1]."Action";

        require_once(SRC_ROUTE."/Controller/" .$controllerName.".php");
        $controllerWithNamespace = "\\Controller\\".$controllerName;
        $controller = new $controllerWithNamespace;
        return $controller->$actionName();
    }

    private function readThisRoute($route) {
        $routing = Yaml::parse(file_get_contents(APP_ROUTE."/routing-".$this->_env.".yml"));
        foreach ($routing as $routes) {
            if($routes["route"] == $route) {
                return $routes["controller"];
            }
        }
        throw new \Exception("There is any route for you");
    }


}
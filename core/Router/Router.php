<?php
/**
 * Created by PhpStorm.
 * User: AwH
 * Date: 20/01/16
 * Time: 09:40
 */
namespace Core\Router;

use Core\Logs\Error;
use Symfony\Component\Finder\Expression\Regex;
use Symfony\Component\Yaml\Yaml;

class Router
{
    private $_env;

    /**
     * Router constructor.
     * @param $env
     */
    public function __construct($env) {
        $this->_env = $env;
    }

    /**
     * This method return the current route
     * @return mixed
     */
    public function getRoute() {
        return $_SERVER["REQUEST_URI"];
    }

    /**
     * This method read all the route there are in /app/routing.yml
     * @return mixed
     */
    public function readRoutes() {
        $file = file_get_contents(APP_ROUTE."/routing.yml");
        return Yaml::parse($file);
    }

    /**
     * This method return the method of the route
     * @return mixed|null
     */
    public function getControllerOfRoute() {
        if($this->readThisRoute($this->getRoute())) {
            $c = $this->readThisRoute($this->getRoute());

            $controllerName = explode(":", $c["controller"])[0]."Controller";
            $actionName = explode(":", $c["controller"])[1]."Action";

            require_once(SRC_ROUTE."/Controller/" .$controllerName.".php");
            $controllerWithNamespace = "\\Controller\\".$controllerName;
            $controller = new $controllerWithNamespace;

            if(!empty($c["arguments"])){
                return call_user_func_array(array($controller, $actionName), $c["arguments"]);
            } else {
                return $controller->$actionName();
            }
        }
        return null;
    }

    /**
     * Read the current route
     *  - Check if it's exist in routing.yml
     *  - Return Controller & Arguments
     * @param $route
     * @return array
     */
    public function readThisRoute($route)
    {
        $routing = $this->readRoutes();
        $arguments = [];
        foreach ($routing as $routes) {
                if(in_array($route, $routes, true)){
                return [
                    "controller" => $routes["controller"],
                    "arguments" => null,
                ];
            } else {
                if((preg_match_all("/.*<[a-zA-Z0-9]*>*/", $routes["route"])) == preg_match_all("/^\/.*([a-zA-Z0-9])*/", $route)){
                    $args = explode("/", $routes["route"]);
                    $vars = explode("/", $route);

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
        }
    }

}

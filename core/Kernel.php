<?php
/**
 * Created by PhpStorm.
 * User: AwH
 * Date: 27/01/16
 * Time: 10:16
 */

namespace Core;

use Core\Logs\Access;
use Core\Router\Router;


class Kernel
{
    protected $env;
    private $_router;
    private $_controller;

    public function __construct($env) {
        $this->env = $env;

        $this->_router= new Router($this->env);
        $this->_router->getRoute();

        $this->_access = new Access();

        if ($this->_router->checkIfRouteExist($this->_router->getRoute())) {
            $this->_router->getControllerOfRoute();
        }
    }
}
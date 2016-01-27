<?php
/**
 * Created by PhpStorm.
 * User: AwH
 * Date: 27/01/16
 * Time: 10:16
 */

namespace Core;

use Core\Logs\Access;
use Core\Logs\Error;
use Core\Response\Response;
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
        $this->_access->writeLog();

        if ($this->_router->checkIfRouteExist($this->_router->getRoute())) {
            $this->_router->getControllerOfRoute();
        } else {
            new Error("There is any route for your current : ".$this->_router->getRoute(), 404);
        }
    }
}
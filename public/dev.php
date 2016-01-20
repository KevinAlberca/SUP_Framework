<?php
/**
 * Created by PhpStorm.
 * User: AwH
 * Date: 20/01/16
 * Time: 09:41
 */
require_once("../vendor/autoload.php");

$router = new Core\Router("dev");

if($router->checkIfRouteExist($router->getRoute())){
    // Require the view
    echo "<h1>View</h1>";
} else {
    // Require the 404 error page
    echo "<h1>404</h1>";
}


echo "ok";
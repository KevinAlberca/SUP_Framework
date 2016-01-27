<?php

/**
 * Created by PhpStorm.
 * User: AwH
 * Date: 20/01/16
 * Time: 09:41
 */

require_once("../vendor/autoload.php");

$router = new Core\Router("dev");
$controller = new Core\Controller("dev");


$loader = new Twig_Loader_Filesystem(__DIR__."/../ressources/Views");
$loader->addPath(__DIR__."/../ressources", "");
$twig = new Twig_Environment($loader, [
    "charset" => "utf-8",
    "debug" => true,

]);


if ($router->checkIfRouteExist($router->getRoute())) {
    $response = $controller->getControllerOfRoute();

    if(!empty($response["view"])){
        echo $twig->render($response["view"], $response["args"]);
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: AwH
 * Date: 25/01/16
 * Time: 08:56
 */

namespace Core\Controller;

use Core\Kernel;
use Core\Response\Response;
use Core\Router\Router;
use Symfony\Component\Yaml\Yaml;

class Controller
{

    public function returnView($view) {
        return new Response($view);
    }
}
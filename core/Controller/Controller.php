<?php
/**
 * Created by PhpStorm.
 * User: AwH
 * Date: 25/01/16
 * Time: 08:56
 */

namespace Core\Controller;

use Core\Response\Response;

class Controller
{

    public function renderView($view) {
        return new Response($view);
    }

    public function render($view, Array $params) {
        return new Response($view, $params);
    }

}
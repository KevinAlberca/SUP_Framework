<?php

/**
 * Created by PhpStorm.
 * User: AwH
 * Date: 25/01/16
 * Time: 09:46
 */

namespace Controller;

use Core\Controller\Controller;
use Core\Response\Response;

class TestController extends Controller
{

    public function defaultAction() {
        $var = "We test an argument";
        return $this->render("default.html.twig", [
            "test" => $var,
        ]);
    }

    public function testVarAction($var, $otherAction) {
        return $this->render("testVar.html.twig", [
            "var" => $var,
            "other" => $otherAction,
        ]);
    }

}

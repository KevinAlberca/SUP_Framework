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

    public function testAction() {
        return $this->returnView("test.html.twig");
    }

    public function defaultAction() {
        $var = "We test an argument";

        return new Response("default.html.twig", [
            "test" => $var,
        ]);
    }

}
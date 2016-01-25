<?php

/**
 * Created by PhpStorm.
 * User: AwH
 * Date: 25/01/16
 * Time: 09:46
 */

namespace Controller;

class TestController
{
    public function __construct()
    {
    }

    public function testAction(){
        return [
            "view" => "test.html.twig",

        ];
    }

}
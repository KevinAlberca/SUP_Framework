<?php

/**
 * Created by PhpStorm.
 * User: AwH
 * Date: 20/01/16
 * Time: 09:41
 */

require_once("../vendor/autoload.php");

define("APP_ROUTE", __DIR__."/../app");
define("SRC_ROUTE", __DIR__."/../ressources");
define("PUBLIC_ROUTE", __DIR__."/../public");

new \Core\Kernel("dev");

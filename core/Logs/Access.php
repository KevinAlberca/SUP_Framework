<?php
/**
 * Created by PhpStorm.
 * User: AwH
 * Date: 27/01/16
 * Time: 12:29
 */

namespace Core\Logs;


class Access
{

    public function __construct() {
    }

    private function getTime() {
        return date("Y-m-d H:i:s");
    }

}
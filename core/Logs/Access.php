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

    public function writeLog() {
        file_put_contents(APP_ROUTE."/logs/access.log", $this->getMessageLog(), FILE_APPEND);
    }

    private function getMessageLog() {
        return "[".$this->getTime()."] ".$this->getUserAgent()." | Protocol used : ".$this->getProtocol(). " | Requested URI : ".$this->getRequestedURI()."\n";
    }

    private function getTime() {
        return date("Y-m-d H:i:s");
    }

    private function getUserAgent() {
        return $_SERVER["HTTP_USER_AGENT"];
    }

    private function getProtocol() {
        return $_SERVER["SERVER_PROTOCOL"];
    }

    private function getRequestedURI() {
        return $_SERVER["REQUEST_URI"];
    }

}
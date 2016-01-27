<?php
/**
 * Created by PhpStorm.
 * User: AwH
 * Date: 27/01/16
 * Time: 14:10
 */

namespace Core\Logs;


class Error extends \ErrorException
{
    protected $message;

    public function __construct($message) {
        parent::__construct();
        $this->message = $message;
        $this->writeErrorLog();
    }

    public function writeErrorLog() {
        file_put_contents(APP_ROUTE."/logs/error.log", $this->getErrorMessage(), FILE_APPEND);
    }


    private function getErrorMessage() {
        return "[".date("Y-m-d H:i:s")."] ".$this->message." in " .$this->getFile()." on line : ".$this->getLine()."\n";
    }

    private function getTime() {
        return date("Y-m-d H:i:s");
    }


}
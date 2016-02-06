<?php
/**
 * Created by PhpStorm.
 * User: AwH
 * Date: 25/01/16
 * Time: 08:56
 */

namespace Core\Controller;

use Core\Response\Response;
use Core\ORM;

class Controller
{

    protected $orm;

    public function __construct()
    {
        $this->orm = new \Core\ORM\Orm();
    }

    public function renderView($view) {
        return new Response($view);
    }

    public function render($view, Array $params) {
        return new Response($view, $params);
    }

    public function getEntityManager() {
        return $this->orm->getEntityManager();
    }

    public function redirectTo($url = "") {
        return die("<script>location.href = 'http://".$_SERVER["SERVER_NAME"].$url."'</script>");
    }

}
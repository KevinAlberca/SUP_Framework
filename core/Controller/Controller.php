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

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->orm = new \Core\ORM\Orm();
    }

    /**
     * @param $view
     * @return Response
     */
    public function renderView($view) {
        return new Response($view);
    }

    /**
     * @param $view
     * @param array $params
     * @return Response
     */
    public function render($view, Array $params) {
        return new Response($view, $params);
    }

    /**
     * @return \Doctrine\ORM\EntityManager|null
     */
    public function getEntityManager() {
        return $this->orm->getEntityManager();
    }

    /**
     * @param string $url
     */
    public function redirectTo($url = "/") {
        header("Location: http://".$_SERVER["SERVER_NAME"].$url);
        exit();
    }

}

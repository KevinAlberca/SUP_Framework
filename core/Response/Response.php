<?php
/**
 * Created by PhpStorm.
 * User: AwH
 * Date: 27/01/16
 * Time: 09:46
 */

namespace Core\Response;


class Response
{
    private $_twig;

    public function __construct(String $view, Array $param = []) {
        $loader = new \Twig_Loader_Filesystem(SRC_ROUTE."/Views");
        $loader->addPath(SRC_ROUTE. "/", "");
        $this->_twig = new \Twig_Environment($loader, [
            "charset" => "utf-8",
            "debug" => true,

        ]);

        echo $this->_twig->render($view, $param);
    }

}
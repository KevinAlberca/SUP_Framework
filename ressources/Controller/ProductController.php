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
use Doctrine\ORM\EntityManager;

class ProductController extends Controller
{

    public function getProductsAction() {
        $products = $this->getEntityManager()->getRepository("\\Model\\Product")->findAll();
        return $this->render("productList.html.twig", [
            "products" => $products,
        ]);
    }

}

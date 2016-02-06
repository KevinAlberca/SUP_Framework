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
use Model\Product;

class ProductController extends Controller
{

    public function getProductsAction()
    {
        $products = $this->getEntityManager()->getRepository("\\Model\\Product")->findAll();
        return $this->render("productList.html.twig", [
            "products" => $products,
        ]);
    }

    public function addProductAction()
    {
        if(!empty($_POST)){
            $product = new Product();
            $product->setName(htmlentities($_POST["name"]));
            $product->setContent(htmlentities($_POST["content"]));

            $em = $this->getEntityManager();

            $em->persist($product);
            $em->flush();

            return $this->redirectTo();
        }

        return $this->renderView("productAdd.html.twig");
    }

    public function editThisProductAction($id)
    {
        $em = $this->getEntityManager();

        $product = $em->getRepository("\\Model\\Product")->findOneBy([
            "id" => $id,
        ]);

        if(!empty($_POST)){
            var_dump($_POST);
            $product = $em->getRepository("\\Model\\Product")->find($id);
            $product->setName(htmlentities($_POST["name"]));
            $product->setContent(htmlentities($_POST["content"]));

            $em->flush();
            $this->redirectTo();
        }

        return $this->render("productEdit.html.twig",[
            "product" => $product,
        ]);
    }

}

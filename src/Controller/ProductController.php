<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }
}

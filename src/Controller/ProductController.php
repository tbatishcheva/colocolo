<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends AbstractController
{
    /** @var integer */
    const POST_LIMIT = 5;

    /** @var EntityManagerInterface */
    private $entityManager;

    /** @var \Doctrine\Common\Persistence\ObjectRepository */
    private $authorRepository;

    /** @var \Doctrine\Common\Persistence\ObjectRepository */
    private $productRepository;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->productRepository = $entityManager->getRepository('App:Product');
        $this->categoryRepository = $entityManager->getRepository('App:Category');
    }

    /**
     * @Route("/", name="homepage")
     * @Route("/entries", name="entries")
     */
    public function entriesAction(Request $request)
    {

        $page = 1;

        if ($request->get('page')) {
            $page = $request->get('page');
        }

        return $this->render('product/entries.html.twig', [
            'products' => $this->productRepository->getAllProducts($page, self::POST_LIMIT),
            'totalProducts' => $this->productRepository->getProductsCount(),
            'page' => $page,
            'entryLimit' => self::POST_LIMIT
        ]);
    }

    /**
     * @Route("/entry/{slug}", name="entry")
     */
    public function entryAction($slug)
    {
        $product = $this->productRepository->findOneBySlug($slug);

        if (!$product) {
            $this->addFlash('error', 'Unable to find entry!');

            return $this->redirectToRoute('entries');
        }

        return $this->render('product/entry.html.twig', array(
            'product' => $product
        ));
    }

    /**
     * @Route("/category/{name}", name="category")
     */
    public function categoryAction($name)
    {
        $category = $this->categoryRepository->findOneByUsername($name);

        if (!$category) {
            $this->addFlash('error', 'Unable to find category!');
            return $this->redirectToRoute('entries');
        }

        return $this->render('product/category.html.twig', [
            'category' => $category
        ]);
    }
}

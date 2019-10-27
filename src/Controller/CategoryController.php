<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Category;
use App\Form\CategoryFormType;

class CategoryController extends AbstractController
{

    /** @var EntityManagerInterface */
    private $entityManager;

    /** @var \Doctrine\Common\Persistence\ObjectRepository */
    private $categoryRepository;

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
     * @Route("/admin/category/create", name="category_create")
     */
    public function createCategoryAction(Request $request)
    {
        if ($this->categoryRepository->findOneByUsername($this->getUser()->getUserName())) {
            // Redirect to dashboard.
            $this->addFlash('error', 'Unable to create category, category already exists!');

            return $this->redirectToRoute('homepage');
        }

        $category = new Category();
        $category->setUsername($this->getUser()->getUserName());

        $form = $this->createForm(CategoryFormType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($category);
            $this->entityManager->flush($category);

//            $request->getSession()->set('user_is_author', true);
//            $this->addFlash('success', 'Congratulations! You are now an author.');

            return $this->redirectToRoute('homepage');
        }

        return $this->render('admin/create_category.html.twig', [
            'form' => $form->createView()
        ]);
    }
}

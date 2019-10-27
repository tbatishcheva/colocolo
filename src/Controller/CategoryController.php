<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Category;
use App\Form\CategoryFormType;
use App\Form\EntryFormType;

/**
 * @Route("/admin")
 */
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
     * @Route("/category/create", name="category_create")
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

    /**
     * @Route("/create-entry", name="admin_create_entry")
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createEntryAction(Request $request)
    {
        $product = new Product();

        $category = $this->categoryRepository->findOneByUsername($this->getUser()->getUserName());
        $product->setCategory($category);

        $form = $this->createForm(EntryFormType::class, $product);
        $form->handleRequest($request);

        // Check is valid
        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($product);
            $this->entityManager->flush($product);

            $this->addFlash('success', 'Congratulations! Your Category is created');

            return $this->redirectToRoute('admin_entries');
        }

        return $this->render('admin/entry_form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/", name="admin_index")
     * @Route("/entries", name="admin_entries")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function entriesAction()
    {
        $category = $this->categoryRepository->findOneByUsername($this->getUser()->getUserName());

        $products = [];

        if ($category) {
            $products = $this->productRepository->findByCategory($category);
        }

        return $this->render('admin/entries.html.twig', [
            'products' => $products
        ]);
    }
}

<?php

namespace App\DataFixtures\ORM;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class Fixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $categoryToy = new Category();
        $categoryToy
            ->setName('Toys')
            ->setUsername('auth0-username')
        ;

        $manager->persist($categoryToy);

//        $categoryHMToy = new Category();
//        $categoryHMToy
//            ->setName('Hand made toys');
//
//        $manager->persist($categoryHMToy);

        $productRaccoon = new Product();
        $productRaccoon
            ->setName('Raccoon')
//            ->setDateAdded(DateTime::createFromFormat('j-M-Y', '15-Feb-2009'))
            ->setDescription('Lorem Ipsum is simply dummy text of the printing and typesetting industry.')
            ->setCategory($categoryToy)
            ->setSlug('first-post');
        $manager->persist($productRaccoon);

//        $productBear = new Product();
//        $productBear
//            ->setName('Raccoon')
//            ->setDateAdded()
//            ->setDescription('Lorem Ipsum is simply dummy text of the printing and typesetting industry.')
//            ->setCategory($categoryHMToy);
//        $manager->persist($productBear);

        $manager->flush();
    }
}

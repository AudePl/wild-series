<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class CategoryFixtures extends Fixture
{
    const CATEGORIES = [
        'Horreur',
        'Comédie',
        'Science-fiction',
        'Fantastique',
        'Policier',
    ];

    public function load(ObjectManager $manager)
    {
            foreach (self::CATEGORIES as $key => $categoryName) {
            $category = new Category();
            $category->setName($categoryName);

            $manager->persist($category);
            $this->addReference($categoryName, $category);
        }
        $manager->flush();
    }
}

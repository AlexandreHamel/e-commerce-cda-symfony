<?php

namespace App\DataFixtures;

use App\Entity\Categories;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;

class CategoriesFixtures extends Fixture
{
    private $counter = 1;

    public function __construct(private SluggerInterface $slugger){}

    public function load(ObjectManager $manager): void
    {
        $parent = $this->createCategory('Pièces', null, $manager);

        $this->createCategory('Cartes mères', $parent, $manager);
        $this->createCategory('Processeur', $parent, $manager);
        $this->createCategory('Mémoire PC', $parent, $manager);
        $this->createCategory('Carte graphique', $parent, $manager);

        $parent = $this->createCategory('Périphériques', null, $manager);

        $this->createCategory('Ecran', $parent, $manager);
        $this->createCategory('Souris', $parent, $manager);
        $this->createCategory('Clavier', $parent, $manager);
        $this->createCategory('Micro-casque', $parent, $manager);

        $manager->flush();
    }

    public function createCategory(string $name, Categories $parent = null, ObjectManager $manager)
    {
        $category = new Categories();
        $category->setName($name);
        $category->setSlug($this->slugger->slug($category->getName())->lower());
        $category->setParent($parent);
        $manager->persist($category);

        $this->addReference('cat-'.$this->counter, $category);
        $this->counter++;

        return $category;
    }
}

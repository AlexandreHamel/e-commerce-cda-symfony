<?php

namespace App\DataFixtures;

use App\Entity\Images;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class ImagesFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        for($img = 1; $img <= 30; $img++){
            $image = new Images();
            $image->setName($faker->imageUrl(640, 480, 'hardware', true));
            $product = $this->getReference('prod-'.rand(1, 10));
            $image->setProducts($product);
            $manager->persist($image);
        }

        $manager->flush();
    }

    // Execute Products avant Images
    public function getDependencies(): array
    {
        return [
            ProductsFixtures::class
        ];
    }
}

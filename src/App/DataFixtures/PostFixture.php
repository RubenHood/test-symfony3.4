<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PostFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $post = new Post();
        $post->setName('Priceless widget!');
        $post->setPrice(14.50);
        $post->setDescription('Ok, I guess it *does* have a price');
        $manager->persist($post);

        // add more products
        $manager->flush();

    }
}

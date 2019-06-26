<?php

namespace BlogBundle\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use BlogBundle\Entity\User;
use Faker\Factory;

class UserFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        //creamos un objeto faker
        $faker = Factory::create();

        for($i=0; $i<10; $i++){
            $user = new User();
            $user->setNAme($faker->unique()->firstNameFemale());
            $user->setMail($faker->unique()->email);
    
            $manager->persist($user);
            $manager->flush();
        }
    }
}

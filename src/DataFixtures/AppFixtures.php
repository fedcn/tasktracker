<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // create 20 users
        for ($i = 0; $i < 20; ++$i) {
            $user = new \App\Tasktracker\Entity\User("user{$i}", "user{$i}@gmail.com");
            $manager->persist($user);
        }

        $manager->flush();
    }
}

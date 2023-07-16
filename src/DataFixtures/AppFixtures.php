<?php

namespace App\DataFixtures;

use App\Factory\OrderFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        OrderFactory::createMany(10);

        $manager->flush();
    }
}

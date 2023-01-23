<?php

namespace App\DataFixtures;

use App\Entity\Home;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class HomeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $home = new Home();
        $home->setTitre('');
        $home->setTexte('');
        $home->setSignature('');
        $home->setIsActive(true);
        $manager->persist($home);

        $manager->flush();
    }
}

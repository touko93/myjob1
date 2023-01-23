<?php

namespace App\DataFixtures;

use App\Entity\Compagny;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CompagnyFixtures extends Fixture
{
    public const EDF = "Edf";
    public const CARREFOUR = "Carrefour";
    public const BB = "BB";

    public function load(ObjectManager $manager): void
    {
        $compagny = new Compagny();
        $compagny->setName('Edf');
        $compagny->setAdres('8 rue de pin 95470 Fosses');
        $compagny->setEmail('edf@gmail.com');
        $compagny->setPhone('09800566322');
        $compagny->setImageName('EDF.jpg');
        $compagny->setCategory('Btp');
        $compagny->setTag('#');
        $compagny->setSlug('Edf');
        $manager->persist($compagny);
        $this->setReference(self::EDF,$compagny);


        $compagny = new Compagny();
        $compagny->setName('Carrefour');
        $compagny->setAdres('458 avenue de la route 78963 Puteau');
        $compagny->setEmail('carrefour@gmail.com');
        $compagny->setPhone('09800599322');
        $compagny->setImageName('Carrefour.png');
        $compagny->setCategory('Distribution');
        $compagny->setTag('#');
        $compagny->setSlug('Carrefour');
        $manager->persist($compagny);
        $this->setReference(self::CARREFOUR,$compagny);

        $compagny = new Compagny();
        $compagny->setName('B&B');
        $compagny->setAdres('175 rue de pin 95470 st witz');
        $compagny->setEmail('b&b@gmail.com');
        $compagny->setPhone('09800566482');
        $compagny->setImageName('b&b.jpg');
        $compagny->setTag('#');
        $compagny->setCategory('Hotellerie');
        $compagny->setSlug('B&b');
        $manager->persist($compagny);
        $this->setReference(self::BB,$compagny);

        
        $manager->flush();
    }
}

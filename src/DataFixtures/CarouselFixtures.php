<?php

namespace App\DataFixtures;

use App\Entity\Carousel;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CarouselFixtures extends Fixture
{
    public const CAROUSEL_REFERENCE = 'carousel';
    public const CAROUSEL_1 = "carousel 1";
    public const CAROUSEL_2 = "carousel 2";
    public const CAROUSEL_3 = "carousel 3";
    public const CAROUSEL_4 = "carousel 4";

    public function load(ObjectManager $manager): void
    {
        $carousel = new Carousel();
        $carousel->setTag('cartes');
        $carousel->setImageName1('carousel1.jpg');
        $carousel->setImageName2('carousel1.1.jpg');
        $carousel->setImageName3('carousel1.0.jpg');
        $manager->persist($carousel);
        $this->setReference(self::CAROUSEL_1, $carousel);

        $carousel = new Carousel();
        $carousel->setTag('cartes');
        $carousel->setImageName1('entreprise1.0.jpg');
        $carousel->setImageName2('entreprise1.1.jpg');
        $carousel->setImageName3('entreprise1.2.jpg');
        $manager->persist($carousel);
        $this->setReference(self::CAROUSEL_2, $carousel);

        $carousel = new Carousel();
        $carousel->setTag('cartes');
        $carousel->setImageName1('entreprise1.jpg');
        $carousel->setImageName2('emploi1.0.jpg');
        $carousel->setImageName3('cv1.2.jpg');
        $manager->persist($carousel);
        $this->setReference(self::CAROUSEL_3, $carousel);

        $carousel = new Carousel();
        $carousel->setTag('cartes');
        $carousel->setImageName1('cv1.0.jpg');
        $carousel->setImageName2('cv1.1.jpg');
        $carousel->setImageName3('cv1.2.jpg');
        $manager->persist($carousel);
        $this->setReference(self::CAROUSEL_4, $carousel);


        $manager->flush();
    }
}

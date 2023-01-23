<?php

namespace App\DataFixtures;


use App\Entity\Cartes;
use App\DataFixtures\CarouselFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CartesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $cartes = new Cartes();
        $cartes->setTitre('Inscription');
        $cartes->setTexte('Espace Candidats');
        $cartes->setTag('home');
        $cartes->setImageName('');
        $cartes->setCarousel($this->getReference((CarouselFixtures::CAROUSEL_1)));
        $manager->persist($cartes);

        $cartes = new Cartes();
        $cartes->setTitre('Inscription');
        $cartes->setTexte('Espace Entreprise');
        $cartes->setTag('home');
        $cartes->setImageName('');
        $cartes->setCarousel($this->getReference((CarouselFixtures::CAROUSEL_2)));
        $manager->persist($cartes);

        $cartes = new Cartes();
        $cartes->setTitre('Consulter');
        $cartes->setTexte('Espace Annonces');
        $cartes->setTag('home');
        $cartes->setImageName('');
        $cartes->setCarousel($this->getReference((CarouselFixtures::CAROUSEL_3)));
        $manager->persist($cartes);

        $cartes = new Cartes();
        $cartes->setTitre('Consulter');
        $cartes->setTexte('Espace Formations');
        $cartes->setTag('home');
        $cartes->setImageName('');
        $cartes->setCarousel($this->getReference((CarouselFixtures::CAROUSEL_4)));
        $manager->persist($cartes);
        


        $manager->flush();
    }
}

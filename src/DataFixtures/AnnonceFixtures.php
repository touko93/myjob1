<?php

namespace App\DataFixtures;

use App\Entity\Annonce;
use App\DataFixtures\CompagnyFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class AnnonceFixtures extends Fixture implements DependentFixtureInterface
{
    public const BTP = "Btp";
    public const ADMINISTRATIF_SECRETARIAT ="Administratif/Secrétariat";
    public const AGRICULTURE = "Agriculture";
    public const AGROALIMENTAIRE ="agroalimentaire";
    public const BANQUE_ASSURANCE ="banque & assurance";
    public const COMMERCE_DISTRIBUTION = "Commerce/Distribution";
    public const HOTELERIE = "Hôtellerie";
    public const INDUSTRIE = "Industrie";
    public const LOGISTIQUE = "Logistique";
    public const WEB_INFORMATIQUE = "Web/Informatique";
    public const TRANSPORT = "Transport";

    public function load(ObjectManager $manager): void
    {
        $annonce = new Annonce();
        $annonce->setName('Btp');
        $annonce->setTag('#');
        $annonce->setText('#');
        $annonce->setTitle('#');
        $annonce->setImageFile();
        $annonce->setImageName('#');
        $annonce->setCompagny($this->getReference(CompagnyFixtures::EDF));
        $manager->persist($annonce);
        $this->setReference(self::BTP, $annonce);

        $annonce = new Annonce();
        $annonce->setName('Administratif/Secrétariat');
        $annonce->setTag('#');
        $annonce->setText('#');
        $annonce->setTitle('#');
        $annonce->setImageFile();
        $annonce->setImageName('#');
        $annonce->setCompagny($this->getReference(CompagnyFixtures::BB));
        $manager->persist($annonce);
        $this->setReference(self::ADMINISTRATIF_SECRETARIAT, $annonce);

        $annonce = new Annonce();
        $annonce->setName('Agriculture');
        $annonce->setTag('#');
        $annonce->setText('#');
        $annonce->setTitle('#');
        $annonce->setImageFile();
        $annonce->setImageName('#');
        $annonce->setCompagny($this->getReference(CompagnyFixtures::BB));
        $manager->persist($annonce);
        $this->setReference(self::AGRICULTURE, $annonce);

        $annonce = new Annonce();
        $annonce->setName('Agroalimentaire');
        $annonce->setTag('#');
        $annonce->setText('#');
        $annonce->setTitle('#');
        $annonce->setImageFile();
        $annonce->setImageName('#');
        $annonce->setCompagny($this->getReference(CompagnyFixtures::CARREFOUR));
        $manager->persist($annonce);
        $this->setReference(self::AGROALIMENTAIRE, $annonce);

        $annonce = new Annonce();
        $annonce->setName('Banque & Assurance');
        $annonce->setTag('#');
        $annonce->setText('#');
        $annonce->setTitle('#');
        $annonce->setImageFile();
        $annonce->setImageName('#');
        $annonce->setCompagny($this->getReference(CompagnyFixtures::EDF));
        $manager->persist($annonce);
        $this->setReference(self::BANQUE_ASSURANCE, $annonce);

        $annonce = new Annonce();
        $annonce->setName('Commerce/Distribution');
        $annonce->setTag('#');
        $annonce->setText('#');
        $annonce->setTitle('#');
        $annonce->setImageFile();
        $annonce->setImageName('#');
        $annonce->setCompagny($this->getReference(CompagnyFixtures::CARREFOUR));
        $manager->persist($annonce);
        $this->setReference(self::COMMERCE_DISTRIBUTION, $annonce);

        $annonce = new Annonce();
        $annonce->setName('Hôtellerie');
        $annonce->setTag('#');
        $annonce->setText('#');
        $annonce->setTitle('#');
        $annonce->setImageFile();
        $annonce->setImageName('#');
        $annonce->setCompagny($this->getReference(CompagnyFixtures::BB));
        $manager->persist($annonce);
        $this->setReference(self::HOTELERIE, $annonce);

        $annonce = new Annonce();
        $annonce->setName('Industrie');
        $annonce->setTag('#');
        $annonce->setText('#');
        $annonce->setTitle('#');
        $annonce->setImageFile();
        $annonce->setImageName('#');
        $annonce->setCompagny($this->getReference(CompagnyFixtures::CARREFOUR));
        $manager->persist($annonce);
        $this->setReference(self::INDUSTRIE, $annonce);

        $annonce = new Annonce();
        $annonce->setName('Logistique');
        $annonce->setTag('#');
        $annonce->setText('#');
        $annonce->setTitle('#');
        $annonce->setImageFile();
        $annonce->setImageName('#');
        $annonce->setCompagny($this->getReference(CompagnyFixtures::BB));
        $manager->persist($annonce);
        $this->setReference(self::LOGISTIQUE, $annonce);

        $annonce = new Annonce();
        $annonce->setName('Web/Informatique');
        $annonce->setTag('#');
        $annonce->setText('#');
        $annonce->setTitle('#');
        $annonce->setImageFile();
        $annonce->setImageName('#');
        $annonce->setCompagny($this->getReference(CompagnyFixtures::EDF));
        $manager->persist($annonce);
        $this->setReference(self::WEB_INFORMATIQUE, $annonce);

        $annonce = new Annonce();
        $annonce->setName('Transport');
        $annonce->setTag('#');
        $annonce->setText('#');
        $annonce->setTitle('#');
        $annonce->setImageFile();
        $annonce->setImageName('#');
        $annonce->setCompagny($this->getReference(CompagnyFixtures::CARREFOUR));
        $manager->persist($annonce);
        $this->setReference(self::TRANSPORT, $annonce);

        $manager->flush();
    }
    public function getDependencies()
    {
        return[
            CompagnyFixtures::class,
        ];
    }
}

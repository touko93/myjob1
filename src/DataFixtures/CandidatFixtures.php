<?php

namespace App\DataFixtures;

use App\Entity\Candidat;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CandidatFixtures extends Fixture
{
    public const SEBASTIEN_SOGUERO = "sebastien sooguero";
    public const ANTHONY_SIRA = "anthony sira";
    public const SARAH_PIRAT = "sarah pirat";
    public const LUCAS_ROUAT = "lucas rouat";
    public const MIGUEL_RIVERS = "miguel rivers";
    public const IMEN_BOULBI = "imen boulbi";
    public function load(ObjectManager $manager): void
    {
        $candidat = new Candidat();
        $candidat->setFirstName('Sebastien');
        $candidat->setLastName('Soguero');
        $candidat->setIsActive(true);
        $candidat->setSlug('soguero-sebatien');
        $candidat->setEmail('s.sebastien@gmail.com');
        $candidat->setTag('#');
        $candidat->setAdres('5 rue renoir 93120 LaCourneuve');
        $candidat->setPhone('0665548596');
        $candidat->setImageName('cvsebastien.jpg');
        $manager->persist($candidat);
        $this->setReference(self::SEBASTIEN_SOGUERO, $candidat);

        $candidat = new Candidat();
        $candidat->setFirstName('Anthony');
        $candidat->setLastName('Sira');
        $candidat->setIsActive(true);
        $candidat->setTag('#');
        $candidat->setSlug('anthony-sira');
        $candidat->setEmail('s.anthony@gmail.com');
        $candidat->setAdres('18 rue Geneve 93120 LaCourneuve');
        $candidat->setPhone('0665548589');
        $candidat->setImageName('anthony.jpg');
        $manager->persist($candidat);
        $this->setReference(self::ANTHONY_SIRA, $candidat);
    

        $candidat = new Candidat();
        $candidat->setFirstName('Sarah');
        $candidat->setLastName('Pirat');
        $candidat->setTag('#');
        $candidat->setIsActive(true);
        $candidat->setSlug('sarah-pirat');
        $candidat->setEmail('s.pirat@gmail.com');
        $candidat->setAdres('20 rue du louvre 75012 paris');
        $candidat->setPhone('0665788589');
        $candidat->setImageName('cvsarah.jpg');
        $manager->persist($candidat);
        $this->setReference(self::SARAH_PIRAT, $candidat);

        $candidat = new Candidat();
        $candidat->setFirstName('Lucas');
        $candidat->setLastName('Rouat');
        $candidat->setTag('#');
        $candidat->setIsActive(true);
        $candidat->setSlug('lucas-rouat');
        $candidat->setEmail('L.rouat@gmail.com');
        $candidat->setAdres('78 avenue du parc 75018 paris');
        $candidat->setPhone('0612788589');
        $candidat->setImageName('cvlucas.jpg');
        $manager->persist($candidat);
        $this->setReference(self::LUCAS_ROUAT, $candidat);

        $candidat = new Candidat();
        $candidat->setFirstName('Miguel');
        $candidat->setLastName('Rivers');
        $candidat->setTag('#');
        $candidat->setIsActive(true);
        $candidat->setSlug('miguel-rivers');
        $candidat->setEmail('m.rivers@gmail.com');
        $candidat->setAdres('12 boulevard du cononel 75013 paris');
        $candidat->setPhone('0612745589');
        $candidat->setImageName('cvmiguel.jpg');
        $manager->persist($candidat);
        $this->setReference(self::MIGUEL_RIVERS, $candidat);

        $candidat = new Candidat();
        $candidat->setFirstName('Imen');
        $candidat->setLastName('Boulbi');
        $candidat->setTag('#');
        $candidat->setIsActive(true);
        $candidat->setSlug('imen-boulbi');
        $candidat->setEmail('i.boulbi@gmail.com');
        $candidat->setAdres('156 rue de la fléche 75019 paris');
        $candidat->setPhone('06127879589');
        $candidat->setImageName('cvimen.jpg');
        $manager->persist($candidat);
        $this->setReference(self::IMEN_BOULBI, $candidat);

        $manager->flush();
    }
}

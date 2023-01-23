<?php

namespace App\DataFixtures;

use App\Entity\Formation;
use DateTime;
use DateTimeImmutable;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class FormationFixtures extends Fixture
{
    public const FORGERON = "forgeron";
    public const ELECTRICIEN = "electricien";
    public const BOULANGER = "boulanger";
    public const DEVELLOPER_WEB = "develloper web";
    public function load(ObjectManager $manager): void
    {
        $formation = new Formation();
        $formation->setName("forgeron");
        $formation->setAdres("#");
        $formation->setUpdatedAt(new DateTimeImmutable());
        $formation->setImageName("#");
        $formation->setImageFile();
        $formation->setEmail("#");
        $formation->setPhone("#");
        $formation->setCategory("#");
        $formation->setSlug("#");
        $formation->setTag("#");
        $formation->setCompagny($this->getReference(CompagnyFixtures::BB));
        $manager->persist($formation);
        $this->setReference(self::FORGERON, $formation);

        $formation = new Formation();
        $formation->setName("electricien");
        $formation->setUpdatedAt(new DateTimeImmutable());
        $formation->setAdres("#");
        $formation->setImageName("#");
        $formation->setImageFile();
        $formation->setEmail("#");
        $formation->setPhone("#");
        $formation->setCategory("#");
        $formation->setSlug("#");
        $formation->setTag("#");
        $formation->setCompagny($this->getReference(CompagnyFixtures::EDF));
        $manager->persist($formation);
        $this->setReference(self::ELECTRICIEN, $formation);

        $formation = new Formation();
        $formation->setName("boulanger");
        $formation->setUpdatedAt(new DateTimeImmutable());
        $formation->setAdres("#");
        $formation->setImageName("#");
        $formation->setImageFile();
        $formation->setEmail("#");
        $formation->setPhone("#");
        $formation->setCategory("#");
        $formation->setSlug("#");
        $formation->setTag("#");
        $formation->setCompagny($this->getReference(CompagnyFixtures::EDF));
        $manager->persist($formation);
        $this->setReference(self::BOULANGER, $formation);

        $formation = new Formation();
        $formation->setName("developper web");
        $formation->setUpdatedAt(new DateTimeImmutable());
        $formation->setAdres("#");
        $formation->setImageName("#");
        $formation->setImageFile();
        $formation->setEmail("#");
        $formation->setPhone("#");
        $formation->setCategory("#");
        $formation->setSlug("#");
        $formation->setTag("#");
        $formation->setCompagny($this->getReference(CompagnyFixtures::CARREFOUR));
        $manager->persist($formation);
        $this->setReference(self::DEVELLOPER_WEB, $formation);

        $manager->flush();
    }
}

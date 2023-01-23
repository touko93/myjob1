<?php

namespace App\Entity;


use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CartesRepository;

#[ORM\Entity(repositoryClass: CartesRepository::class)]
class Cartes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $texte = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $tag = null;

    #[ORM\OneToOne(inversedBy: 'cartes', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Carousel $carousel = null;


    
    // #[ORM\Column(length: 255, nullable: true)]
    // private ?string $bouton = null;
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getTexte(): ?string
    {
        return $this->texte;
    }

    public function setTexte(string $texte): self
    {
        $this->texte = $texte;

        return $this;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageName(?string $imageName): self
    {
        $this->imageName = $imageName;

        return $this;
    }

    public function getTag(): ?string
    {
        return $this->tag;
    }

    public function setTag(?string $tag): self
    {
        $this->tag = $tag;

        return $this;
    }

    public function getCarousel(): ?Carousel
    {
        return $this->carousel;
    }

    public function setCarousel(Carousel $carousel): self
    {
        $this->carousel = $carousel;

        return $this;
    }
    
    // public function getBouton(): ?string
    // {
    //     return $this->bouton;
    // }

    // public function setBouton(?string $bouton): self
    // {
    //     $this->bouton = $bouton;

    //     return $this;
    // }
}

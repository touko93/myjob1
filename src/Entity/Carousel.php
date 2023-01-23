<?php

namespace App\Entity;

use App\Repository\CarouselRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: CarouselRepository::class)]
#[Vich\Uploadable]
class Carousel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageName = null;

    // REMARQUE : Il ne s'agit pas d'un champ mappé de métadonnées d'entité, mais simplement d'une simple propriété
    #[Vich\UploadableField(mapping: 'carousels', fileNameProperty: 'imageName')]
    private ?File $imageFile = null;

    #[Vich\UploadableField(mapping: 'carousels', fileNameProperty: 'imageName')]
    private ?File $imageFile2 = null;

    #[Vich\UploadableField(mapping: 'carousels', fileNameProperty: 'imageName')]
    private ?File $imageFile3 = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $text = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $tag = null;

    #[ORM\OneToOne(mappedBy: 'carousel', cascade: ['persist', 'remove'])]
    private ?Cartes $cartes = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageName1 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageName2 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageName3 = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

  

    public function getId(): ?int
    {
        return $this->id;
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

     /**
     * Si vous téléchargez manuellement un fichier (c'est-à-dire sans utiliser Symfony Form), assurez-vous qu'une instance
     * de 'UploadedFile' est injecté dans ce setter pour déclencher la mise à jour. Si cela
     * Le paramètre de configuration du bundle 'inject_on_load' est défini sur 'true' ce setter
     * doit pouvoir accepter une instance de 'File' car le bundle en injectera une ici
     * pendant l'hydratation Doctrine.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
        
            // Il faut qu'au moins un champ change si vous utilisez la doctrine
            // sinon les écouteurs d'événements ne seront pas appelés et le fichier sera perdu
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }
    public function setImageFile2(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
        
            // Il faut qu'au moins un champ change si vous utilisez la doctrine
            // sinon les écouteurs d'événements ne seront pas appelés et le fichier sera perdu
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile2(): ?File
    {
        return $this->imageFile;
    }

    public function setImageFile3(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
        
            // Il faut qu'au moins un champ change si vous utilisez la doctrine
            // sinon les écouteurs d'événements ne seront pas appelés et le fichier sera perdu
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile3(): ?File
    {
        return $this->imageFile;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(?string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

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

    public function getCartes(): ?Cartes
    {
        return $this->cartes;
    }

    public function setCartes(Cartes $cartes): self
    {
        // set the owning side of the relation if necessary
        if ($cartes->getCarousel() !== $this) {
            $cartes->setCarousel($this);
        }

        $this->cartes = $cartes;

        return $this;
    }

    public function getImageName1(): ?string
    {
        return $this->imageName1;
    }

    public function setImageName1(?string $imageName1): self
    {
        $this->imageName1 = $imageName1;

        return $this;
    }

    public function getImageName2(): ?string
    {
        return $this->imageName2;
    }

    public function setImageName2(?string $imageName2): self
    {
        $this->imageName2 = $imageName2;

        return $this;
    }

    public function getImageName3(): ?string
    {
        return $this->imageName3;
    }

    public function setImageName3(?string $imageName3): self
    {
        $this->imageName3 = $imageName3;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}

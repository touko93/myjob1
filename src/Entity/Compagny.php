<?php

namespace App\Entity;

use App\Repository\CompagnyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: CompagnyRepository::class)]
#[Vich\Uploadable]
class Compagny

    // ##################################################################### //
    // #######################PROPRIETES#################################### //
    // ##################################################################### //
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $adres = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $phone = null;

    #[ORM\Column(length: 255)]
    private ?string $imageName = null;

    #[Vich\UploadableField(mapping: 'compagnys', fileNameProperty: 'imageName')]
    private ?File $imageFile = null;


    #[ORM\Column(length: 255)]
    private ?string $category = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column(length: 255)]
    private ?string $tag = null;

    #[ORM\OneToMany(mappedBy: 'compagny', targetEntity: Annonce::class, orphanRemoval: true)]
    private Collection $annonces;

    #[ORM\OneToMany(mappedBy: 'compagny', targetEntity: Formation::class, orphanRemoval: true)]
    private Collection $formations;
    
    // ##################################################################### //
    // #######################CONSTRUCTEURS################################# //
    // ##################################################################### //

    public function __construct()
    {
        // $this->annonces = new ArrayCollection();
        $this->formations = new ArrayCollection();
    }

    // ##################################################################### //
    // #######################MAGIC FONCTION################################ //
    // ##################################################################### //

    public function __toString()
    {
    
        
        return $this->name;
    }

    // ##################################################################### //
    // #######################GUETTERS/SETTERS############################## //
    // ##################################################################### //

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAdres(): ?string
    {
        return $this->adres;
    }

    public function setAdres(string $adres): self
    {
        $this->adres = $adres;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
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

    public function setImageName(?string $imageName): self
    {
        $this->imageName = $imageName;

        return $this;
    }

    

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

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

    public function getTag(): ?string
    {
        return $this->tag;
    }

    public function setTag(string $tag): self
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * @return Collection<int, Annonce>
     */
    public function getAnnonces(): Collection
    {
        return $this->annonces;
    }

    public function addAnnonce(Annonce $annonce): self
    {
        if (!$this->annonces->contains($annonce)) {
            $this->annonces->add($annonce);
            $annonce->setCompagny($this);
        }

        return $this;
    }

    public function removeAnnonce(Annonce $annonce): self
    {
        if ($this->annonces->removeElement($annonce)) {
            // set the owning side to null (unless already changed)
            if ($annonce->getCompagny() === $this) {
                $annonce->setCompagny(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Formation>
     */
    public function getFormations(): Collection
    {
        return $this->formations;
    }

    public function addFormation(Formation $formation): self
    {
        if (!$this->formations->contains($formation)) {
            $this->formations->add($formation);
            $formation->setCompagny($this);
        }

        return $this;
    }

    public function removeFormation(Formation $formation): self
    {
        if ($this->formations->removeElement($formation)) {
            // set the owning side to null (unless already changed)
            if ($formation->getCompagny() === $this) {
                $formation->setCompagny(null);
            }
        }

        return $this;
    }




}

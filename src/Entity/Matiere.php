<?php

namespace App\Entity;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MatiereRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MatiereRepository::class)]
#[ApiResource]
class Matiere
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nomMatiere;

    #[ORM\Column(type: 'string', length: 255)]
    private $description;

    #[ORM\Column(type: 'string', length: 255)]
    private $contenu;

    #[ORM\OneToMany(mappedBy: 'matiere', targetEntity: TypeMatiere::class, orphanRemoval: true)]
    private $typematiere;

    #[ORM\ManyToMany(targetEntity: Niveau::class)]
    private $niveau;

    #[ORM\Column(type: 'string', length: 255)]
    private $matiere;

    public function __construct()
    {
        $this->typematiere = new ArrayCollection();
        $this->niveau = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomMatiere(): ?string
    {
        return $this->nomMatiere;
    }

    public function setNomMatiere(string $nomMatiere): self
    {
        $this->nomMatiere = $nomMatiere;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * @return Collection<int, TypeMatiere>
     */
    public function getTypematiere(): Collection
    {
        return $this->typematiere;
    }

    public function addTypematiere(TypeMatiere $typematiere): self
    {
        if (!$this->typematiere->contains($typematiere)) {
            $this->typematiere[] = $typematiere;
            $typematiere->setMatiere($this);
        }

        return $this;
    }

    public function removeTypematiere(TypeMatiere $typematiere): self
    {
        if ($this->typematiere->removeElement($typematiere)) {
            // set the owning side to null (unless already changed)
            if ($typematiere->getMatiere() === $this) {
                $typematiere->setMatiere(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Niveau>
     */
    public function getNiveau(): Collection
    {
        return $this->niveau;
    }

    public function addNiveau(Niveau $niveau): self
    {
        if (!$this->niveau->contains($niveau)) {
            $this->niveau[] = $niveau;
        }

        return $this;
    }

    public function removeNiveau(Niveau $niveau): self
    {
        $this->niveau->removeElement($niveau);

        return $this;
    }

    public function getMatiere(): ?string
    {
        return $this->matiere;
    }

    public function setMatiere(string $matiere): self
    {
        $this->matiere = $matiere;

        return $this;
    }
}

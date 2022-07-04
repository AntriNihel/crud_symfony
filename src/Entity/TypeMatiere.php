<?php

namespace App\Entity;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TypeMatiereRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeMatiereRepository::class)]
#[ApiResource(

    collectionOperations: [
       'get',
        'post',
    ],
    itemOperations: [
        'get',
        'put',
        'delete',
       'patch',
       'get_nomtypematiere' => [ 'route_name' => 'nom_get_typematiere',
        'openapi_context' => [
          "parameters" => [
          "id" => [
          "name" => "id",
          "in" => "path",
          "required" => false,
          ],               
          "nomTypeMatiere"=> [
          "name" => "nomTypeMatiere",
          "in" => "path",
          "description" => "The nomTypeMatiere of your typeMatiere",
          "type" => "string",
          "required" => true,
    ],
   ],
 ],
],
],
)]

class TypeMatiere
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nomtypeMatiere;

    #[ORM\Column(type: 'integer')]
    private $numeroTypeMatiere;

    #[ORM\ManyToOne(targetEntity: Matiere::class, inversedBy: 'typematiere')]
    #[ORM\JoinColumn(nullable: false)]
    private $matiere;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomtypeMatiere(): ?string
    {
        return $this->nomtypeMatiere;
    }

    public function setNomtypeMatiere(string $nomtypeMatiere): self
    {
        $this->nomtypeMatiere = $nomtypeMatiere;

        return $this;
    }

    public function getNumeroTypeMatiere(): ?int
    {
        return $this->numeroTypeMatiere;
    }

    public function setNumeroTypeMatiere(int $numeroTypeMatiere): self
    {
        $this->numeroTypeMatiere = $numeroTypeMatiere;

        return $this;
    }

    public function getMatiere(): ?Matiere
    {
        return $this->matiere;
    }

    public function setMatiere(?Matiere $matiere): self
    {
        $this->matiere = $matiere;

        return $this;
    }
}

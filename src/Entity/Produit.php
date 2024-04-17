<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $idproduit =null;

    #[ORM\Column(length: 255)]
    private ?string $nomproduit;

    #[ORM\Column]
    private ?int $prixproduit =null;

    #[ORM\Column(length: 255)]
    private ?string $tailleproduit;

    #[ORM\Column(length: 255)]
    private ?string $type;

    #[ORM\Column]
    private ?int $qauntiteproduit =null;

    #[ORM\Column(length: 255)]
    private ?string $image;

    #[ORM\ManyToOne(inversedBy: 'produits')]
    private ?Category $category = null;

    public function getIdproduit(): ?int
    {
        return $this->idproduit;
    }

    public function getNomproduit(): ?string
    {
        return $this->nomproduit;
    }

    public function setNomproduit(string $nomproduit): static
    {
        $this->nomproduit = $nomproduit;

        return $this;
    }

    public function getPrixproduit(): ?int
    {
        return $this->prixproduit;
    }

    public function setPrixproduit(int $prixproduit): static
    {
        $this->prixproduit = $prixproduit;

        return $this;
    }

    public function getTailleproduit(): ?string
    {
        return $this->tailleproduit;
    }

    public function setTailleproduit(string $tailleproduit): static
    {
        $this->tailleproduit = $tailleproduit;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getQauntiteproduit(): ?int
    {
        return $this->qauntiteproduit;
    }

    public function setQauntiteproduit(int $qauntiteproduit): static
    {
        $this->qauntiteproduit = $qauntiteproduit;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }
    public function getTitle(): ?Category
    {
        return $this->category.title;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }


}

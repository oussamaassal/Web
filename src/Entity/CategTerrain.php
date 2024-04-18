<?php

namespace App\Entity;

use App\Repository\CategTerrainRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategTerrainRepository::class)]
class CategTerrain
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'categTerrain', targetEntity: Terrain::class)]
    private Collection $terrains;

    public function __construct()
    {
        $this->terrains = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }


    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Terrain>
     */
    public function getTerrains(): Collection
    {
        return $this->terrains;
    }

    public function addTerrain(Terrain $terrain): static
    {
        if (!$this->terrains->contains($terrain)) {
            $this->terrains->add($terrain);
            $terrain->setCategTerrain($this);
        }

        return $this;
    }

    public function removeTerrain(Terrain $terrain): static
    {
        if ($this->terrains->removeElement($terrain)) {
            // set the owning side to null (unless already changed)
            if ($terrain->getCategTerrain() === $this) {
                $terrain->setCategTerrain(null);
            }
        }

        return $this;
    }
}

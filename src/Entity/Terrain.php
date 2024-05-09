<?php

namespace App\Entity;

use App\Repository\TerrainRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TerrainRepository::class)]
class Terrain
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomTerrain = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column]
    private ?float $geoX;

    #[ORM\Column]
    private ?float $geoY;

    #[ORM\Column]
    private ?DateTime $ouverture;

    #[ORM\Column]
    private ?DateTime $fermeture;

    #[ORM\Column(length: 255)]
    private ?string $datedispo = null;

    #[ORM\ManyToOne(inversedBy: 'terrains')]
    private ?CategTerrain $categTerrain = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomTerrain(): ?string
    {
        return $this->nomTerrain;
    }

    public function setNomTerrain(string $nomTerrain): self
    {
        $this->nomTerrain = $nomTerrain;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getGeoX(): ?float
    {
        return $this->geoX;
    }

    public function setGeoX(?float $geoX): self
    {
        $this->geoX = $geoX;

        return $this;
    }

    public function getGeoY(): ?float
    {
        return $this->geoY;
    }

    public function setGeoY(?float $geoY): self
    {
        $this->geoY = $geoY;

        return $this;
    }

    public function getOuverture(): ?\DateTimeInterface
    {
        return $this->ouverture;
    }

    public function setOuverture(?\DateTimeInterface $ouverture): self
    {
        $this->ouverture = $ouverture;

        return $this;
    }

    public function getFermeture(): ?\DateTimeInterface
    {
        return $this->fermeture;
    }

    public function setFermeture(?\DateTimeInterface $fermeture): self
    {
        $this->fermeture = $fermeture;

        return $this;
    }

    public function getDatedispo(): ?string
    {
        return $this->datedispo;
    }

    public function setDatedispo(?string $datedispo): self
    {
        $this->datedispo = $datedispo;

        return $this;
    }

    public function getCategTerrain(): ?CategTerrain
    {
        return $this->categTerrain;
    }

    public function setCategTerrain(?CategTerrain $categTerrain): static
    {
        $this->categTerrain = $categTerrain;

        return $this;
    }

}
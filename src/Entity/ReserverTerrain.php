<?php

namespace App\Entity;

use App\Repository\ReserverTerrainRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReserverTerrainRepository::class)]
class ReserverTerrain
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $terrain = null;

    #[ORM\Column]
    private ?int $nbp = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255)]
    private ?string $horaire = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTerrain(): ?string
    {
        return $this->terrain;
    }

    public function setTerrain(string $terrain): static
    {
        $this->terrain = $terrain;

        return $this;
    }

    public function getNbp(): ?int
    {
        return $this->nbp;
    }

    public function setNbp(int $nbp): static
    {
        $this->nbp = $nbp;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getHoraire(): ?string
    {
        return $this->horaire;
    }

    public function setHoraire(string $horaire): static
    {
        $this->horaire = $horaire;

        return $this;
    }
}

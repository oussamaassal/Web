<?php

namespace App\Entity;

use App\Repository\RencontreRepository;
use DateTime;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RencontreRepository::class)]
class Rencontre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $idrencontre =null;

    #[ORM\Column]
    private ?DateTime $daterebcontre;

    #[ORM\Column(length: 255)]
    private ?string $adversaire;

    #[ORM\Column(length: 255)]
    private ?string $score;

    public function getIdrencontre(): ?int
    {
        return $this->idrencontre;
    }

    public function getDaterebcontre(): ?\DateTimeInterface
    {
        return $this->daterebcontre;
    }

    public function setDaterebcontre(\DateTimeInterface $daterebcontre): static
    {
        $this->daterebcontre = $daterebcontre;

        return $this;
    }

    public function getAdversaire(): ?string
    {
        return $this->adversaire;
    }

    public function setAdversaire(string $adversaire): static
    {
        $this->adversaire = $adversaire;

        return $this;
    }

    public function getScore(): ?string
    {
        return $this->score;
    }

    public function setScore(string $score): static
    {
        $this->score = $score;

        return $this;
    }


}

<?php

namespace App\Entity;

use App\Repository\ContratRepository;
use DateTime;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: ContratRepository::class)]
class Contrat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $contratId =null;

    #[ORM\Column]
    private ?DateTime $dateDebut;

    #[ORM\Column]
    private ?DateTime $dateFin;

    #[ORM\Column]
    private ?int $salaire =null;

    #[ORM\ManyToOne(inversedBy:'Contrat')]
    private $employee;

    public function getContratId(): ?int
    {
        return $this->contratId;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(?\DateTimeInterface $dateDebut): static
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(?\DateTimeInterface $dateFin): static
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getSalaire(): ?int
    {
        return $this->salaire;
    }

    public function setSalaire(int $salaire): static
    {
        $this->salaire = $salaire;

        return $this;
    }

    public function getEmployee(): ?Joueur
    {
        return $this->employee;
    }

    public function setEmployee(?Joueur $employee): static
    {
        $this->employee = $employee;

        return $this;
    }


}

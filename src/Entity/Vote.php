<?php

namespace App\Entity;


use App\Repository\VoteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VoteRepository::class)]
class Vote
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $idv =null;

    // #[ORM\Column]
    // private ?int $idcandidatv =null;
 
    // #[ORM\Column]
    // private ?int $idelectionv =null;

    #[ORM\ManyToOne(targetEntity: Candidat::class)]
    #[ORM\JoinColumn(name: 'idcandidatv', referencedColumnName: 'idc')]
    private ?Candidat $candidat;

    #[ORM\ManyToOne(targetEntity: Evenement::class)]
    #[ORM\JoinColumn(name: 'idelectionv', referencedColumnName: 'ide')]
    private ?Evenement $evenement;

    public function getIdv(): ?int
    {
        return $this->idv;
    }

    public function getIdcandidatv(): ?int
    {
        return $this->idcandidatv;
    }

    public function setIdcandidatv(int $idcandidatv): static
    {
        $this->idcandidatv = $idcandidatv;

        return $this;
    }

    public function getIdelectionv(): ?int
    {
        return $this->idelectionv;
    }

    public function setIdelectionv(int $idelectionv): static
    {
        $this->idelectionv = $idelectionv;

        return $this;
    }


}

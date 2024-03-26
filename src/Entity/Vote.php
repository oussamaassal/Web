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

    #[ORM\Column]
    private ?int $idcandidatv =null;
 
    #[ORM\Column]
    private ?int $idelectionv =null;

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

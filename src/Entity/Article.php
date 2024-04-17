<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $idarticle =null;

    #[ORM\Column(length: 255)]
    private ?string $titre;

    #[ORM\Column(length: 255)]
    private ?string $description;

    #[ORM\Column(length: 255)]
    private ?string $image;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'articles')]
    #[ORM\JoinColumn(name: 'idjournaliste_id', referencedColumnName: 'iduser')]
    private ?User $idjournaliste;

    public function getIdarticle(): ?int
    {
        return $this->idarticle;
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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getIdjournaliste(): ?User
    {
        return $this->idjournaliste;
    }

    public function setIdjournaliste(?User $idjournaliste): static
    {
        $this->idjournaliste = $idjournaliste;

        return $this;
    }


}

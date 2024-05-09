<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
class CategorySearch
{
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category")
     */
    private $category;
    public function getCategory(): ?CategTerrain
    {
        return $this->category;
    }
    public function setCategory(?CategTerrain $category): self
    {
        $this->category = $category;
        return $this;
    }
}

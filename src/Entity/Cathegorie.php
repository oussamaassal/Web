<?php

namespace App/Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cathegorie
 *
 * @ORM\Table(name="cathegorie")
 * @ORM\Entity
 */
class Cathegorie
{
    /**
     * @var string
     *
     * @ORM\Column(name="Type", type="string", length=255, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $type;


}

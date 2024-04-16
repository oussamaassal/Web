<?php

namespace App/Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Evenementelectoral
 *
 * @ORM\Table(name="evenementelectoral")
 * @ORM\Entity
 */
class Evenementelectoral
{
    /**
     * @var int
     *
     * @ORM\Column(name="IdEvenement", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idevenement;

    /**
     * @var string
     *
     * @ORM\Column(name="Localisation", type="string", length=255, nullable=false)
     */
    private $localisation;


}

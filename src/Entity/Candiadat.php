<?php

namespace App/Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Candiadat
 *
 * @ORM\Table(name="candiadat")
 * @ORM\Entity
 */
class Candiadat
{
    /**
     * @var int
     *
     * @ORM\Column(name="IdCandidat", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcandidat;

    /**
     * @var string
     *
     * @ORM\Column(name="Nom", type="string", length=255, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="Prenom", type="string", length=255, nullable=false)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="string", length=500, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="Role", type="string", length=255, nullable=false)
     */
    private $role;


}

<?php

namespace App\Models\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Uloga
 *
 * @ORM\Table(name="uloga")
 * @ORM\Entity
 */
class Uloga
{
    /**
     * @var int
     *
     * @ORM\Column(name="idUlo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idulo;

    /**
     * @var string
     *
     * @ORM\Column(name="naziv", type="string", length=45, nullable=false)
     */
    private $naziv;


}

<?php

namespace App\Models\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Usluga
 *
 * @ORM\Table(name="usluga", indexes={@ORM\Index(name="fkIdMajstrora_idx", columns={"idMaj"})})
 * @ORM\Entity
 */
class Usluga
{
    /**
     * @var int
     *
     * @ORM\Column(name="idUsl", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idusl;

    /**
     * @var string
     *
     * @ORM\Column(name="naziv", type="string", length=45, nullable=false)
     */
    private $naziv;

    /**
     * @var string
     *
     * @ORM\Column(name="opis", type="text", length=0, nullable=false)
     */
    private $opis;

    /**
     * @var float
     *
     * @ORM\Column(name="cena", type="float", precision=10, scale=0, nullable=false)
     */
    private $cena;

    /**
     * @var \App\Models\Entities\Korisnik
     *
     * @ORM\ManyToOne(targetEntity="App\Models\Entities\Korisnik")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idMaj", referencedColumnName="idKor")
     * })
     */
    private $idmaj;


}

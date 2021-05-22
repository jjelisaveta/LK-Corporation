<?php

namespace App\Models\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Zahtev
 *
 * @ORM\Table(name="zahtev", indexes={@ORM\Index(name="fk_IdKor_idx", columns={"idKor"}), @ORM\Index(name="fk_idTer_zahtev_idx", columns={"idTer"})})
 * @ORM\Entity
 */
class Zahtev
{
    /**
     * @var int
     *
     * @ORM\Column(name="idZah", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idzah;

    /**
     * @var string
     *
     * @ORM\Column(name="opis", type="text", length=0, nullable=false)
     */
    private $opis;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="vremeSlanja", type="datetime", nullable=false)
     */
    private $vremeslanja;

    /**
     * @var \App\Models\Entities\Korisnik
     *
     * @ORM\ManyToOne(targetEntity="App\Models\Entities\Korisnik")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idKor", referencedColumnName="idKor")
     * })
     */
    private $idkor;

    /**
     * @var \App\Models\Entities\Termin
     *
     * @ORM\ManyToOne(targetEntity="App\Models\Entities\Termin")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idTer", referencedColumnName="idTer")
     * })
     */
    private $idter;


}

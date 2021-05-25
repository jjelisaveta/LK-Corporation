<?php

namespace App\Models\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Kalendar
 *
 * @ORM\Table(name="kalendar", indexes={@ORM\Index(name="fk_idRez_idx", columns={"idRez"}), @ORM\Index(name="fk_idTer_idx", columns={"idTer"})})
 * @ORM\Entity
 */
class Kalendar
{
    /**
     * @var int
     *
     * @ORM\Column(name="idMaj", type="integer", nullable=false)
     */
    private $idmaj;

    /**
     * @var int
     *
     * @ORM\Column(name="idKal", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idkal;

    /**
     * @var \App\Models\Entities\Rezervacija
     *
     * @ORM\ManyToOne(targetEntity="App\Models\Entities\Rezervacija")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idRez", referencedColumnName="idRez")
     * })
     */
    private $idrez;

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

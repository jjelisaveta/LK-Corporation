<?php

namespace App\Models\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * UslugaOstvarena
 *
 * @ORM\Table(name="usluga-ostvarena", indexes={@ORM\Index(name="fk_idRez_uslugaOstvarena_idx", columns={"idRez"}), @ORM\Index(name="fk_idUsl_uslugaOtvorena_idx", columns={"idUsl"})})
 * @ORM\Entity
 */
class UslugaOstvarena
{
    /**
     * @var int
     *
     * @ORM\Column(name="idUslOstv", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iduslostv;

    /**
     * @var string|null
     *
     * @ORM\Column(name="komentar", type="text", length=0, nullable=true)
     */
    private $komentar;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ocena", type="string", length=1, nullable=true)
     */
    private $ocena;

    /**
     * @var string
     *
     * @ORM\Column(name="obrisano", type="string", length=1, nullable=false)
     */
    private $obrisano;

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
     * @var \App\Models\Entities\Usluga
     *
     * @ORM\ManyToOne(targetEntity="App\Models\Entities\Usluga")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUsl", referencedColumnName="idUsl")
     * })
     */
    private $idusl;


}

<?php

namespace App\Models\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rezervacija
 *
 * @ORM\Table(name="rezervacija", uniqueConstraints={@ORM\UniqueConstraint(name="id_UNIQUE", columns={"id"})}, indexes={@ORM\Index(name="fk_idMaj_idx", columns={"idMaj"})})
 * @ORM\Entity
 */
class Rezervacija
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     *
     */
    private $id;


    /**
     * @var \App\Models\Entities\Zahtev
     * @ORM\ManyToOne(targetEntity="App\Models\Entities\Zahtev")
     * @ORM\JoinColumn(name="idRez", referencedColumnName="idZah")
     */
    public $idRez;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="vremeOdgovora", type="datetime", nullable=false)
     */
    public $vremeodgovora;

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

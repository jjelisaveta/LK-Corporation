<?php

namespace App\Models\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rezervacija
 *
 * @ORM\Table(name="rezervacija", uniqueConstraints={@ORM\UniqueConstraint(name="idRez_UNIQUE", columns={"idRez"})}, indexes={@ORM\Index(name="fk_idMaj_idx", columns={"idMaj"})})
 * @ORM\Entity
 */
class Rezervacija
{
    /**
     * @var int
     *
     * @ORM\Column(name="idRez", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idrez;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="vremeOdgovora", type="datetime", nullable=false)
     */
    private $vremeodgovora;

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

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


    /**
     * @var \App\Models\Entities\Usluga
     *
     * @ORM\ManyToOne(targetEntity="App\Models\Entities\Usluga")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUsl", referencedColumnName="idUsl")
     * })
     */
    private $idusl;


    /**
     *
     * @var App\Models\Entities\Korisnik[]
     *
     * Many Groups have Many Users.
     * @ORM\ManyToMany(targetEntity="App\Models\Entities\Korisnik", mappedBy="zahtevi")
     */
    private $majstori;


    public function __construct()
    {
        $this->majstori = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * @return \App\Models\Entities\Usluga
     */
    public function getIdusl(): Usluga
    {
        return $this->idusl;
    }

    /**
     * @param \App\Models\Entities\Usluga $idusl
     */
    public function setIdusl(\App\Models\Entities\Usluga $idusl): void
    {
        $this->idusl = $idusl;
    }

    /**
     * @return \App\Models\Entities\Korisnik[]
     */
    public function getMajstori()
    {
        return $this->majstori;
    }

    /**
     * @param \App\Models\Entities\Korisnik[] $majstori
     */
    public function setMajstori($majstori): void
    {
        $this->majstori = $majstori;
    }


    /**
     * Get opis.
     *
     * @return string
     */
    public function getOpis()
    {
        return $this->opis;
    }


    /**
     * Set opis.
     *
     * @param string $opis
     *
     * @return Zahtev
     */
    public function setOpis($opis)
    {
        $this->opis = $opis;
        return this;
    }

    /**
     * Set sadrzaj.
     *
     * @param Korisnik \App\Models\Entities\Korisnik|null $idKor
     *
     * @return Zahtev
     */
    public function setIdkor(\App\Models\Entities\Korisnik $idKor = null)
    {
        $this->idkor = $idKor;
        return this;
    }

    /**
     * Get idkor.
     *
     * @return \App\Models\Entities\Korisnik|null
     */
    public function getIdkor()
    {
        return $this->idkor;
    }

}

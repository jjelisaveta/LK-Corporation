<?php

namespace App\Models\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Korisnik
 *
 * @ORM\Table(name="korisnik", indexes={@ORM\Index(name="fkUlogaKorisnik_idx", columns={"idUlo"})})
 * @ORM\Entity
 */
class Korisnik
{
    /**
     * @var int
     *
     * @ORM\Column(name="idKor", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idkor;

    /**
     * @var string
     *
     * @ORM\Column(name="ime", type="string", length=45, nullable=false)
     */
    private $ime;

    /**
     * @var string
     *
     * @ORM\Column(name="prezime", type="string", length=45, nullable=false)
     */
    private $prezime;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=45, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="brojTelefona", type="string", length=15, nullable=false)
     */
    private $brojtelefona;

    /**
     * @var string
     *
     * @ORM\Column(name="lozinka", type="string", length=20, nullable=false)
     */
    private $lozinka;

    /**
     * @var string
     *
     * @ORM\Column(name="adresa", type="string", length=101, nullable=false)
     */
    private $adresa;

    /**
     * @var string|null
     *
     * @ORM\Column(name="slika", type="text", length=0, nullable=true)
     */
    private $slika;

    /**
     * @var string
     *
     * @ORM\Column(name="odobren", type="string", length=1, nullable=false)
     */
    private $odobren;

    /**
     * @var \App\Models\Entities\Uloga
     *
     * @ORM\ManyToOne(targetEntity="App\Models\Entities\Uloga")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUlo", referencedColumnName="idUlo")
     * })
     */
    private $idulo;
    
    public function getIme(){
        return $this->ime;
    }


    /**
     * Get ime.
     *
     * @return string
     */
    public function getIme()
    {
        return $this->ime;
    }


    /**
     * Set ime.
     *
     * @param string $ime
     *
     * @return Korisnik
     */
    public function setIme($ime)
    {
        $this->ime = $ime;
        return this;
    }

    /**
     * Get prezime.
     *
     * @return string
     */
    public function getPrezime()
    {
        return $this->prezime;
    }


    /**
     * Set prezime.
     *
     * @param string $prezime
     *
     * @return Korisnik
     */
    public function setPrezime($prezime)
    {
        $this->prezime = $prezime;
        return this;
    }

    /**
     * Get adresa.
     *
     * @return string|null
     */
    public function getAdresa()
    {
        return $this->adresa;
    }


    /**
     * Set adresa.
     *
     * @param string|null $adresa
     *
     * @return Korisnik
     */
    public function setAdresa(string $adresa = null)
    {
        $this->adresa = $adresa;
        return this;
    }
}


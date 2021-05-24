<?php

namespace App\Models\Entities;

use Doctrine\ORM\Mapping as ORM;
use \App\Models\Entities\Tag;

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
    public $idmaj;

    /**
     *
     * @var Tag[]
     *
     * Many Usluga have Many Tags.
     * @ORM\ManyToMany(targetEntity="Tag")
     * @ORM\JoinTable(name="uslugatag",
     *      joinColumns={@ORM\JoinColumn(name="idUsl", referencedColumnName="idUsl")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="idTag", referencedColumnName="idTag")}
     *      )
     */
    private $tagovi;


    public function __construct()
    {
        $this->tagovi = new \Doctrine\Common\Collections\ArrayCollection();
    }


    public function getIdusl(): int
    {
        return $this->idusl;
    }

    public function getNaziv(): string
    {
        return $this->naziv;
    }

    public function getOpis(): string
    {
        return $this->opis;
    }

    public function getCena(): float
    {
        return $this->cena;
    }

    public function getIdmaj(): \App\Models\Entities\Korisnik
    {
        return $this->idmaj;
    }

    public function getTagovi()
    {
        return $this->tagovi;
    }

    public function setIdusl(int $idusl): void
    {
        $this->idusl = $idusl;
    }

    public function setNaziv(string $naziv): void
    {
        $this->naziv = $naziv;
    }

    public function setOpis(string $opis): void
    {
        $this->opis = $opis;
    }

    public function setCena(float $cena): void
    {
        $this->cena = $cena;
    }

    public function setIdmaj(\App\Models\Entities\Korisnik $idmaj): void
    {
        $this->idmaj = $idmaj;
    }

    public function setTagovi($tagovi): void
    {
        $this->tagovi = $tagovi;
    }


}

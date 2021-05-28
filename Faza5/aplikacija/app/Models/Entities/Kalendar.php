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
     * @var int
     *
     * @ORM\Column(name="idRez", type="integer", nullable=true)
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

    /**
     * @return int
     */
    public function getIdmaj(): int
    {
        return $this->idmaj;
    }

    /**
     * @param int $idmaj
     */
    public function setIdmaj(int $idmaj): void
    {
        $this->idmaj = $idmaj;
    }

    /**
     * @return int
     */
    public function getIdkal(): int
    {
        return $this->idkal;
    }

    /**
     * @param int $idkal
     */
    public function setIdkal(int $idkal): void
    {
        $this->idkal = $idkal;
    }

    /**
     * @return int
     */
    public function getIdrez(): int
    {
        return $this->idrez;
    }

    /**
     * @param int $idrez
     */
    public function setIdrez(int $idrez): void
    {
        $this->idrez = $idrez;
    }

    /**
     * @return Termin
     */
    public function getIdter(): Termin
    {
        return $this->idter;
    }

    /**
     * @param Termin $idter
     */
    public function setIdter(Termin $idter): void
    {
        $this->idter = $idter;
    }


}

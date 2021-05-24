<?php

namespace App\Models\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * UslugaOstvarena
 *
 * @ORM\Table(name="uslugaostvarena", indexes={@ORM\Index(name="fk_idRez_uslugaOstvarena_idx", columns={"id"}), @ORM\Index(name="fk_idUsl_uslugaOtvorena_idx", columns={"idUsl"})})
 * @ORM\Entity(repositoryClass="App\Models\Repositories\UslugaOstvarenaRepository")
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
     * @ORM\ManyToOne(targetEntity="App\Models\Entities\Rezervacija")
     * @ORM\JoinColumn(name="idRez", referencedColumnName="id")
     */

    private $idrez;


    /**
     * @var \App\Models\Entities\Usluga
     * @ORM\ManyToOne(targetEntity="App\Models\Entities\Usluga")
     * @ORM\JoinColumn(name="idUsl", referencedColumnName="idUsl")
     */
    private $idusl;

    public function getIduslostv(): int
    {
        return $this->iduslostv;
    }

    public function getKomentar(): ?string
    {
        return $this->komentar;
    }

    public function getOcena(): ?string
    {
        return $this->ocena;
    }

    public function getObrisano(): string
    {
        return $this->obrisano;
    }

    public function getIdrez(): \App\Models\Entities\Rezervacija
    {
        return $this->idrez;
    }

    public function getIdusl(): \App\Models\Entities\Usluga
    {
        return $this->idusl;
    }

    public function setIduslostv(int $iduslostv): void
    {
        $this->iduslostv = $iduslostv;
    }

    public function setKomentar(?string $komentar): void
    {
        $this->komentar = $komentar;
    }

    public function setOcena(?string $ocena): void
    {
        $this->ocena = $ocena;
    }

    public function setObrisano(string $obrisano): void
    {
        $this->obrisano = $obrisano;
    }

    public function setIdrez(\App\Models\Entities\Rezervacija $idrez): void
    {
        $this->idrez = $idrez;
    }

    public function setIdusl(\App\Models\Entities\Usluga $idusl): void
    {
        $this->idusl = $idusl;
    }


}

<?php

namespace App\Models\Entities;

use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\This;

/**
 * Tag
 *
 * @ORM\Table(name="tag")
 * @ORM\Entity
 */
class Tag
{
    /**
     * @var int
     *
     * @ORM\Column(name="idTag", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idtag;

    /**
     * @var string
     *
     * @ORM\Column(name="opis", type="string", length=45, nullable=false)
     */
    private $opis;


    /**
     *
     * @var Usluga[]
     *
     * Many Tags have Many Uslugas.
     * @ORM\ManyToMany(targetEntity="App\Models\Entities\Usluga", mappedBy="tagovi")
     */
    protected $usluge;


    public function __construct() {
        $this->usluge = new \Doctrine\Common\Collections\ArrayCollection();
    }


    public function getIdtag(): int
    {
        return $this->idtag;
    }

    public function getOpis(): string
    {
        return $this->opis;
    }

    public function getUsluge()
    {
        return $this->usluge;
    }

    public function setIdtag(int $idtag): Tag
    {
        $this->idtag = $idtag;
        return this;
    }

    public function setOpis(string $opis): Tag
    {
        $this->opis = $opis;
        return this;
    }

    public function setUsluge($usluge): void {
        $this->usluge = $usluge;
    }


}
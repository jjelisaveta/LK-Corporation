<?php

namespace App\Models\Entities;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\ManyToMany(targetEntity="\App\Models\Entities\Usluga", mappedBy="tagovi")
     */
    protected $usluge;

    
    public function __construct() {
        $this->usluge = new \Doctrine\Common\Collections\ArrayCollection();
    }


    public function getIdtag(): int {
        return $this->idtag;
    }

    public function getOpis(): string {
        return $this->opis;
    }

    public function getUsluge() {
        return $this->usluge;
    }

    public function setIdtag(int $idtag): void {
        $this->idtag = $idtag;
    }

    public function setOpis(string $opis): void {
        $this->opis = $opis;
    }

    public function setUsluge($usluge): void {
        $this->usluge = $usluge;
    }


}

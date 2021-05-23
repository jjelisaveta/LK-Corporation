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
     * @ORM\OneToMany(targetEntity="App\Models\Entities\UslugaTag", 
     * mappedBy="idTag",
     * cascade={"persist","remove"}, orphanRemoval=TRUE )
     */
    protected $usluge;

    
    public function __construct() {
        $this->usluge = new \Doctrine\Common\Collections\ArrayCollection();
    }



}

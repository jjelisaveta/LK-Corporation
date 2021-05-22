<?php

namespace App\Models\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * UslugaTag
 *
 * @ORM\Table(name="usluga-tag", indexes={@ORM\Index(name="fk_idTag_usluga-tag_idx", columns={"idTag"}), @ORM\Index(name="fk_idUsl_usuga-tag_idx", columns={"idUsl"})})
 * @ORM\Entity
 */
class UslugaTag
{
    /**
     * @var int
     *
     * @ORM\Column(name="idUslTag", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idusltag;

    /**
     * @var \App\Models\Entities\Tag
     *
     * @ORM\ManyToOne(targetEntity="App\Models\Entities\Tag")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idTag", referencedColumnName="idTag")
     * })
     */
    private $idtag;

    /**
     * @var \App\Models\Entities\Usluga
     *
     * @ORM\ManyToOne(targetEntity="App\Models\Entities\Usluga")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUsl", referencedColumnName="idUsl")
     * })
     */
    private $idusl;


}

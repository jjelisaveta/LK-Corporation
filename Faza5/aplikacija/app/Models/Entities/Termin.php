<?php

namespace App\Models\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Termin
 *
 * @ORM\Table(name="termin")
 * @ORM\Entity
 */
class Termin
{
    /**
     * @var int
     *
     * @ORM\Column(name="idTer", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idter;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datumVreme", type="datetime", nullable=false)
     */
    private $datumvreme;

    /**
     * @return int
     */
    public function getIdter(): int
    {
        return $this->idter;
    }

    /**
     * @param int $idter
     */
    public function setIdter(int $idter): void
    {
        $this->idter = $idter;
    }


}

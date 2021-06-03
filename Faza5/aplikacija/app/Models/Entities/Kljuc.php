<?php

namespace App\Models\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Kljuc
 *
 * @ORM\Table(name="kljuc")
 * @ORM\Entity(repositoryClass="App\Models\Repositories\KljucRepository")
 */
class Kljuc
{
    /**
     * @var int
     *
     * @ORM\Column(name="idkljuc", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idkljuc;

    /**
     * @var int
     *
     * @ORM\Column(name="vrednost", type="integer", nullable=false)
     */
    private $vrednost;

    /**
     * @return int
     */
    public function getIdkljuc(): int
    {
        return $this->idkljuc;
    }

    /**
     * @param int $idkljuc
     */
    public function setIdkljuc(int $idkljuc): void
    {
        $this->idkljuc = $idkljuc;
    }

    /**
     * @return int
     */
    public function getVrednost(): int
    {
        return $this->vrednost;
    }

    /**
     * @param int $vrednost
     */
    public function setVrednost(int $vrednost): void
    {
        $this->vrednost = $vrednost;
    }


}

<?php


namespace App\Models\Repositories;

/*
 * klasa se koristi kao repozitorijum za klasu Kjuc
 *
 *
 * dohvata i inrekmentira kljuc iz baze
 *
 * @return int
 */
class KljucRepository extends \Doctrine\ORM\EntityRepository
{

    public function dohvatiSledeci()
    {
        $kljuc = $this->findAll()[0];
        $ret = $kljuc->getVrednost();
        $kljuc->setVrednost($ret + 1);
        $this->getEntityManager()->persist($kljuc);
        $this->getEntityManager()->flush();
        return $ret;
    }

}
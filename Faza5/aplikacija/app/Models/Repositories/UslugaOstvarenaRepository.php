<?php


namespace App\Models\Repositories;


class UslugaOstvarenaRepository extends \Doctrine\ORM\EntityRepository
{
    public function dohvatiOstvareneUslugeMajstora($id)
    {
        $upit = $this->getEntityManager()->createQueryBuilder();
        $upit->select('o')
            ->from('App\Models\Entities\UslugaOstvarena', 'o')
            ->join('App\Models\Entities\Usluga', 'u', 'idusl')
            ->where($upit->expr()->eq('u.idmaj', ':idUsluge'))
            ->setParameter('idUsluge', $id);
        return $upit->getQuery()->getResult();
    }
    public function dohvatiOstvareneUsluge()
    {
        $upit = $this->getEntityManager()->createQueryBuilder();
        $upit->select('o')
            ->from('App\Models\Entities\UslugaOstvarena', 'o')
            ->join('App\Models\Entities\Usluga', 'u', 'idusl');
        return $upit->getQuery()->getResult();
    }
}
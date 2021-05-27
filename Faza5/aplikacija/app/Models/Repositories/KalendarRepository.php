<?php


namespace App\Models\Repositories;


class KalendarRepository extends \Doctrine\ORM\EntityRepository
{

    public function dohvatiMajstorRezervisan($idMaj,$date)
    {
        $upit = $this->getEntityManager()->createQueryBuilder();
        $upit->select('k')
            ->from('App\Models\Entities\Kalendar', 'k')
            ->where($upit->expr()->eq('k.idmaj', $idMaj))
            ->where($upit->expr()->between('k.datumVreme'))
            ->where($upit->expr()->isNotNull('k.idrez'));
        return $upit->getQuery()->getResult();
    }

}
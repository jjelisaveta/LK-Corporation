<?php


namespace App\Models\Repositories;


class ZahtevRepository extends \Doctrine\ORM\EntityRepository
{
    public function dohvatiZahteveMajstoraAktivne($id)
    {
        $upit = $this->getEntityManager()->createQueryBuilder();
        $upit->select('z')
            ->from('App\Models\Entities\Zahtev', 'z')
            ->join('App\Models\Entities\Usluga', 'u', 'WITH', 'u.idusl=z.idusl')
            ->where($upit->expr()->andX(
                $upit->expr()->eq('u.idmaj', $id)),
                $upit->expr()->gt('z.identifikator', 0));
        return $upit->getQuery()->getResult();
    }

    public function dohvatiMajstorTermin($idMaj, $idTer, $idZah)
    {
        $upit = $this->getEntityManager()->createQueryBuilder();
        $upit->select('z')
            ->from('App\Models\Entities\Zahtev', 'z')
            ->join('App\Models\Entities\Usluga', 'u', 'WITH', 'u.idusl=z.idusl')
            ->where($upit->expr()->andX(
                $upit->expr()->eq('u.idmaj', '?1')),
                $upit->expr()->eq('z.idter', '?2'),
                $upit->expr()->neq('z.idzah', '?3'))
            ->setParameter('1', $idMaj)
            ->setParameter('2', $idTer)
            ->setParameter('3', $idZah);
        return $upit->getQuery()->getResult();
    }

    public function dohvatiIdentifikatorZahteve($idZah, $identifikator)
    {
        $upit = $this->getEntityManager()->createQueryBuilder();
        $upit->select('z')
            ->from('App\Models\Entities\Zahtev', 'z')
            ->join('App\Models\Entities\Usluga', 'u', 'WITH', 'u.idusl=z.idusl')
            ->where($upit->expr()->andX(
                $upit->expr()->neq('z.idzah', '?1')),
                $upit->expr()->eq('z.identifikator', '?2'))
            ->setParameter('1', $idZah)
            ->setParameter('2', $identifikator);
        return $upit->getQuery()->getResult();
    }

    public function dohvatiIdentifikator()
    {
        $upit = $this->getEntityManager()->createQueryBuilder();
        $upit->select('z')
            ->from('App\Models\Entities\Zahtev', 'z')
            ->orderBy('z.identifikator', 'DESC');
        return $upit->getQuery()->getResult();
    }
}
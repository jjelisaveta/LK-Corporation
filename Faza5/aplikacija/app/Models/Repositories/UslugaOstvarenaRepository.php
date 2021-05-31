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
    public function dohvatiUslugeKorisnika($idKor)
    {
       $upit = $this->getEntityManager()->createQueryBuilder();
       $upit->select('o')
       ->from('App\Models\Entities\UslugaOstvarena', 'o')
       ->join('App\Models\Entities\Usluga', 'u', 'WITH', 'u.idusl=o.idusl')
       ->join('App\Models\Entities\Rezervacija', 'r', 'WITH', 'o.idrez=r.id')
       ->join('App\Models\Entities\Zahtev', 'z', 'WITH', 'r.idrez=z.idzah')
       ->join('App\Models\Entities\Korisnik', 'k', 'WITH', 'u.idmaj=k.idkor')
       ->join('App\Models\Entities\Termin', 't', 'WITH', 'z.idter=t.idter')
       ->where($upit->expr()->andX(
         $upit->expr()->eq('o.obrisano', '?1'),
         $upit->expr()->eq('z.idkor', '?2')))
         ->setParameter('1', 0)
         ->setParameter('2', $idKor);
        
       return $upit->getQuery()->getResult();
   
   
    }
}
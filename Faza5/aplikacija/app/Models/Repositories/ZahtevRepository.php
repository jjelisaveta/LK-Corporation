<?php


namespace App\Models\Repositories;

/*
 * ova klasa se koristi kao repozitorijum za entitet Zahtev
 *
 */
class ZahtevRepository extends \Doctrine\ORM\EntityRepository
{
    /*
     * dohvata sve zahteve zadatog majstora koji jos uvek nisu rezervisani
     *
     * @param int $id
     *
     * @return Zahtev[]
     */
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
    /*
     * dohvata sve zahteve zadatog majstora u odredjenom terminu koji nisu jednaki sa idZah
     *
     * @param int $idMaj
     * @param int @idTer
     * @param int @idZah
     *
     * @return Zahtev[]
     */
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
    /*
     * dohvata sve zahteve sa prosledjenim identifikatorom koji nisu jednaki sa idZah
     *
     * @param int @idZah
     * @param int $identifikator
     *
     * @return Zahtev[]
     */
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

    /*
     *ovo se ne koristi
     *
     */
//    public function dohvatiIdentifikator()
//    {
//        $upit = $this->getEntityManager()->createQueryBuilder();
//        $upit->select('z')
//            ->from('App\Models\Entities\Zahtev', 'z')
//            ->orderBy('z.identifikator', 'DESC');
//        return $upit->getQuery()->getResult();
//    }
}
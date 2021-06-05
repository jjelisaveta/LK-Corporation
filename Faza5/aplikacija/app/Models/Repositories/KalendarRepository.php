<?php


namespace App\Models\Repositories;

/*
 * klasa koja se koristi kao repozitorijum za entitet tipa Kalendar
 *
 *
 */
class KalendarRepository extends \Doctrine\ORM\EntityRepository
{
    /*
     * funkcija vraca sve rezervacije majstora za odredjeni dan
     *
     * @param int $idMaj
     * @param string date
     *
     * @return Kalendar[]
     */
    public function dohvatiMajstorRezervisan($idMaj, $date)
    {
        $kraj = \DateTime::createFromFormat('Y-m-d H:i', $date . '23:59');
        $date = \DateTime::createFromFormat('Y-m-d H:i', $date . '00:00');
        $upit = $this->getEntityManager()->createQueryBuilder();
        $upit->select('k')
            ->from('App\Models\Entities\Kalendar', 'k')
            ->join('App\Models\Entities\Termin', 't', 'WITH', 'k.idter=t.idter')
            ->where($upit->expr()->andX(
                $upit->expr()->eq('k.idmaj', '?1'),
                $upit->expr()->isNotNull('k.idrez')))
            ->andWhere('t.datumvreme BETWEEN :from AND :to')
            ->setParameters(['from' => $date, 'to' => $kraj, '1' => $idMaj]);
        return $upit->getQuery()->getResult();
    }

    /*
     * funkcija vraca sve slobodne termine majstora za zadati dan
     *
     * @param int $idMaj
     * @param string date
     *
     * @return Kalendar[]
     */
    public function dohvatiMajstorSlobodan($idMaj, $date)
    {
        $kraj = \DateTime::createFromFormat('Y-m-d H:i', $date . '23:59');
        $date = \DateTime::createFromFormat('Y-m-d H:i', $date . '00:00');
        $upit = $this->getEntityManager()->createQueryBuilder();
        $upit->select('k')
            ->from('App\Models\Entities\Kalendar', 'k')
            ->join('App\Models\Entities\Termin', 't', 'WITH', 'k.idter=t.idter')
            ->where($upit->expr()->andX(
                $upit->expr()->eq('k.idmaj', '?1'),
                $upit->expr()->isNull('k.idrez')))
            ->andWhere('t.datumvreme BETWEEN :from AND :to')
            ->setParameters(['from' => $date, 'to' => $kraj, '1' => $idMaj]);
        return $upit->getQuery()->getResult();
    }

    /*
     * funkcija vraca sve slobodne termine majstora
     *
     * @param int $idMaj
     *
     * @return Kalendar[]
     */
    public function dohvatiSveSlobodneZaMajstora($idMaj){
        $upit = $this->getEntityManager()->createQueryBuilder();
        $upit->select('k')
            ->from('App\Models\Entities\Kalendar', 'k')
            ->join('App\Models\Entities\Termin', 't', 'WITH', 'k.idter=t.idter')
            ->where($upit->expr()->andX(
                $upit->expr()->eq('k.idmaj', '?1'),
                $upit->expr()->isNull('k.idrez')))
                ->setParameters(['1' => $idMaj]);
        return $upit->getQuery()->getResult();
    }
}
<?php

namespace App\Models;

use CodeIgniter\Model;

class KalendarModel extends Model
{
    protected $table = "kalendar";
    protected $returnType = "object";
    protected $primaryKey = 'idKal';
    protected $allowedFields = ['idMaj', 'idTer', 'idRez'];

    public function dohvatiMajstorSlobodan($idMaj, $date)
    {
        return $this->join('termin', 'idTer')->where('idMaj', $idMaj)
            ->where('datumVreme BETWEEN "' . date('Y-m-d', strtotime($date)) . '" and "' . date('Y-m-d H:i', strtotime($date . "23:59")) . '"')
            ->where('idRez', null)
            ->findAll();
    }


}
<?php

namespace App\Models;

use CodeIgniter\Model;

class KalendarModel extends Model
{
    protected $table = "kalendar";
    protected $returnType = "objectgit";
    protected $allowedFields = ['idMaj', 'idTer', 'idRez'];
}
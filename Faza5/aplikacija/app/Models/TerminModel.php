<?php namespace App\Models;

use CodeIgniter\Model;

class TerminModel extends Model
{
    protected $table = 'termin';
    protected $primaryKey = 'idTer';
    protected $returnType = 'object';


    protected $allowedFields = ['datumVreme'];   //polja koja se menjaju

}




<?php namespace App\Models;
use CodeIgniter\Model;

class TerminModel extends Model
{
    protected $table      = 'termin';
    protected $primaryKey = 'idTer';
    protected $returnType = 'array';


    protected $allowedFields = ['opis'];   //polja koja se menjaju

}




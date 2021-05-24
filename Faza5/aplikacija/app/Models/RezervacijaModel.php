<?php

namespace App\Models;


use CodeIgniter\Model;

class RezervacijaModel extends Model
{
    protected $table = 'rezervacija';
    protected $primaryKey = 'idRez';
    protected $returnType = 'object';


    protected $allowedFields = ['idMaj', 'vremeOdgovora'];   

}
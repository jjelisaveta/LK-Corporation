<?php namespace App\Models;

use CodeIgniter\Model;

class UslugaModel extends Model
{
    protected $table = 'usluga';
    protected $primaryKey = 'idUsl';
    protected $returnType = 'object';


    protected $allowedFields = ['naziv', 'opis', 'cena', 'idMaj'];   //polja koja se menjaju
}
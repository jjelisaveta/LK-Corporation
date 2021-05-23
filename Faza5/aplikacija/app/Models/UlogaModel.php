<?php namespace App\Models;

use CodeIgniter\Model;

class KorisnikModel extends Model
{
    protected $table = 'uloga';
    protected $primaryKey = 'idUlo';
    protected $returnType = 'object';


    protected $allowedFields = ['IdUlo','naziv'];   

}
<?php namespace App\Models;

use CodeIgniter\Model;
class UslugaOstvarenaModel extends Model

{
    protected $table = 'usluga-ostvarena';
    protected $primaryKey = 'idUslOstv';
    protected $returnType = 'object';

    protected $allowedFields = ['idUsl','komentar','ocena','obrisano','idRez'];   //polja koja se menjaju
}
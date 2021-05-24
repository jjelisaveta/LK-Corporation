<?php namespace App\Models;

use CodeIgniter\Model;
class UslugaOstvarenaModel extends Model

{
    protected $table = 'usluga-ostvarena';
    protected $primaryKey = 'idUslOstvTag';
    protected $returnType = 'object';

    $UslugaOstvarenaModel = new UslugaOstvarenaModel();
    $ostvareneUsluge = $UslugaOstvarenaModel->findAll();
    protected $allowedFields = ['idUsl','komentar','ocena','obrisano','idRez'];   //polja koja se menjaju
}
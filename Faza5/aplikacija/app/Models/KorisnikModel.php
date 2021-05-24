<?php

namespace App\Models;


use CodeIgniter\Model;

class KorisnikModel extends Model
{
    protected $table = 'korisnik';
    protected $primaryKey = 'idKor';
    protected $returnType = 'object';


    protected $allowedFields = ['idKor', 'ime', 'prezime', 'email', 'brojTelefona', 'lozinka', 'adresa', 'slika', 'idUlo', 'odobren'];   

}
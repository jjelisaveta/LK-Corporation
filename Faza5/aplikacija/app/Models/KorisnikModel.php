<?php

namespace App\Models;

use CodeIgniter\Model;

class KorisnikModel extends Model
{
    protected $table = "korisnik";
    protected $returnType = "object";
    protected $primaryKey = 'idKor';
    protected $allowedFields = ['ime', 'prezime', 'email', 'brojTelefona',
        'lozinka', 'adresa', 'slika', 'idUlo', 'odobren'];


}
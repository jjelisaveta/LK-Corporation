<?php

namespace App\Models;

use CodeIgniter\Model;

class ZahtevModel extends Model
{
    protected $table = "zahtev";
    protected $returnType = "object";
    protected $primaryKey = 'idZah';
    protected $allowedFields = ['idUsl', 'idKor', 'idTer', 'opis', 'vremeSlanja', 'identifikator'];

    public function dohvatiCeoOpis($idZah)
    {
        $termin = $this->join('korisnik', 'idKor')->where('idZah', $idZah)->first();
        $opis = $termin->ime . " " . $termin->prezime . ";" . $termin->adresa . ";" . $termin->opis;
        return $opis;
    }

}
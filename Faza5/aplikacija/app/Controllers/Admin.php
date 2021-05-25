<?php

namespace App\Controllers;

use App\Models\UslugaOstvarenaModel;
use App\Models\RezervacijaModel;
use App\Models\KorisnikModel;
use App\Models\UslugaModel;
use App\Models\ZahtevModel;
use App\Models\TerminModel;
class Admin extends BaseController
{
    protected function prikaz($stranica, $podaci)
    {
        $podaci['controller'] = "Admin";
        $podaci['ime'] = 'Code';
        $podaci['prezime'] = 'Igniter';
        echo view("osnova/header");
        echo view("osnova/meni", $podaci);
        echo view("klijent/$stranica", $podaci);
        echo view("osnova/footer");
    }
}
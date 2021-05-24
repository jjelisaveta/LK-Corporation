<?php namespace App\Libraries;

class MojaUslugaMajstor {
    
    public function prikazUsluge($naslov, $opis){
        return view("klijent/komponente/uslugaIstorija", ['naslov' => $naslov, 'opis' => $opis]);
    }
}

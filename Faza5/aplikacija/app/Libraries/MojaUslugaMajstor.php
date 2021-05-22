<?php namespace App\Libraries;

class MojaUslugaMajstor {
    
    public function prikazUsluge($naslov, $opis){
        return view("majstor/komponente/mojaUsluga", ['naslov' => $naslov, 'opis' => $opis]);
    }
}

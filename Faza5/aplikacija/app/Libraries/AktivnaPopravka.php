<?php namespace App\Libraries;

class AktivnaPopravka {
    
    public function prikazUsluge($imeMajstor, $datumPopravke,$opis){
        return view("klijent/komponente/popravkaAktivna", ['imeMajstor' => $imeMajstor, 'datumPopravke' => $datumPopravke,'opis'=>$opis]);
    }
}


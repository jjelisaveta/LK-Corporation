<?php namespace App\Libraries;

class UslugaIstorija {
    
    public function prikazUsluge($imeMajstor, $datumPopravke,$komentar,$ocena,$id,$naziv){
        return view("klijent/komponente/uslugaIstorija", ['imeMajstor' => $imeMajstor, 'datumPopravke' => $datumPopravke,'komentar'=>$komentar,
        'ocena'=>$ocena,'id'=>$id,'naziv'=>$naziv]);
    }
}


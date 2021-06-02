<?php namespace App\Libraries;

class UslugaIstorija {
    
    public function istorija($imeMajstor,$prezime ,$datumPopravke,$komentar,$ocena,$id,$opis,$slika){
        return view("klijent/komponente/uslugaIstorija", ['imeMajstor' => $imeMajstor,'prezime'=>$prezime, 'datumPopravke' => $datumPopravke,'komentar'=>$komentar,
        'ocena'=>$ocena,'id'=>$id,'opis'=>$opis,'slika'=>$slika]);
    }
}


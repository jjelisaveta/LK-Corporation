<?php namespace App\Libraries;

class AktivnaPopravka
{

    public function aktivnePopravke($imeMajstor,$prezime, $datumPopravke, $opis, $num,$slika)
    {
        return view("klijent/komponente/popravkaAktivna", ['imeMajstor' => $imeMajstor,'prezime'=>$prezime, 'datumPopravke' => $datumPopravke, 'opis' => $opis, 'num' => $num,'slika'=>$slika]);
    }
}


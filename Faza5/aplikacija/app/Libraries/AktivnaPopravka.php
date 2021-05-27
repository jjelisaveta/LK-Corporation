<?php namespace App\Libraries;

class AktivnaPopravka
{

    public function prikazUsluge($imeMajstor,$prezime, $datumPopravke, $opis, $num)
    {
        return view("klijent/komponente/popravkaAktivna", ['imeMajstor' => $imeMajstor,'prezime'=>$prezime, 'datumPopravke' => $datumPopravke, 'opis' => $opis, 'num' => $num]);
    }
}


<?php namespace App\Libraries;

class AktivnaPopravka
{

    public function prikazUsluge($imeMajstor, $datumPopravke, $opis, $num)
    {
        return view("klijent/komponente/popravkaAktivna", ['imeMajstor' => $imeMajstor, 'datumPopravke' => $datumPopravke, 'opis' => $opis, 'num' => $num]);
    }
}


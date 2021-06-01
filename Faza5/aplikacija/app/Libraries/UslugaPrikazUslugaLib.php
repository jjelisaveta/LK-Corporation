<?php namespace App\Libraries;

class UslugaPrikazUslugaLib
{

    public function prikazUsluge($naslov, $opis, $id, $tagovi, $cenaUsluge, $prep, $slika)
    {
        return view("komponente/uslugaPrikazUsluga", ['naslov' => $naslov, 'opis' => $opis, 'id' => $id,
            'tagovi'=>$tagovi, 'cenaUsluge'=>$cenaUsluge, 'prep'=>$prep, 'slika'=>$slika]);
    }
}



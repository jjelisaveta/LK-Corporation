<?php namespace App\Libraries;

class MojaUslugaMajstor
{

    public function prikazUsluge($naslov, $opis, $id, $tagovi, $majstor, $cena)
    {
        return view("majstor/komponente/mojaUsluga", ['naslov' => $naslov, 'opis' => $opis, 'id' => $id, 
            'tagovi'=>$tagovi, 'majstor'=>$majstor, 'cena'=>$cena]);
    }
}

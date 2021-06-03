<?php namespace App\Libraries;

class MojaUslugaMajstor
{

    public function prikazUsluge($naslov, $opis, $id, $tagovi, $majstor)
    {
        return view("majstor/komponente/mojaUsluga", ['naslov' => $naslov, 'opis' => $opis, 'id' => $id, 'tagovi'=>$tagovi, 'majstor'=>$majstor]);
    }
}

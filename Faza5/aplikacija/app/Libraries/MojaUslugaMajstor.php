<?php namespace App\Libraries;

class MojaUslugaMajstor
{

    public function prikazUsluge($naslov, $opis, $id)
    {
        return view("majstor/komponente/mojaUsluga", ['naslov' => $naslov, 'opis' => $opis, 'id' => $id]);
    }
}

<?php namespace App\Libraries;

class UslugaPrikazMajstora
{

    public function prikazUsluge($naslov, $opis, $id, $tagovi)
    {
        return view("komponente/uslugaPrikazMajstora", ['naslov' => $naslov, 'opis' => $opis, 'id' => $id, 'tagovi'=>$tagovi]);
    }
}

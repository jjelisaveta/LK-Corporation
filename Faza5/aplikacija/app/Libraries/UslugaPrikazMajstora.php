<?php

class UslugaPrikazMajstora
{

    public function prikazMajstora($naslov, $opis, $id, $tagovi)
    {
        return view("komponente/uslugaPrikazMajstora", ['naslov' => $naslov, 'opis' => $opis, 'id' => $id, 'tagovi'=>$tagovi]);
    }
}

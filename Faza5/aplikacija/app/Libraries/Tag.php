<?php namespace App\Libraries;

class Tag
{
    public function prikazTag($opis)
    {
        return view("majstor/komponente/tag", ['opis' => $opis]);
    }
}

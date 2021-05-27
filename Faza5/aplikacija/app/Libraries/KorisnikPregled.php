<?php namespace App\Libraries;

class KorisnikPregled
{

    public function prikazUsluge($ime)
    {
        return view("admin/komponente/korisnik", ['ime'=>$ime]);
    }
}

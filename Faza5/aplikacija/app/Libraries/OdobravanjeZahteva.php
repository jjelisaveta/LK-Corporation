<?php namespace App\Libraries;

class OdobravanjeZahteva
{

    public function prikazUsluge($ime, $prezime, $adresa, $opis, $id, $datumVreme)
    {
        return view("majstor/komponente/zahtev",
            ['ime' => $ime, 'prezime' => $prezime, 'adresa' => $adresa, 'opis' => $opis, 'id' => $id, 'datumVreme' => $datumVreme]);
    }
}

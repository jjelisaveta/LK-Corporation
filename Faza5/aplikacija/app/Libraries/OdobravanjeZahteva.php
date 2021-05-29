<?php namespace App\Libraries;

class OdobravanjeZahteva
{

    public function prikazUsluge($ime, $prezime, $adresa, $opis, $id)
    {
        return view("majstor/komponente/zahtev", ['ime' => $ime, 'prezime' => $prezime, 'adresa' => $adresa, 'opis' => $opis, 'id' => $id]);
    }
}

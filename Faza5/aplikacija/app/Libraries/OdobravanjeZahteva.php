<?php namespace App\Libraries;

class OdobravanjeZahteva
{

    public function prikazZahteva($ime, $prezime, $adresa, $opis, $id, $datumVreme,$slika)
    {
        return view("majstor/komponente/zahtev",
            ['ime' => $ime, 'prezime' => $prezime, 'adresa' => $adresa, 'opis' => $opis, 'id' => $id, 'datumVreme' => $datumVreme,'slika'=>$slika]);
    }
}

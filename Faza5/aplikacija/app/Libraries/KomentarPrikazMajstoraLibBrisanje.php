<?php namespace App\Libraries;

 
class KomentarPrikazMajstoraLibBrisanje
{

    public function prikazKomentara($komentar, $korisnik, $idOstvUsl)
    {
        return view("komponente/komentarPrikazMajstoraBrisanje", ['komentar' => $komentar, 'korisnik' => $korisnik,
            'idOstvUsl'=>$idOstvUsl]);
    }
}

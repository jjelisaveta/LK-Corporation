<?php

 
class KomentarPrikazMajstoraLib
{

    public function prikazKomentara($komentar, $korisnik)
    {
        return view("komponente/komentarPrikazMajstora", ['komentar' => $komentar, 'korisnik' => $korisnik]);
    }
}

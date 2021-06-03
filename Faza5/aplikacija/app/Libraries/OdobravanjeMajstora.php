<?php


namespace App\Libraries;


class OdobravanjeMajstora
{
    public function odobravanjeMajstora($ime, $prezime, $email, $broj, $slika, $id)
    {
        return view("admin/komponente/odobravanjeMajstora", ['ime' => $ime, 'prezime' => $prezime, 'email' => $email, 'broj' => $broj, 'slika' => $slika, 'id' => $id]);
    }
}
<?php

namespace App\Controllers;


use App\Models\KorisnikModel;

class Admin extends BaseController
{
    protected function prikaz($stranica, $podaci)
    {
        $podaci['controller'] = "Admin";
        $podaci['ime'] = 'Code';
        $podaci['prezime'] = 'Igniter';
        echo view("osnova/header");
        echo view("admin/meni", $podaci);
        echo view("admin/$stranica", $podaci);
        echo view("osnova/footer");
    }
    public function index()
    {
        $korisniciModel=new Korisnikmodel();
        $korisnici=$korisniciModel->findall();
      $this->prikaz('pregledMajstora',['korisnici'=>$korisnici]);
    }

}
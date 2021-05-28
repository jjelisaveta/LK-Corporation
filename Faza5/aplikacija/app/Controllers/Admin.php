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
   
    public function obrisiMajstora()
    {
      
        $var = $this->request->getMethod();
        if ($var != 'post') {
            //potrebno popraviti da se salje error 500
            return "zahtev mora biti post";
        }
        $id = (int) $this->request->getVar('id');
      
        $korisniciModel=new Korisnikmodel();
        $korisniciModel->delete($id);

        return redirect()->to(site_url("Admin/index"));
      

    }
    public function index()
    {
        $korisniciModel=new Korisnikmodel();
        $korisnici=$korisniciModel->findall();
      $this->prikaz('pregledMajstora',['korisnici'=>$korisnici]);
    }

}
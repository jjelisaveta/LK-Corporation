<?php

namespace App\Controllers;


use App\Models\Entities;
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
        $korisniciModel = new Korisnikmodel();
        $korisnici = $korisniciModel->findall();
        $this->prikaz('pregledKorisnika', ['korisnici' => $korisnici]);
    }

    public function odobravanjeMajstora()
    {
        $uloga = 2;
        $majstori = $this->doctrine->em->getRepository(Entities\Korisnik::class)->findBy(['idulo' => $uloga, 'odobren' => 0]);
        return $this->prikaz('odobravanjeMajstora', ['majstori' => $majstori]);
    }

    private function odobriMajstoraInternal($id)
    {
        $majstor = $this->doctrine->em->getRepository(Entities\Korisnik::class)->findBy(['idkor' => $id])[0];
        $majstor->setOdobren("1");
        $this->doctrine->em->flush();
        return "OK";
    }

    public function odobriMajstora()
    {
        $var = $this->request->getMethod();
        if ($var != 'post') {
            //potrebno popraviti da se salje error 500
            return "zahtev mora biti post";
        }
        $id = $this->request->getVar('id');
        return $this->odobriMajstoraInternal($id);
    }

    private function ukloniMajstoraInternal($id)
    {
        $majstor = $this->doctrine->em->getRepository(Entities\Korisnik::class)->findBy(['idkor' => $id, 'odobren' => 0])[0];
        $this->doctrine->em->remove($majstor);
        $this->doctrine->em->flush();
        return "OK";
    }

    public function ukloniMajstora()
    {
        $var = $this->request->getMethod();
        if ($var != 'post') {
            //potrebno popraviti da se salje error 500
            return "zahtev mora biti post";
        }
        $id = $this->request->getVar('id');
        return $this->ukloniMajstoraInternal($id);
    }

}
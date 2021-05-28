<?php

namespace App\Controllers;


use App\Models\Entities;
use App\Models\KorisnikModel;
use App\Models\Entities\Zahtev;
use App\Models\Kalendar;
use App\Models\KalendarModel;
use App\Models\Repositories\UslugaOstvarenaRepository;
use App\Models\TerminModel;
use App\Models\UslugaModel;
use App\Models\TagModel;
use App\Models\UslugaTagModel;
use App\Models\ZahtevModel;
use CodeIgniter\Model;
use phpDocumentor\Reflection\Types\Array_;
use App\Models\Entities;


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

        $id =  $this->request->getVar('id');

        $korisniciModel=new Korisnikmodel();
        $korisniciModel->delete($id);

        return "OK";


    }

    public function pregledMajstora()
    {
        $uloga = 2;
        $majstori = $this->doctrine->em->getRepository(Entities\Korisnik::class)->findBy(['idulo' => $uloga, 'odobren' => 'o']);
        $this->prikaz('pregledMajstora', ['majstori' => $majstori]);
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

    public function vremeOdgovora($ostvarene){
       $ukupno = 0;
        foreach($ostvarene as $ostvarena){
            $vremeOdgovora = $ostvarena->getIdrez()->getVremeodgovora()->format("Y-m-d H:i:s");
            $vremeSlanja = $ostvarena->getIdrez()->getIdRez()->getVremeslanja()->format("Y-m-d H:i:s");
            $razlika = strtotime($vremeOdgovora) - strtotime($vremeSlanja);
            
            $ukupno+= $razlika;
        }
        return $ukupno/sizeof($ostvarene);
    }

    public function preporuke($ostvarene){
       $sum = 0;
       foreach($ostvarene as $ostvarena) {
           if ($ostvarena->getOcena() =="1"){
               $sum++;
           }
       }
       return $sum / sizeof($ostvarene) * 100;
    }
    
    public function prosecnaCena($usluge){
        $ukupno = 0;
        foreach($usluge as $usluga){
            $ukupno += $usluga->getCena();
        }
        return $ukupno / sizeof($usluge);
    }
    
    public function prikazMajstora()
    {
        //$id = $this->session->get('Korisnik')->idKor;  id kroz get/post
        $id = 1;
        $majstor = $this->doctrine->em->getRepository(\App\Models\Entities\Korisnik::class)->find($id);
        /*if ($majstor->getIdulo()->getNaziv()!="majstor"){
            return ;//prikaz svih usluga
        }*/
        $usluge = $this->doctrine->em->getRepository(\App\Models\Entities\Usluga::class)->findBy(['idmaj' => $id]);        
        $ostvarene = $this->doctrine->em->getRepository(Entities\UslugaOstvarena::class)->dohvatiOstvareneUslugeMajstora($id);
        
        $vreme = $this->vremeOdgovora($ostvarene);
        $preporuke = $this->preporuke($ostvarene);
        $cena = $this->prosecnaCena($usluge);
        
        $this->prikaz("detaljnijiPrikazMajstora", ['majstor' => $majstor, 'usluge' => $usluge, 'ostvarene' => $ostvarene,
            'vreme'=>$vreme, 'preporuke'=>$preporuke, 'cena'=>$cena]);

    }

    public function obrisiKomentar()
    {
        $id = $this->request->getVar('idOstvUsl');
        $ostvarena = $this->doctrine->em->getRepository(\App\Models\Entities\UslugaOstvarena::class)->find($id);
        $ostvarena->setKomentar(null);
        $this->doctrine->em->persist($ostvarena);
        $this->doctrine->em->flush();
    }
}
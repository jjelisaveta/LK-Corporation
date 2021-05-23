<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controllers;

/**
 * Description of Majstor
 *
 * @author Windows User
 */

use App\Models\Kalendar;
use App\Models\KalendarModel;
use App\Models\TerminModel;
use App\Models\UslugaModel;
use App\Models\TagModel;
use App\Models\UslugaTagModel;
use CodeIgniter\Model;
use phpDocumentor\Reflection\Types\Array_;
use App\Models\Entities;

class Majstor extends BaseController
{

    protected function prikaz($stranica, $podaci)
    {
        $podaci['controller'] = "Majstor";
        $podaci['ime'] = 'Code';
        $podaci['prezime'] = 'Igniter';
        echo view("osnova/header");
        echo view("majstor/meni", $podaci);
        echo view("majstor/$stranica", $podaci);
        echo view("osnova/footer");
    }


    public function dodajUslugu()
    {
        $tagModel = new TagModel();
        $tagovi = $tagModel->findAll();
        $this->prikaz("dodavanjeusluga", ['tagovi' => $tagovi]);
        //redirect()->to(site_url("Majstor/novaUsluga"));
    }

        
    public function novaUsluga() 
    {
        //ispravnost podataka

        $t = $this->request->getVar('izabraniTagovi');
        $tagovi = explode("#", $t);

        /*dodati redove u Usluga-Tag i proveriti ispravnost podataka*/
        
        $uslugaModel = new UslugaModel();
        $uslugaModel->save([
            'naziv' => $this->request->getVar('naslov'),
            'opis' => $this->request->getVar('opis'),
            'cena' => $this->request->getVar('cena'),
            'idMaj' => 1                                        //izmeni
        ]);
        
        $tagModel = new TagModel();
        $uslugaTagModel = new UslugaTagModel();
        $t = $this->request->getVar('izabraniTagovi');
        $tagovi = explode("#", $t);
        $idUsluge = $uslugaModel->getInsertID();
        foreach ($tagovi as $tag){
           
            $uslugaTagModel->save([
                'idUsl' => $idUsluge,
                'idTag' => $tagModel->dohvatiId($tag)->idTag
            ]);
        }
        
       return redirect()->to(site_url("Majstor/mojeUsluge"));
    }
    
    public function dohvatiTagove()
    {
        $u = $this->doctrine->em->getRepository(\App\Models\Entities\Usluga::class)
                ->find(['idUsl'=>19]);
        $tagovi = $u->dohvatiTagove();
        foreach($tagovi as $tag){
            echo $tag['opis'];
        }
    }
    
    public function mojeUsluge()
    {
        $uslugaModel = new UslugaModel();
        $usluge = $uslugaModel->where('idMaj',1)->findAll();  //stavi id ulogovanog korisnika
       /* $uslugaTagModel = new UslugaTagModel();
        $tagModel = new TagModel();
        foreach ($usluge as $usluga){
            $tagoviId = $uslugaTagModel->where('idUsl', $usluga->idUsl)->findAll();
        }*/
        
        $this->prikaz("mojeUsluge",['usluge'=>$usluge]);
    }
    
    public function prikazMajstora()
    {
        //majstor - ime, prezime
        //dohvatanje komentara iz baze 
        //dohvatanje usluga
        $this->prikaz("prikazMajstora",[])
    }

    public function kalendar($date = null)
    {
        echo "<script>console.log('poslao zahtev');</script>";
        if (!isset($date)) {
            $date = date("Y-m-d");
        }
        $idMaj = 1;
        $termini = [];
        for ($i = 0; $i < 4; $i++) {
            for ($j = 0; $j < 3; $j++) {
                $vreme = str_pad((($i * 3 + $j) * 2), 2, '0', STR_PAD_LEFT) . ":" . "00";
                $id = "dugme" . (($i * 3 + $j) * 2);
                $class = "terminne";
                $termin = new \App\Libraries\KalendarTermin($vreme, $id, $class);
                array_push($termini, $termin);
            }
        }
        $data["termini"] = $termini;
        $data["date"] = $date;
        $this->prikaz("kalendar", $data);
        $radi = $this->dohvatiRadneTermineInternal($idMaj, $date);
        foreach ($radi as $ter) {
            echo "<script>updateTermin('$ter');</script>";
        }
        $rezervisan = $this->dohvatiRezervacijeInternal($idMaj, $date);
        foreach ($rezervisan as $ter) {
            echo "<script>rezervisi('$ter');</script>";
        }
    }

    private function dohvatiRezervacijeInternal($idMaj, $date)
    {
        $kalendarModel = new KalendarModel();
        $ret = array();
        $kalendarModel = new KalendarModel();
        $kalendar = $kalendarModel->dohvatiMajstorRezervisan($idMaj, $date);
        foreach ($kalendar as $kal) {
            $niz = explode(" ", $kal->datumVreme);
            $niz = explode("-", $niz[1]);
            $id = "dugme" . (intval($niz[0]));
            array_push($ret, $id);
        }
        return $ret;
    }
    public function dohvatiRezervacije($date)
    {
        $var = $this->request->getMethod();
        if ($var != 'get') {
            //potrebno popraviti da se salje error 500
            return json_encode([]);
        }
//        $date = $this->request->getVar('date');
        return json_encode($this->dohvatiRezervacijeInternal(1, $date));
    }

    private function dohvatiRadneTermineInternal($idMaj, $date)
    {
        $ret = array();
        $kalendarModel = new KalendarModel();
        $kalendar = $kalendarModel->dohvatiMajstorSlobodan($idMaj, $date);
        foreach ($kalendar as $kal) {
            $niz = explode(" ", $kal->datumVreme);
            $niz = explode("-", $niz[1]);
            $id = "dugme" . (intval($niz[0]));
            array_push($ret, $id);
        }
        return $ret;
    }


    public function dohvatiRadneTermine($date)
    {
        $var = $this->request->getMethod();
        if ($var != 'get') {
            //potrebno popraviti da se salje error 500
            return json_encode([]);
        }
//        $date = $this->request->getVar('date');
        return json_encode($this->dohvatiRadneTermineInternal(1, $date));
    }

    private function dodajRadniTerminInternal($idMaj, $date, $id)
    {
        $terminModel = new TerminModel();
        $datumVreme = $date . " " . $id . ":00:00";
        $termin = $terminModel->where("datumVreme", $datumVreme)->first();
        if ($termin == []) {
            $terminModel->save([
                "datumVreme" => $datumVreme
            ]);
            $idTer = $terminModel->getInsertID();
        } else {
            $idTer = $termin->idTer;
        }
        $kalendarModel = new KalendarModel();
        $kalendarTermin = $kalendarModel->where("idMaj", $idMaj)->where("idTer", $idTer)->first();
        if ($kalendarTermin != null) {
            return "GRESKA termin vec postoji";
        }
        $kalendarModel->save([
            'idMaj' => $idMaj,
            'idTer' => $idTer,
        ]);
        return "OK";
    }

    public function dodajRadniTermin()
    {
        $var = $this->request->getMethod();
        if ($var != 'post') {
            //potrebno popraviti da se salje error 500
            return "zahtev mora biti post";
        }
        $idMaj = 1;
        $date = $this->request->getVar("datum");
        $id = $this->request->getVar("index");
        return $this->dodajRadniTerminInternal($idMaj, $date, $id);
    }

    private function skiniRadniTerminInternal($idMaj, $date, $id)
    {
        $terminModel = new TerminModel();
        $datumVreme = $date . " " . $id . ":00:00";
        $termin = $terminModel->where("datumVreme", $datumVreme)->first();
        if ($termin == []) {
            $terminModel->save([
                "datumVreme" => $datumVreme
            ]);
            $idTer = $terminModel->getInsertID();
        } else {
            $idTer = $termin->idTer;
        }
        $kalendarModel = new KalendarModel();
        $kalendarTermin = $kalendarModel->where("idMaj", $idMaj)->where("idTer", $idTer)->first();
        if ($kalendarTermin == null) {
            return "GRESKA termin ne postoji";
        }
        if ($kalendarTermin->idRez != null) {
            return "GRESKA termin je rezervisan";
        }
        $kalendarModel->delete($kalendarTermin->idKal);
        return "OK";
    }

    public function skiniRadniTermin()
    {
        $var = $this->request->getMethod();
        if ($var != 'post') {
            //potrebno popraviti da se salje error 500
            return "zahtev mora biti post";
        }
        $idMaj = 1;
        $date = $this->request->getVar("datum");
        $id = $this->request->getVar("index");
        return $this->skiniRadniTerminInternal($idMaj, $date, $id);
    }

}

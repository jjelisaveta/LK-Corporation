<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controllers;

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

class Majstor extends BaseController
{
    protected function prikaz($stranica, $podaci)
    {
        $podaci['controller'] = "Majstor";
        $podaci['korisnik'] = $this->session->get('Korisnik');
        $podaci['ime'] = $this->session->get('Korisnik')->ime;
        $podaci['prezime'] = $this->session->get('Korisnik')->prezime;
        $podaci['profilna'] = $this->session->get('Korisnik')->slika;

        echo view("osnova/header");
        echo view("majstor/meni", $podaci);
        echo view("majstor/$stranica", $podaci);
        echo view("osnova/footer");
    }

    public function pretrazivanje()
    {
        echo "Ovo Jovan treba da uradi";
    }

    public function dodajUslugu()
    {
        $tagModel = new TagModel();
        $tagovi = $tagModel->findAll();

        if (!$_POST) {
            $this->prikaz("dodavanjeusluga", ['tagovi' => $tagovi]);
            return;
        }

        $rules = ['naslov' => [
            'rules' => 'required',
            'label' => 'Naslov',
            'errors' => [
                'required' => 'Naslov je obavezno polje!',
            ]],
            'opis' => [
                'rules' => 'required',
                'label' => 'Kratak opis uslge',
                'errors' => [
                    'required' => 'Opis usluge je obavezno polje!',
                ]],
            'cena' => [
                'rules' => 'required',
                'label' => 'Cena',
                'errors' => [
                    'required' => 'Cena je obavezno polje!',
                ]],
        ];
        if ($this->validate($rules)) {
            $t = $this->request->getVar('izabraniTagovi');
            $tagovi = explode("#", $t);

            $uslugaModel = new UslugaModel();
            $uslugaModel->save([
                'naziv' => $this->request->getVar('naslov'),
                'opis' => $this->request->getVar('opis'),
                'cena' => $this->request->getVar('cena'),
                'idMaj' => $this->session->get('Korisnik')->idKor
            ]);

            $tagModel = new TagModel();
            $uslugaTagModel = new UslugaTagModel();
            $t = $this->request->getVar('izabraniTagovi');
            $tagovi = explode("#", $t);
            $idUsluge = $uslugaModel->getInsertID();
            foreach ($tagovi as $tag) {

                $uslugaTagModel->save([
                    'idUsl' => $idUsluge,
                    'idTag' => $tagModel->dohvatiId($tag)->idTag
                ]);
            }

            return redirect()->to(site_url("Majstor/mojeUsluge"));
        } else {
            if ($this->validator->hasError('naslov')) {
                $podaci['nazivGreska'] = $this->validator->getError('naslov');
            }
            if ($this->validator->hasError('opis')) {
                $podaci['opisGreska'] = $this->validator->getError('opis');
            }
            if ($this->validator->hasError('cena')) {
                $podaci['cenaGreska'] = $this->validator->getError('cena');
            }
            $podaci['tagovi'] = $tagovi;
            return $this->prikaz("dodavanjeusluga", $podaci);
        }
    }


    public function dohvatiTagove($idUsl)
    {
        $u = $this->doctrine->em->getRepository(\App\Models\Entities\Usluga::class)
            ->find($idUsl);
        $tagovi = $u->getTagovi();
        return $tagovi;
    }

    public function odjava()
    {
        $this->session->destroy();
        return redirect()->to(site_url("Gost/loginSubmit"));
    }

    public function mojeUsluge()
    {
        $usluge = $this->doctrine->em->getRepository(\App\Models\Entities\Usluga::class)->findBy(['idmaj' => 1]);
        $this->prikaz("mojeUsluge", ['usluge' => $usluge]);
    }


    public function dohvatiOStvareneUsluge($id)
    {
        $usluge = $this->doctrine->em->getRepository(Entities\UslugaOstvarena::class)->dohvatiOstvareneUslugeMajstora($id);
        $naziv = [];
        foreach ($usluge as $usluga) {
            array_push($naziv, $usluga->getIdrez()->idRez->getOpis());
        }

        return "poruka" . json_encode($naziv);
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
        $id = $this->session->get('Korisnik')->idKor;

        $majstor = $this->doctrine->em->getRepository(\App\Models\Entities\Korisnik::class)->find($id);
        $usluge = $this->doctrine->em->getRepository(\App\Models\Entities\Usluga::class)->findBy(['idmaj' => $id]);
        $ostvarene = $this->doctrine->em->getRepository(Entities\UslugaOstvarena::class)->dohvatiOstvareneUslugeMajstora($id);
        
        $vreme = $this->vremeOdgovora($ostvarene);
        $preporuke = $this->preporuke($ostvarene);
        $cena = $this->prosecnaCena($usluge);
        
        $this->prikaz("detaljnijiPrikazMajstora", ['majstor' => $majstor, 'usluge' => $usluge, 'ostvarene' => $ostvarene,
            'vreme'=>$vreme, 'preporuke'=>$preporuke, 'cena'=>$cena]);

    }

    public function obrisiKomentar(){
        $id = $this->request->getVar('idOstvUsl');
        $ostvarena = $this->doctrine->em->getRepository(\App\Models\Entities\UslugaOstvarena::class)->find($id);
        $ostvarena->setKomentar(null);
        $this->doctrine->em->persist($ostvarena);
        $this->doctrine->em->flush();
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
            echo "<script>rezervisi('$ter[0]','$ter[1]');</script>";
        }
    }

    private function dohvatiOpisRezervacije($idRez)
    {
//        $zahtevModel = new ZahtevModel();
//        $ret = $zahtevModel->dohvatiCeoOpis($idRez);
//        return $ret;
        $em = $this->doctrine->em;
        $zahtev = $em->getRepository(Zahtev::class)->find($idRez);
        $korisnik = $zahtev->getIdkor();
        $opis = $zahtev->getOpis();
        $ime = $korisnik->getIme();
        $prezime = $korisnik->getPrezime();
        $adresa = $korisnik->getAdresa();
        $opis = $ime . " " . $prezime . ";" . $opis . ";" . $adresa;
        return $opis;
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
            array_push($ret, [$id, $this->dohvatiOpisRezervacije($kal->idRez)]);
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


    public function izmeniUslugu($id)
    {
        $tagModel = new TagModel();
        $sviTagovi = $tagModel->findAll();
        $uslugaModel = new UslugaModel();
        $usluga = $uslugaModel->where('idUsl', $id)->first();
        $naziv = $usluga->naziv;
        $opis = $usluga->opis;
        $cena = $usluga->cena;
        $tagovi = $this->dohvatiTagove($id);
        $podaci = ['sviTagovi' => $sviTagovi, 'naslov' => $naziv, 'opis' => $opis, 'cena' => $cena, 'tagovi' => $tagovi, 'id' => $id];
        if (isset($_SESSION['greske'])) {
            $podaci = array_merge($podaci, $_SESSION['greske']);
            unset($_SESSION['greske']);
        }
        return $this->prikaz("izmenaUsluge", $podaci);
    }

    public function izmenaUsluge()
    {
        $var = $this->request->getMethod();
        if ($var != 'post') {
            //potrebno popraviti da se salje error 500
            return "zahtev mora biti post";
        }
        $idMaj = 1;
        $naslov = $this->request->getVar("naslov");
        $opis = $this->request->getVar("opis");
        $cena = $this->request->getVar("cena");
        $id = $this->request->getVar("id");
        $tagovi = explode(';', $this->request->getVar("izabraniTagovi"));
        $tags = [];
        $allTags = $this->doctrine->em->getRepository(\App\Models\Entities\Tag::class)->findAll();
        foreach ($tagovi as $tag) {
            foreach ($allTags as $tg) {
                if ($tg->getOpis() == $tag) {
                    array_push($tags, $tg);
                    break;
                }
            }
        }

        $usluga = $this->doctrine->em->getRepository(\App\Models\Entities\Usluga::class)->find($id);
        $usluga->setTagovi($tags);
        $usluga->setNaziv($naslov);
        $usluga->setCena($cena);
        $usluga->setOpis($opis);
        
        $this->doctrine->em->flush();
        return redirect()->to(site_url("Majstor/mojeUsluge"));

        $rules = ['naslov' => [
            'rules' => 'required',
            'label' => 'Naslov',
            'errors' => [
                'required' => 'Naslov je obavezno polje!',
            ]],
            'opis' => [
                'rules' => 'required',
                'label' => 'Kratak opis uslge',
                'errors' => [
                    'required' => 'Opis usluge je obavezno polje!',
                ]],
            'cena' => [
                'rules' => 'required',
                'label' => 'Cena',
                'errors' => [
                    'required' => 'Cena je obavezno polje!',
                ]],
        ];
        if ($this->validate($rules)) {
            $usluga = $this->doctrine->em->getRepository(\App\Models\Entities\Usluga::class)->find($id);
            $usluga->setTagovi($tags);
            $usluga->setNaziv($naslov);
            $usluga->setCena($cena);
            $usluga->setOpis($opis);
            $this->doctrine->em->flush();
            return redirect()->to(site_url("Majstor/mojeUsluge"));
        } else 
        {
            //$podaci = ['sviTagovi' => $sviTagovi, 'naslov' => $naslov, 'opis' => $opis, 'cena' => $cena, 'tagovi' => $tags, 'id' => $id];
            $podaci = [];
            if ($this->validator->hasError('naslov')) {
                $podaci['naslovGreska'] = $this->validator->getError('naslov');
            }
            if ($this->validator->hasError('opis')) {
                $podaci['opisGreska'] = $this->validator->getError('opis');
            }
            if ($this->validator->hasError('cena')) {
                $podaci['cenaGreska'] = $this->validator->getError('cena');
            }
            $_SESSION['greske'] = $podaci;
            return redirect()->to(site_url("Majstor/izmeniUslugu/" . $id));
        }
    }


    public function zahtevi($id)
    {
        $zahtevi = $this->doctrine->em->getRepository(\App\Models\Entities\Zahtev::class)->findBy(['idzah' => $id])[0];
        $ret = [];
        foreach ($zahtevi->getMajstori() as $majstor) {
            array_push($ret, $majstor->getIme());
        }
        $ret = json_encode($ret);
        return $ret;
    }

}
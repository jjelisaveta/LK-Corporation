<?php

namespace App\Controllers;

use App\Models\UslugaOstvarenaModel;
use App\Models\RezervacijaModel;
use App\Models\KorisnikModel;
use App\Models\UslugaModel;
use App\Models\ZahtevModel;
use App\Models\TerminModel;
use App\Models\Entities\Zahtev;
use App\Models\Kalendar;
use App\Models\KalendarModel;
use App\Models\Repositories\UslugaOstvarenaRepository;
use App\Models\Repositories\IstorijaRepository;
use CodeIgniter\Model;
use phpDocumentor\Reflection\Types\Array_;
use App\Models\Entities;
use phpDocumentor\Reflection\Types\This;

class Klijent extends BaseController
{

    /*public function index()
    {
        return view('welcome_message');
    }
*/

    protected function prikaz($stranica, $podaci,$broj)
    {
        $podaci['controller'] = 'Klijent';
        $podaci['korisnik'] = $this->session->get('Korisnik');
        $podaci['ime'] = $this->session->get('Korisnik')->ime;
        $podaci['prezime'] = $this->session->get('Korisnik')->prezime;
        $podaci['profilna'] = $this->session->get('Korisnik')->slika;
        $podaci['broj']=$broj;
        echo view("osnova/header");
        echo view("osnova/meni", $podaci);
        echo view("klijent/$stranica", $podaci);
        echo view("osnova/footer");
    }

    public function pretrazivanje()
    {
        $stranica = 'pretrazivanje';
        $allTags = $this->doctrine->em->getRepository(\App\Models\Entities\Tag::class);
        if (!$_POST) {
            return $this->prikaz($stranica, ['tagovi' => $allTags],1);
        }
    }
    public function usluge()
    {
        $usluge = $this->doctrine->em->getRepository(\App\Models\Entities\Tag::class)->find(7)->getUsluge();       
        return $usluge;
    }

    public function izlogujSe(){
        $this->session->destroy();
        return redirect()->to(site_url("Gost/loginSubmit"));
    }
    
    public function prikazUsluga($trazeniTag){
        $tag = str_replace("_"," ",$trazeniTag);

        $ostvarene = $this->doctrine->em->getRepository(Entities\UslugaOstvarena::class)->findAll();
        $usluge = $this->doctrine->em->getRepository(\App\Models\Entities\Tag::class)->findOneBy(['opis' => $tag])->getUsluge();
        $this->prikaz('prikazUsluga', ['usluge' => $usluge, 'ostvarene' => $ostvarene],0);
    }

    public function dohvatiSlobodneTermine()
    {
        $majstori = $this->request->getVar('majstori');
        $nizMajstora = explode("_", $majstori);
        $slobodni = [];
        foreach ($nizMajstora as $idMaj) {
            $slobodni = array_merge($slobodni, $this->doctrine->em->getRepository(\App\Models\Entities\Kalendar::class)->dohvatiSveSlobodneZaMajstora($idMaj));
        }

        $zaSlanje = [];
        foreach ($slobodni as $s) {
            array_push($zaSlanje, [
                'idMaj' => $s->getIdmaj(),
                'idKal' => $s->getIdkal(),
                'idTer' => $s->getIdTer()->getIdter(),
                'vreme' => $s->getIdTer()->getDatumvreme()
            ]);
        }

        return json_encode($zaSlanje);
    }

    public function istorija()
    {

        $idkor = $podaci['ime'] = $this->session->get('Korisnik')->idKor;

        $ostvarene = $this->doctrine->em->getRepository(Entities\UslugaOstvarena::class)->dohvatiUslugeKorisnika($idkor);

        $this->prikaz("istorija", ["ostvarene" => $ostvarene],3);

    }

    public function aktivnaPopravka()
    {

        $idkor = $podaci['ime'] = $this->session->get('Korisnik')->idKor;
        $aktivne = $this->doctrine->em->getRepository(Entities\UslugaOstvarena::class)->dohvatiUslugeKorisnika($idkor);
        $this->prikaz("aktivnePopravke", ["aktivne" => $aktivne],2);

    }

    public function sacuvajKomentar()
    {

        $id = (int)$this->request->getVar('hidden');

        $uslugaOstvareneModel = new UslugaOstvarenaModel();
        $data = [
            'komentar' => $this->request->getVar('komentar')
        ];

        $uslugaOstvareneModel->update($id, $data);

        return redirect()->to(site_url("Klijent/istorija"));

    }

    public function sacuvajOcenu()
    {
        $var = $this->request->getMethod();
        if ($var != 'post') {
            //potrebno popraviti da se salje error 500
            return "zahtev mora biti post";
        }
        $id = (int)$this->request->getVar('id');
        $ocena = (int)$this->request->getVar('ocena');
        $uslugaOstvareneModel = new UslugaOstvarenaModel();
        $data = [
            'ocena' => $ocena
        ];

        $uslugaOstvareneModel->update($id, $data);
        return redirect()->to(site_url("Klijent/istorija"));

    }

    public function obrisiIstorija()
    {
        $var = $this->request->getMethod();
        if ($var != 'post') {
            //potrebno popraviti da se salje error 500
            return "zahtev mora biti post";
        }
        $id = (int)$this->request->getVar('id');
        $data = [
            'obrisano' => 1
        ];
        $uslugaOstvareneModel = new UslugaOstvarenaModel();
        $uslugaOstvareneModel->update($id, $data);

        return redirect()->to(site_url("Klijent/istorija"));


    }

    public function dohvatiIdentifikator()
    {
        return "OK\n" . ($this->doctrine->em->getRepository(Entities\Kljuc::class)->dohvatiSledeci());
    }

    public function rezervacija()
    {
        $var = $this->request->getMethod();
        if ($var != 'post') {
            //potrebno popraviti da se salje error 500
            return "zahtev mora biti post";
        }
        $zahtevi = json_decode($this->request->getVar('zahtevi'));
        $opis = $this->request->getVar('opis');
        $vreme = date("Y-m-d H:i:s");
        $kljuc = $this->request->getVar('kljuc');
        $korisnik = $this->doctrine->em->getRepository(Entities\Korisnik::class)->find($this->session->get('Korisnik')->idKor);
        foreach ($zahtevi as $zahtev) {
            foreach ($zahtev->ter as $termin) {
                $noviZahtev = new Zahtev();
                $noviZahtev->setIdusl($this->doctrine->em->getRepository(Entities\Usluga::class)->find($zahtev->id));
                $noviZahtev->setIdter($this->doctrine->em->getRepository(Entities\Termin::class)->find($termin));
                $noviZahtev->setOpis($opis);
                $noviZahtev->setVremeslanja(\DateTime::createFromFormat("Y-m-d H:i:s", $vreme));
                $noviZahtev->setIdkor($korisnik);
                $noviZahtev->setIdentifikator($kljuc);
                $this->doctrine->em->persist($noviZahtev);
            }
        }
        $this->doctrine->em->flush();
        return "OK";
    }
    public function vremeOdgovora($ostvarene)
    {
        $ukupno = 0;
        foreach ($ostvarene as $ostvarena) {
            $vremeOdgovora = $ostvarena->getIdrez()->getVremeodgovora()->format("Y-m-d H:i:s");
            $vremeSlanja = $ostvarena->getIdrez()->getIdRez()->getVremeslanja()->format("Y-m-d H:i:s");
            $razlika = strtotime($vremeOdgovora) - strtotime($vremeSlanja);

            $ukupno += $razlika;
        }
        if (sizeof($ostvarene) == 0)
            return 0;
        return $ukupno / sizeof($ostvarene);
    }

    public function preporuke($ostvarene)
    {
        $sum = 0;
        foreach ($ostvarene as $ostvarena) {
            if ($ostvarena->getOcena() == "1") {
                $sum++;
            }
        }
        if (sizeof($ostvarene) == 0)
            return 0;
        return number_format($sum / sizeof($ostvarene) * 100, 2);
    }

    public function prosecnaCena($usluge)
    {
        $ukupno = 0;
        foreach ($usluge as $usluga) {
            $ukupno += $usluga->getCena();
        }
         if (sizeof($usluge) == 0)
            return 0;
        return $ukupno / sizeof($usluge);
    }

    public function prikazMajstora()
    {
       // $id = $this->request->getVar('id');
        $id = 1;
        echo $id;
        $majstor = $this->doctrine->em->getRepository(\App\Models\Entities\Korisnik::class)->findBy(['idkor' => $id])[0];
        $usluge = $this->doctrine->em->getRepository(\App\Models\Entities\Usluga::class)->findBy(['idmaj' => $id]);
        $ostvarene = $this->doctrine->em->getRepository(Entities\UslugaOstvarena::class)->dohvatiOstvareneUslugeMajstora($id);

        $vreme = $this->vremeOdgovora($ostvFarene);
        $preporuke = $this->preporuke($ostvarene);
        $cena = $this->prosecnaCena($usluge);

        return $this->prikaz("detaljnijiPrikazMajstora", ['majstor' => $majstor, 'usluge' => $usluge, 'ostvarene' => $ostvarene,
            'vreme' => $vreme, 'preporuke' => $preporuke, 'cena' => $cena], 1);

    }
}
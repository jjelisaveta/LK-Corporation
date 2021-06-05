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

    /*
     * Zasticena funkcija, sluzi  za prikaz zeljene stranice
     * funckija dodatno proverava da li je u pitanju korisnik ili gost i prikazuje meni u zavisnosti od toga
     *
     * @param string $stranica naziv stranice koja se iscrtava
     * @param array $podaci niz podataka koji su potrebni za pravilno iscrtavanje stranice
     * @param int $broj redni broj stranice u meniju, potreban radi izdvajanja te stranice u meniju
     *
     * @return void
     */
    protected function prikaz($stranica, $podaci,$broj)
    {
//        print_r($_SESSION);
//        return;
        $prenos['controller'] = 'Klijent';
        if (!isset($_SESSION['Korisnik'])){
            $podaci['gost'] = "gost";
            $podaci['korisnik'] = "";
            $podaci['ime'] ="";
            $podaci['prezime'] = "";
            $podaci['profilna'] = "";
        } else {
            $podaci['gost'] = "nije";
            $podaci['korisnik'] = $this->session->get('Korisnik');
            $podaci['ime'] = $this->session->get('Korisnik')->ime;
            $podaci['prezime'] = $this->session->get('Korisnik')->prezime;
            $podaci['profilna'] = $this->session->get('Korisnik')->slika;
        }
        $podaci['broj']=$broj;
        echo view("osnova/header");
        echo view("osnova/meni", $podaci);
        echo view("klijent/$stranica", $podaci);
        echo view("osnova/footer");
    }

    /*
     * funcija obradjuje stranicu za pretrazivanje
     * dohvata sve tagove iz baze
     * tagovi su potrebni javaskript funkcijama za pravilnu preporuku pretrage
     * prikazuje stranicu ukoliko nije poslat post zahtev
     *
     * @return void
     */
    public function pretrazivanje()
    {
        $stranica = 'pretrazivanje';
        $allTags = $this->doctrine->em->getRepository(\App\Models\Entities\Tag::class);
        if (!$_POST) {
            return $this->prikaz($stranica, ['tagovi' => $allTags],1);
        }
    }


    /*
     * funkcija koja vrsi izlogovanje korisnika, unistavanjem trenutne sesije na serveru
     *
     *
     * @return void
     */
    public function izlogujSe(){
        $this->session->destroy();
        return redirect()->to(site_url("Gost/loginSubmit"));
    }

    /*
     * funckija koja prikazuje stranicu prikazUsluga kod korisnika
     *
     * @param string $trazeniTag tag po kojem se pretrazuju usluge
     *
     * @return void
     */
    public function prikazUsluga($trazeniTag){
        $tag = str_replace("_"," ",$trazeniTag);

        $ostvarene = $this->doctrine->em->getRepository(Entities\UslugaOstvarena::class)->findAll();
        $usluge = $this->doctrine->em->getRepository(\App\Models\Entities\Tag::class)->findOneBy(['opis' => $tag])->getUsluge();
        return $this->prikaz('prikazUsluga', ['usluge' => $usluge, 'ostvarene' => $ostvarene],0);
    }

    /*
     * funckcija vraca json objekat sa svim slobodnim terminima trazenih majstora
     * majstori se prosledjuju kao argument zahteva
     *
     * @uses array $_POST['majstori']
     *
     *
     * @return json
     */
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

    /*
     * funcija prikazuje istoriju koriscenih usluga za ulogovanog korisnika
     *
     * @return void
     */
    public function istorija()
    {

        $idkor = $podaci['ime'] = $this->session->get('Korisnik')->idKor;

        $ostvarene = $this->doctrine->em->getRepository(Entities\UslugaOstvarena::class)->dohvatiUslugeKorisnika($idkor);

        $this->prikaz("istorija", ["ostvarene" => $ostvarene],3);

    }

    /**
     * funcija prikazuje aktivne usluge za ulogovanog korisnika
     *
     * @return void
     */
    public function aktivnaPopravka()
    {

        $idkor = $podaci['ime'] = $this->session->get('Korisnik')->idKor;
        $aktivne = $this->doctrine->em->getRepository(Entities\UslugaOstvarena::class)->dohvatiUslugeKorisnika($idkor);
        $this->prikaz("aktivnePopravke", ["aktivne" => $aktivne],2);

    }

    /*
     * funkcija koja sluzi za cuvanje komentara koji je korisnik ostavio na neku uslugu
     *
     * @uses int $_POST['hidden'] id usluge za koju se cuva komentar
     * @uses string $_POST['komentar']
     *
     * @return redirect preusmerava korisnika nazad na stranicu istorija
     */
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

    /*
     * funkcija koja sluzi za cuvanje ocene koji je korisnik ostavio na neku uslugu
     * obevezno POST zahtev
     *
     * @uses int $_POST['id'] id usluge za koju se cuva ocena
     * @uses int $_POST['ocena']
     *
     * @return redirect preusmerava korisnika nazad na stranicu istorija
     */
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

    /*
     * funkcija koja sluzi za brisanje usluge iz istorije ulogovanog korisnika
     * obavezno POST zahtev
     *
     * @uses int $_POST['id'] id usluge koja se brise
     *
     * @return redirect preusmerava korisnika nazad na stranicu istorija
     */
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
    /*
     * funkcija koja sluzi za slanje zahteva majstorima za dogovor oko neke usluge
     * obavezno POST zahtev
     *
     * @uses array $_POST['zahtevi'] niz zahteva koji se salju majstorima
     * @uses string $_POST['opis']
     * @uses int $_POST['kljuc'] kljuc koji se koristi za identifikaciju zahtevane rezervacije
     *
     * @return string ok-sve je bilo u redu, bilo sta drugo-doslo je do greske
     */
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
    /*
     * privatna funkcija, racuna prosecno vreme odgovra za ostvarene usluge majstora
     *
     * @param array $ostvarene niz ostvarenih usluga majstora
     *
     * @return float
     */
    private function vremeOdgovora($ostvarene)
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
    /*
     * privatna funkcija, racuna procenat dobrih preporuka za majstora u odnosu na sve preporuke
     *
     * @param array $ostvarene sve ostvarene usluge majstora
     *
     * @return float
     */
    private function preporuke($ostvarene)
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
    /*
     * privatna funkcija, racuna prosecnu cenu usluge majstora
     *
     * @param array $usluge sve usluge majstora
     *
     * @return float
     */
    private function prosecnaCena($usluge)
    {
        $ukupno = 0;
        foreach ($usluge as $usluga) {
            $ukupno += $usluga->getCena();
        }
         if (sizeof($usluge) == 0)
            return 0;
        return $ukupno / sizeof($usluge);
    }
    /*
     * funkcija koja prikazuje majstora prosledjenog kroz post zahtev, obavezno post
     *
     * @uses int $_POST['id'] id majstora za prikaz
     *
     * @return void
     */
    public function prikazMajstora()
    {
        $id = $this->request->getVar('id');
//        //$id = 1;
//        print_r($_REQUEST);
//        return;
        $majstor = $this->doctrine->em->getRepository(\App\Models\Entities\Korisnik::class)->findBy(['idkor' => $id])[0];
        $usluge = $this->doctrine->em->getRepository(\App\Models\Entities\Usluga::class)->findBy(['idmaj' => $id]);
        $ostvarene = $this->doctrine->em->getRepository(Entities\UslugaOstvarena::class)->dohvatiOstvareneUslugeMajstora($id);

        $vreme = $this->vremeOdgovora($ostvarene);
        $preporuke = $this->preporuke($ostvarene);
        $cena = $this->prosecnaCena($usluge);

        return $this->prikaz("detaljnijiPrikazMajstora", ['majstor' => $majstor, 'usluge' => $usluge, 'ostvarene' => $ostvarene,
            'vreme' => $vreme, 'preporuke' => $preporuke, 'cena' => $cena], 1);

    }
}
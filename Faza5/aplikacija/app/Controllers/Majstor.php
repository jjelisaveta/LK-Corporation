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
    /*
     * Zasticena funkcija, sluzi  za prikaz zeljene stranice
     *
     * @param string $stranica naziv stranice koja se iscrtava
     * @param array $podaci niz podataka koji su potrebni za pravilno iscrtavanje stranice
     * @param int $broj redni broj stranice u meniju, potreban radi izdvajanja te stranice u meniju
     *
     * @return void
     */
    protected function prikaz($stranica, $podaci, $broj)
    {
        $podaci['controller'] = "Majstor";
        $podaci['korisnik'] = $this->session->get('Korisnik');
        $podaci['ime'] = $this->session->get('Korisnik')->ime;
        $podaci['prezime'] = $this->session->get('Korisnik')->prezime;
        $podaci['profilna'] = $this->session->get('Korisnik')->slika;
        $podaci['broj'] = $broj;
        echo view("osnova/header");
        echo view("majstor/meni", $podaci);
        echo view("majstor/$stranica", $podaci);
        echo view("osnova/footer");
    }


    /*
     * funckija se koristi za prikaz ili dodavanje usluge u zavisnosti od tipa zahteva get ili post
     * prosledjuju joj se svi parametri potrebni za dodavanje nove usluge kroz post zahtev
     *
     * @return void
     */
    public function dodajUslugu()
    {
        $tagovi = $this->doctrine->em->getRepository(\App\Models\Entities\Tag::class)->findAll();

        if (!$_POST) {
            $this->prikaz("dodavanjeusluga", ['tagovi' => $tagovi], 4);
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
           // return $this->ispis($tagovi);
            $novaUsluga = new Entities\Usluga();
            $novaUsluga->setNaziv($this->request->getVar('naslov'));
            $novaUsluga->setOpis($this->request->getVar('opis'));
            $novaUsluga->setCena($this->request->getVar('cena'));
            $majstor = $this->doctrine->em->getRepository(\App\Models\Entities\Korisnik::class)->find($this->session->get('Korisnik')->idKor);

            $novaUsluga->setIdmaj($majstor);
            $noviTagovi = [];
            if (sizeof($tagovi)>0){
                foreach ($tagovi as $tag) {
                    if ($tag!=null && $tag!="") array_push($noviTagovi, $this->doctrine->em->getRepository(\App\Models\Entities\Tag::class)->findOneBy(['opis' => $tag]));
                    //echo $this->doctrine->em->getRepository(\App\Models\Entities\Tag::class)->findOneBy(['opis' => $tag])->getOpis();
                }
            }
            $novaUsluga->setTagovi($noviTagovi);
            $this->doctrine->em->persist($novaUsluga);
            $this->doctrine->em->flush();
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
            return $this->prikaz("dodavanjeusluga", $podaci, 4);
        }
    }

    public function ispis($tagovi){
    
        print_r($tagovi);
        echo "null";
    }

    //test vrvtn???
    public function dohvatiTagove($idUsl)
    {
        $u = $this->doctrine->em->getRepository(\App\Models\Entities\Usluga::class)
            ->find($idUsl);
        $tagovi = $u->getTagovi();
        return $tagovi;
    }
    /*
     * funkcija koja vrsi izlogovanje korisnika, unistavanjem trenutne sesije na serveru
     *
     *
     * @return void
     */
    public function odjava()
    {
        $this->session->destroy();
        return redirect()->to(site_url("Gost/loginSubmit"));
    }
    /*
     * funkcija za prikaz svih usluga majstora
     *
     * @return void
     */
    public function mojeUsluge()
    {
        $usluge = $this->doctrine->em->getRepository(\App\Models\Entities\Usluga::class)->findBy(['idmaj' => $this->session->get('Korisnik')->idKor]);
        $this->prikaz("mojeUsluge", ['usluge' => $usluge], 3);
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
        return $ukupno / sizeof($usluge);
    }
    /*
     * funkcija sluzi za prikaz stranice kalendar za ulogovanog majstora
     *
     *
     * @return void
     */
    public function kalendar($date = null)
    {
        if (!isset($date)) {
            $date = date("Y-m-d");
        }
        $idMaj = $this->session->get('Korisnik')->idKor;
        $termini = [];
        for ($i = 0; $i < 4; $i++) {
            for ($j = 0; $j < 3; $j++) {
                $vreme = str_pad((($i * 3 + $j) * 2), 2, '0', STR_PAD_LEFT) . ":" . "00";
                $id = "dugme" . (($i * 3 + $j) * 2);
                $class = "terminne";
                $termin = ['vreme' => $vreme, 'id' => $id, 'class' => $class];
                array_push($termini, $termin);
            }
        }
        $rezervisan = $this->dohvatiRezervacijeInternal($idMaj, $date);
        $radi = $this->dohvatiRadneTermineInternal($idMaj, $date);
        $data["termini"] = $termini;
        $data["date"] = $date;
        $data['radi'] = $radi;
        $data['rezervisan'] = $rezervisan;
        $this->prikaz("kalendar", $data, 2);
    }

    /*
     * privatna funkcija sluzi kao pomocna za dohvatanje opisa rezervacije
     *
     * @param Rezervacija @rezervacija entitet rezervacije za koju se dohvata opis
     *
     * @return string ime+prezime+adresa korisnika koji je zakazao rezervaciju
     */
    private function dohvatiOpisRezervacije($rezervacija)
    {
        $zahtev = $rezervacija->getIdrez();
        $korisnik = $zahtev->getIdkor();
        $opis = $zahtev->getOpis();
        $ime = $korisnik->getIme();
        $prezime = $korisnik->getPrezime();
        $adresa = $korisnik->getAdresa();
        $opis = $ime . " " . $prezime . ";" . $adresa;
        return $opis;
    }

    /*
     * privatna funkcija sluzi kao pomocna za dobhvatanje rezervacija jednog majstora za jedan dan
     *
     * @param int $idMaj
     * @param DateTime @date;
     *
     * @return array vraca niz rezervacija
     */
    private function dohvatiRezervacijeInternal($idMaj, $date)
    {
        $ret = array();
        $kalendar = $this->doctrine->em->getRepository(\App\Models\Entities\Kalendar::class)
            ->dohvatiMajstorRezervisan($idMaj, $date);
        foreach ($kalendar as $kal) {
            $niz = explode(" ", $kal->getIdter()->getDatumvreme()->format("Y-m-d H:i"));
            $nizz = explode("-", $niz[1]);
            $id = "dugme" . (intval($nizz[0]));
            array_push($ret, [$id, $this->dohvatiOpisRezervacije($kal->getIdrez()) . ";" . $kal->getIdter()->getDatumvreme()->format("Y-m-d H:i")]);
        }
        return $ret;
    }



    /*
     * funckija koja dohvata sve rezervacije za odredjeni datum
     * onavezno GET
     * poziva dohvariRezervacijeInternal
     *
     * @param string $date
     *
     * return json
     */
    public function dohvatiRezervacije($date)
    {
        $id = $this->session->get('Korisnik')->idKor;
        $var = $this->request->getMethod();
        if ($var != 'get') {
            //potrebno popraviti da se salje error 500
            return json_encode([]);
        }
//        $date = $this->request->getVar('date');
        return json_encode($this->dohvatiRezervacijeInternal($id, $date));
    }

    /*
     * privatna funkcija sluzi kao pomocna za dobhvatanje radnih jednog majstora za jedan dan
     *
     * @param int $idMaj
     * @param DateTime @date;
     *
     * @return array vraca niz kalendar objekata
     */
    private function dohvatiRadneTermineInternal($idMaj, $date)
    {
        $ret = array();
        $kalendar = $this->doctrine->em->getRepository(\App\Models\Entities\Kalendar::class)
            ->dohvatiMajstorSlobodan($idMaj, $date);
        foreach ($kalendar as $kal) {
            $niz = explode(" ", $kal->getIdter()->getDatumvreme()->format("Y-m-d H:i"));
            $nizz = explode("-", $niz[1]);
            $id = "dugme" . (intval($nizz[0]));
            array_push($ret, $id);
        }
        return $ret;
    }


    /*
     * funckija koja dohvata sve radne termine za odredjeni datum
     * onavezno GET
     * poziva dohvatiRadneTermineInternal
     *
     * @param string $date
     *
     * return json
     */
    public function dohvatiRadneTermine($date)
    {
        $id = $this->session->get('Korisnik')->idKor;
        $var = $this->request->getMethod();
        if ($var != 'get') {
            //potrebno popraviti da se salje error 500
            return json_encode([]);
        }
//        $date = $this->request->getVar('date');
        return json_encode($this->dohvatiRadneTermineInternal($id, $date));
    }

    /*
     * privatna funkcija sluzi kao pomocna za dodavanje radnog termina jednog majstora za jedan dan
     *
     * @param int $idMaj
     * @param DateTime @date;
     * @param int $id vreme dana u koje se dodaje termin
     *
     * @return string
     */
    private function dodajRadniTerminInternal($idMaj, $date, $id)
    {
        $datumVreme = \DateTime::createFromFormat('Y-m-d H:i:s', $date . " " . $id . ":00:00");
        $termin = $this->doctrine->em->getRepository(\App\Models\Entities\Termin::class)
            ->findBy(['datumvreme' => $datumVreme]);
        if ($termin == []) {
            $termin = new Entities\Termin();
            $termin->setDatumvreme($datumVreme);
            $this->doctrine->em->persist($termin);
            $this->doctrine->em->flush();
        } else {
            $termin = $termin[0];
        }
        $kalendar = $this->doctrine->em->getRepository(\App\Models\Entities\Kalendar::class)
            ->findBy(['idter' => $termin, 'idmaj' => $idMaj]);
        if ($kalendar != []) {
            return "GRESKA termin vec postoji";
        }
        $kalendar = new  Entities\Kalendar();
        $kalendar->setIdmaj($idMaj);
        $kalendar->setIdter($termin);
        $this->doctrine->em->persist($kalendar);
        $this->doctrine->em->flush();
        return "OK";
    }

    /*
     * funckija koja ddodaje jedan radni termin u kalendar za maajstora
     * onavezno POST
     * poziva dohvatiRadneTermineInternal
     *
     * @uses int $_POST['index'] vreme dana kada se dodaje termin
     * @uses string $_POST['datum']
     *
     * return json
     */
    public function dodajRadniTermin()
    {
        $var = $this->request->getMethod();
        if ($var != 'post') {
            //potrebno popraviti da se salje error 500
            return "zahtev mora biti post";
        }
        $idMaj = $this->session->get("Korisnik")->idKor;
        $date = $this->request->getVar("datum");
        $id = $this->request->getVar("index");
        return $this->dodajRadniTerminInternal($idMaj, $date, $id);
    }

    private function skiniRadniTerminInternal($idMaj, $date, $id)
    {
        $datumVreme = \DateTime::createFromFormat('Y-m-d H:i:s', $date . " " . $id . ":00:00");
        $termin = $this->doctrine->em->getRepository(\App\Models\Entities\Termin::class)
            ->findBy(['datumvreme' => $datumVreme]);
        if ($termin == []) {
            $termin = new Entities\Termin();
            $termin->setDatumvreme($datumVreme);
            $this->doctrine->em->persist($termin);
            $this->doctrine->em->flush();
            return "GRESKA termin nije ni postojao";
        } else {
            $termin = $termin[0];
        }
        $kalendar = $this->doctrine->em->getRepository(\App\Models\Entities\Kalendar::class)
            ->findBy(['idter' => $termin, 'idmaj' => $idMaj]);
        if ($kalendar == []) {
            return "GRESKA termin ne postoji";
        }
        $kalendar = $kalendar[0];
        if ($kalendar->getIdrez() != null) {
            return "GRESKA termin je rezervisan";
        }
        $this->doctrine->em->remove($kalendar);
        $this->doctrine->em->flush();
        return "OK";
    }
    /*
     * funckija koja uklanja prosledjeni radni termin
     * obavezno POST
     *
     * poziva skiniRadniTerminInternal
     *
     * @uses string $_POST['datum']
     * @uses int $_POST['index']
     *
     * @return string
     */
    public function skiniRadniTermin()
    {
        $var = $this->request->getMethod();
        if ($var != 'post') {
            //potrebno popraviti da se salje error 500
            return "zahtev mora biti post";
        }
        $idMaj = $this->session->get("Korisnik")->idKor;
        $date = $this->request->getVar("datum");
        $id = $this->request->getVar("index");
        return $this->skiniRadniTerminInternal($idMaj, $date, $id);
    }

    /*
     * funkcija prikazuje stranicu za izmenu uslge prosledjene kao parametar poziva
     *
     * @param int $id id usluge koja se menja
     *
     * @return void
     */
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
        return $this->prikaz("izmenaUsluge", $podaci, 0);
    }

    /*
     * funckija koja vrsi izmenu usluge u bazi na osnovu parametara prosledjenih kroz zahtev
     * obavezno POST
     *
     *
     * @return string
     */
    public function izmenaUsluge()
    {
        $var = $this->request->getMethod();
        if ($var != 'post') {
            //potrebno popraviti da se salje error 500
            return "zahtev mora biti post";
        }


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
        }
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

    /*
     * funkcija koja prikazuje stranicu sa svim zahtevima ulogovanog majstora
     * stranica brise sve istekle zahteve iz baze
     *
     * @return void
     */
    public function zahtevi()
    {

        //$zahtevi= $this->doctrine->em->getRepository(\App\Models\Entities\Zahtev::class)->findAll();
        $id = $_SESSION['Korisnik']->idKor;
        $zahtevi = $this->doctrine->em->getRepository(\App\Models\Entities\Zahtev::class)->dohvatiZahteveMajstoraAktivne($id);
        $danas = date("Y:m:d");
        $ok = [];
        foreach ($zahtevi as $zahtev) {
            if ($zahtev->getIdter()->getDatumVreme()->format("Y:m:d") < ($danas)) {
                $this->doctrine->em->remove($zahtev);
            } else {
                array_push($ok, $zahtev);
            }
        }
        $this->doctrine->em->flush();
        return $this->prikaz("zahtevi", ['zahtevi' => $ok], 1);

        //return $zahtevi;
        // $ret = [];
        // foreach ($zahtevi as $zahtev) {
        //     array_push($ret, $zahtev->getOpis() . " " . $zahtev->getIdentifikator() . " " . $zahtev->getIdusl()->getIdmaj()->getIdkor());
        // }
        // $ret = json_encode($ret);
        // return $ret;
    }


    /*
     * funkcija koja se poziva kada majstor odabere opciju odbij zahtev
     * brise zahtev iz baze
     * obavezno POST
     *
     * @uses int $_POST['idZah']
     *
     * @return string
     */
    public function odbijZahtev()
    {
        $var = $this->request->getMethod();
        if ($var != 'post') {
            //potrebno popraviti da se salje error 500
            return "zahtev mora biti post";
        }
        $id = $this->request->getVar('idZah');
        $zahtev = $this->doctrine->em->getRepository(\App\Models\Entities\Zahtev::class)->find($id);
        $this->doctrine->em->remove($zahtev);
        $this->doctrine->em->flush();
        return "OK";
    }
    /*
     * funkcija koja se poziva kada majstor odabere opciju prihvati zahtev
     * brise sve ostale zahteve sa istim kljucem iz baze
     * takodje brise sve zahteve u terminu prihvacenog zahteva jednog majstora
     * obavezno POST
     *
     * @uses int $_POST['idZah']
     *
     * @return string
     */
    public function odobriZahtev()
    {
        $var = $this->request->getMethod();
        if ($var != 'post') {
            //potrebno popraviti da se salje error 500
            return "zahtev mora biti post";
        }
        $id = $this->request->getVar('idZah');
        $zahtev = $this->doctrine->em->getRepository(\App\Models\Entities\Zahtev::class)->find($id);
        $brisanjeIdentifikator = $this->doctrine->em->getRepository(\App\Models\Entities\Zahtev::class)
            ->dohvatiIdentifikatorZahteve($zahtev->getIdzah(), $zahtev->getIdentifikator());
        $brisanjeTermin = $this->doctrine->em->getRepository(\App\Models\Entities\Zahtev::class)
            ->dohvatiMajstorTermin($zahtev->getIdusl()->getIdmaj()->getIdkor(), $zahtev->getIdter()->getIdter(), $zahtev->getIdzah());
        $brisanje = array_merge($brisanjeTermin, $brisanjeIdentifikator);
        $ret = [];
        foreach ($brisanje as $brisi) {
            array_push($ret, $brisi->getIdzah());
            $this->doctrine->em->remove($brisi);
        }
        $ret = json_encode($ret);


        $zahtev->setIdentifikator(-1);

        $rezervacija = new Entities\Rezervacija();
        $rezervacija->setIdRez($zahtev);
        $rezervacija->setId($zahtev->getIdzah());
        $rezervacija->setIdmaj($zahtev->getIdusl()->getIdmaj());
        $rezervacija->setVremeodgovora(\DateTime::createFromFormat('y-m-d h:i:s', date('y-m-d h:i:s')));


        $this->doctrine->em->persist($zahtev);
        $this->doctrine->em->persist($rezervacija);

        $uslugaOstvarena = new Entities\UslugaOstvarena();
        $uslugaOstvarena->setIdrez($rezervacija);
        $uslugaOstvarena->setIdusl($zahtev->getIdusl());
        $uslugaOstvarena->setObrisano(0);
        $this->doctrine->em->persist($uslugaOstvarena);
        //$this->doctrine->em->flush();

        $terminKalendarNiz = $this->doctrine->em->getRepository(\App\Models\Entities\Kalendar::class)
            ->findBy(['idmaj' => $zahtev->getIdusl()->getIdmaj()->getIdkor(), 'idter' => $zahtev->getIdter()->getIdter()]);
        if (isset($terminKalendarNiz[0])) {
            $terminKalendar = $terminKalendarNiz[0];
            $terminKalendar->setIdrez($rezervacija);
        } else {
            $kalendar = new Entities\Kalendar();
            $kalendar->setIdmaj($zahtev->getIdusl()->getIdmaj()->getIdkor());
            $kalendar->setIdrez($rezervacija);
            $kalendar->setIdter($zahtev->getIdter());
            $this->doctrine->em->persist($kalendar);
        }
        $this->doctrine->em->flush();
        return "OK" . "\n" . $ret;

    }

}
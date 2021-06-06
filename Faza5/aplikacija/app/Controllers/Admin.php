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
use CodeIgniter\CLI\Console;
use CodeIgniter\Model;
use phpDocumentor\Reflection\Types\Array_;


class Admin extends BaseController
{

    /*
     *Zasticena funkcija, sluzi  za prikaz zeljene stranice
     *
     * @param string $stranica naziv stranice koja se iscrtava
     * @param array $podaci niz podataka koji su potrebni za pravilno iscrtavanje stranice
     * @param int $broj redni broj stranice u meniju, potreban radi izdvajanja te stranice u meniju
     *
     * @return void
     */
    protected function prikaz($stranica, $podaci, $broj)
    {
        $podaci['controller'] = "Admin";
        $podaci['ime'] = 'Admin';
        $podaci['prezime'] = 'Admin';
        $podaci['profilna'] = '#';
        $podaci['broj'] = $broj;
        echo view("osnova/header");
        echo view("admin/meni", $podaci);
        echo view("admin/$stranica", $podaci);
        echo view("osnova/footer");
    }

    /*
    * funcija koja obradjuje samo post zahtev. Koristi se za brisanje majstora iz baze.
    *
    * @uses int $_POST['id'] obavezno polje, id majstora koji se brise
    * @return string ok-sve je bilo u redu, bilo sta drugo-doslo je do greske
    */
    public function obrisiMajstora()
    {

        $var = $this->request->getMethod();
        if ($var != 'post') {
            //potrebno popraviti da se salje error 500
            return "zahtev mora biti post";
        }

        $id = $this->request->getVar('id');

        $korisniciModel = new Korisnikmodel();
        $korisniciModel->delete($id);

        return "OK";


    }

    /*
     * prikazuje stranicu pregledMajstora, sve informacije za majstore i njihove usluge
     *
     * @return void
     */
    public function pregledMajstora()
    {
        $uloga = 2;
        $majstori = $this->doctrine->em->getRepository(Entities\Korisnik::class)->findBy(['idulo' => $uloga, 'odobren' => 1]);
        $ostvarene = $this->doctrine->em->getRepository(Entities\UslugaOstvarena::class)->dohvatiOstvareneUsluge();

        return $this->prikaz('pregledMajstora', ['majstori' => $majstori, 'ostvarene' => $ostvarene], 1);
    }


    /*
     * prikazuje stranicu odobravanjeMajstora, sve neodobrene majstore
     *
     * @return void
     */
    public function odobravanjeMajstora()
    {
        $uloga = 2;
        $majstori = $this->doctrine->em->getRepository(Entities\Korisnik::class)->findBy(['idulo' => $uloga, 'odobren' => 0]);
        return $this->prikaz('odobravanjeMajstora', ['majstori' => $majstori], 2);
    }

    /*
     * privatna funkcija, poziva se iz odobriMajstora, sluzi za odobravanje majstora u bazi
     *
     * @param string id id majstora koji treba da se odobri
     * @return string ok-sve je bilo u redu, bilo sta drugo-doslo je do greske
     */
    private function odobriMajstoraInternal($id)
    {
        $majstor = $this->doctrine->em->getRepository(Entities\Korisnik::class)->findBy(['idkor' => $id])[0];
        $majstor->setOdobren("1");
        $this->doctrine->em->flush();
        return "OK";
    }
    /*
     * funkcija obradjuje samo post zahteve, koristi se za odorbavanje majstora u bazi
     * iz nje se poziva odobriMajstoraInternal
     *
     * $uses int $_POST['id'] obavezno polje, id majstra koji se odobrava
     *
     * @return string ok-sve je bilo u redu, bilo sta drugo-doslo je do greske
     */
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

    /*
     * privatna funkcija, poziva se iz ukloniMajstora, sluzi za uklanjanje majstora iz baze
     *
     * @param string id id majstora koji treba da se ukloni
     * @return string ok-sve je bilo u redu, bilo sta drugo-doslo je do greske
     */
    private function ukloniMajstoraInternal($id)
    {
        $majstor = $this->doctrine->em->getRepository(Entities\Korisnik::class)->findBy(['idkor' => $id, 'odobren' => 0])[0];
        $this->doctrine->em->remove($majstor);
        $this->doctrine->em->flush();
        return "OK";
    }


    /*
     * funkcija obradjuje samo post zahteve, koristi se za uklanjanje majstora iz baze
     * iz nje se poziva ukloniMajstoraInternal
     *
     * $uses int $_POST['id'] obavezno polje, id majstra koji se brise
     *
     * @return string ok-sve je bilo u redu, bilo sta drugo-doslo je do greske
     */
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
        return $sum / sizeof($ostvarene) * 100;
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
    public function prikazMajstoraAdmin()
    {
        //print_r($_POST);
        $var = $this->request->getMethod();
        if ($var != 'post') {
            //potrebno popraviti da se salje error 500
            return "zahtev mora biti post";
        }
        $id = $this->request->getVar('id');

        $majstor = $this->doctrine->em->getRepository(\App\Models\Entities\Korisnik::class)->findBy(['idkor' => $id])[0];

        //$usluge = [];
        $usluge = $this->doctrine->em->getRepository(\App\Models\Entities\Usluga::class)->findBy(['idmaj' => $id]);
        $ostvarene = $this->doctrine->em->getRepository(Entities\UslugaOstvarena::class)->dohvatiOstvareneUslugeMajstora($id);

        $vreme = $this->vremeOdgovora($ostvarene);
        $preporuke = $this->preporuke($ostvarene);
        $cena = $this->prosecnaCena($usluge);
        return $this->prikaz("detaljnijiPrikazMajstora", ['majstor' => $majstor, 'usluge' => $usluge, 'ostvarene' => $ostvarene,
            'vreme' => $vreme, 'preporuke' => $preporuke, 'cena' => $cena], 1);
    }

    /*
     * funcija za brisanje komentara
     *
     * @uses int $_REQUEST['idOstvUsl'] id ostvarene usluge sa koje se brise komentar
     *
     * @return void
     */
    public function obrisiKomentar()
    {
        $id = $this->request->getVar('idOstvUsl');
        $ostvarena = $this->doctrine->em->getRepository(\App\Models\Entities\UslugaOstvarena::class)->find($id);
        $ostvarena->setKomentar("Komentar je obrisan od strane admina");
        $this->doctrine->em->persist($ostvarena);
        $this->doctrine->em->flush();
    }
}
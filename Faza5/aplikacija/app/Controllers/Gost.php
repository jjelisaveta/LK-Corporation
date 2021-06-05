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

use App\Models\KorisnikModel;
use App\Models\UlogaModel;

class Gost extends BaseController
{
    /*
     *Zasticena funkcija, sluzi  za prikaz zeljene stranice
     *
     * @param string $stranica naziv stranice koja se iscrtava
     * @param array $greske niz podataka koji su potrebni za pravilno iscrtavanje stranice
     *
     * @return void
     */
    protected function prikazi($stranica, $greske)
    {
        echo view("osnova/headerBezMenija");
        echo view($stranica, $greske);
        echo view("osnova/footerBezMenija");
    }

    /*
     *Zasticena funkcija, sluzi  za prikaz zeljene stranice, zajedno sa menijem
     *
     * @param string $stranica naziv stranice koja se iscrtava
     * @param array $podaci niz podataka koji su potrebni za pravilno iscrtavanje stranice
     *
     * @return void
     */
    protected function prikaziSaMenijem($stranica, $podaci)
    {
        if ($this->session->get('Korisnik')->idUlo == 3) {
            $podaci['controller'] = "Korisnik";
        } else {
            if ($this->session->get('Korisnik')->idUlo == 2) {
                $podaci['controller'] = "Majstor";
            }
        }
        $podaci['gost'] = 'nije';
        $podaci['broj'] = 0;
        $podaci['ime'] = $this->session->get('Korisnik')->ime;
        $podaci['prezime'] = $this->session->get('Korisnik')->prezime;
        $podaci['profilna'] = $this->session->get('Korisnik')->slika;
        echo view("osnova/header");
        if ($podaci['controller'] == 'Korisnik') {
            echo view("osnova/meni", $podaci);

        } else {
            if($podaci['controller'] == 'Majstor'){
                echo view("majstor/meni", $podaci);
            }else{
                echo view("admin/meni", $podaci);
            }
        }
        echo view($stranica, $podaci);
        echo view("osnova/footer");
    }

    /*
     *zasticena funkcija za kopiranje korisnicke slike na server
     *
     *@param &array $greske niz gresaka, ukoliko nisu ispostovani zahtevi u taj niz se upisuje informacija o greski
     *
     * @return void
     */
    protected function uzmiPutanju(&$greska): string
    {
        $target_dir = "slike/";
        $target_file = $target_dir . basename($_FILES["izaberiSliku"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["izaberiSliku"]["tmp_name"]);

        if ($check == false) {
            $greska['GreskaSlika'] = 'Fajl koji ste prilozili nije slika!';
            return "";
        }

        if ($_FILES["izaberiSliku"]["size"] > 1000000) {
            $greska['GreskaSlika'] = 'Slika koju ste prilozili je veca od 1mb!';
            return "";
        }

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            $greska['GreskaSlika'] = 'Slika nije u formatu JPG, JPEG ili PNG!';
            return "";
        }

        if (move_uploaded_file($_FILES["izaberiSliku"]["tmp_name"], $target_file)) {
            return $target_file;
        } else {
            $greska['GreskaSlika'] = 'Desila se greska pri ucitavanju slike!';
            return "";
        }
    }

    /*
     * funkcija za prikas stranice za neovlasceni pristup
     *
     * @return void
     */
    public function neovlascen()
    {
        echo view("gost/neovlascen");
    }

    /*
     * funckija za logovanje, obavezno post zahtev
     *
     * @uses string $_POST['email'] e-mail korisnika
     * @uses string $_POST['lozinka'] lozinka korisnika
     *
     * @return redirect preusmerava korisnika na stranicu u zavisnosti od tipa uloge ulogovanog korisnika, ili stranica sa greskama ukoliko nije uspesno logovanje
     */
    public function loginSubmit()
    {
        $stranica = 'gost/Logovanje';
        if (!$_POST) {
            return $this->prikazi($stranica, []);
        }
        helper(['form']);
        $data = [];
        if ($this->request->getMethod() == 'post') {
            if($this->request->getVar('email') == "admin" && $this->request->getVar('lozinka') == "1admin1"){
                $kmod = new KorisnikModel();
                $admin = $kmod->where('email',"admin")->findAll();
                if($admin != null){
                    $this->session->set('GostJe',0);
                    $this->session->set('Korisnik', $admin[0]);
                    return redirect()->to(site_url('Admin/odobravanjeMajstora'));
                }
            }
            $rules = ['email' => [
                'rules' => 'required|valid_email',
                'label' => 'E-adresa',
                'errors' => [
                    'required' => 'E-adresa je obavezno polje!',
                    'valid_email' => 'E-adresa nije validna'
                ]],
                'lozinka' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Lozinka je obavezno polje!',
                    ]]];
            if ($this->validate($rules)) {
                $korisnikModel = new KorisnikModel();
                $korisnik = $korisnikModel->where('email', $this->request->getVar('email'))->findAll();
                if ($korisnik == null) {
                    $data['LosaAdresa'] = 'Korisnik sa zadatom e-adresom ne postoji u bazi!';
                    return $this->prikazi($stranica, $data);
                } else {
                    if ($korisnik[0]->lozinka != $this->request->getVar('lozinka')) {
                        $data['LosaLozinka'] = 'Uneta je pogresna lozinka!';
                        return $this->prikazi($stranica, $data);
                    } else {
                        if ($korisnik[0]->odobren != 1) {
                            $data['LosaAdresa'] = 'Administrator jos uvek nije odobrio korisnika!';
                            return $this->prikazi($stranica, $data);
                        }
                        $this->session->set('GostJe', 0);
                        $this->session->set('Korisnik', $korisnik[0]);
                        if ($this->session->get('Korisnik')->idUlo == 3) {
                            return redirect()->to(site_url('Klijent/pretrazivanje'));
                        } else {
                            return redirect()->to(site_url('Majstor/mojeUsluge'));
                        }

                    }
                }
            } else {
                if ($this->validator->hasError('email')) {
                    $data['LosaAdresa'] = $this->validator->getError('email');
                }
                if ($this->validator->hasError('lozinka')) {
                    $data['LosaLozinka'] = $this->validator->getError('lozinka');
                }
                return $this->prikazi($stranica, $data);
            }
        }
    }

    /*
     * zasticena funckija koja vraca id uloge koja odgovara prosledjenom stringu
     *
     * @param string $zanimanje
     *
     * @return int
     */
    protected function dodeliUlogu($zanimanje): int
    {
        $um = new UlogaModel();
        $id = 0;
        if ($zanimanje == 'Korisnik') {
            $tmp = $um->where('naziv', 'korisnik')->findAll();
            return $tmp[0]->idUlo;
        } else {
            $tmp = $um->where('naziv', 'majstor')->findAll();
            return $tmp[0]->idUlo;
        }
    }
    /*
     * funckija za prikazuje stranicu za registraciju ili registruje korisnika u zavisnosti od tipa zahteva (get, post)
     *
     * @return redirect preusmerava na stranicu u zavisnosti od tipa korisnika, ili prikazuje greske ukoliko nije ispostovan format polja za registraciju
     */
    public function registrujSe()
    {                  //Zavrseno
        $stranica = 'gost/Registrovanje';
        if (!$_POST) {
            return $this->prikazi($stranica, []);
        }
        helper(['form']);
        $data = [];
        if ($this->request->getMethod() == 'post') {
            $rules = ['ime' => [
                'rules' => 'required|validIme',
                'errors' => [
                    'required' => 'Ime i prezime su obavezna polja!',
                    'validIme' => 'Ime i prezime moraju da sadrze samo slova!'
                ]],
                'prezime' => [
                    'rules' => 'required|validIme',
                    'errors' => [
                        'required' => 'Ime i prezime su obavezna polja!',
                        'validIme' => 'Ime i prezime moraju da sadrze samo slova!'
                    ]],
                'telefon' => [
                    'rules' => 'required|validTelefon',
                    'errors' => [
                        'required' => 'Telefon je obavezno polje!',
                        'validTelefon' => 'Telefon mora da sadrzi samo cifre!'
                    ]],
                'adresa' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Adresa je obavezno polje!',
                    ]],
                'email' => [
                    'rules' => 'required|valid_email',
                    'label' => 'E-adresa',
                    'errors' => [
                        'required' => 'E-adresa je obavezno polje!',
                        'valid_email' => 'E-adresa nije validna'
                    ]],
                'lozinka' => [
                    'rules' => 'required|min_length[8]',
                    'errors' => [
                        'required' => 'Lozinka je obavezno polje!',
                        'min_length' => 'Lozinka mora biti duzine bar 8 znakova!'
                    ]]];
        }
        if ($this->validate($rules)) {
            $km = new KorisnikModel();
            $duplikat = $km->where('email', $this->request->getVar('email'))->findAll();
            if ($duplikat != null) {
                $data['LoseEmail'] = 'Već postoji korisnik sa zadatom e-adresom';
                $this->prikazi($stranica, $data);
            } else {
                $putanja = 'slike/profilna.png';
                if ($_FILES["izaberiSliku"]["size"] != 0) {
                    $putanja = $this->uzmiPutanju($data);
                }
                
                $uloga = $this->dodeliUlogu($this->request->getVar('uloga'));
                $odobrenI = 0;
                if ($this->request->getVar('uloga') == 'Korisnik') {
                    $odobrenI = 1;
                }

                $km->save([
                    'ime' => $this->request->getVar('ime'),
                    'prezime' => $this->request->getVar('prezime'),
                    'email' => $this->request->getVar('email'),
                    'brojTelefona' => $this->request->getVar('telefon'),
                    'lozinka' => $this->request->getVar('lozinka'),
                    'adresa' => $this->request->getVar('adresa'),
                    'slika' => $putanja,
                    'idUlo' => $uloga,
                    'odobren' => $odobrenI
                ]);
                $objektI = $km->where('email', $this->request->getVar('email'))->findAll();

                if ($odobrenI == 1) {
                    $this->session->set('GostJe', 0);
                    $this->session->set('Korisnik', $objektI[0]);
                    return redirect()->to(site_url('Klijent/pretrazivanje'));
                } else {
                    $stranica = 'gost/neodobren';
                    $this->prikazi($stranica, $data);
                }
            }
        } else {
            if ($this->validator->hasError('ime')) {
                $data['LoseImePrezime'] = $this->validator->getError('ime');
            }
            if ($this->validator->hasError('prezime')) {
                $data['LoseImePrezime'] = $this->validator->getError('prezime');
            }
            if ($this->validator->hasError('telefon')) {
                $data['LoseTelefon'] = $this->validator->getError('telefon');
            }
            if ($this->validator->hasError('email')) {
                $data['LoseEmail'] = $this->validator->getError('email');
            }
            if ($this->validator->hasError('adresa')) {
                $data['LosaAdresa'] = $this->validator->getError('adresa');
            }
            if ($this->validator->hasError('lozinka')) {
                $data['LosaLozinka'] = $this->validator->getError('lozinka');
            }
            $this->prikazi($stranica, $data);
        }
    }
    /*
     * funckija za prikazuje stranicu za promenu podataka ili promenu podataka korisnika u zavisnosti od tipa zahteva (get, post)
     * ukoliko su svi formati ispostovani stranica prikazuje obavestenje o uspesnoj promeni podataka, u suprotnom ispisuje gresku
     *
     * @return void
     */
    public function promeniPodatke()
    {
        $stranica = 'gost/promeniPodatke';
        $data = [];
        if (!$_POST) {
            $this->prikaziSaMenijem($stranica, $data);
            return;
        }
        helper(['form']);
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'telefon' => [
                    'rules' => 'validTelefon',
                    'errors' => [
                        'validTelefon' => 'Telefon mora da sadrzi samo cifre!'
                    ]],
                'lozinka' => [
                    'rules' => 'min_length[8]',
                    'errors' => [
                        'min_length' => 'Lozinka mora biti duzine bar 8 znakova!'
                    ]]];
        }
        $this->validate($rules);
        if ((!$this->validator->hasError('lozinka') || $this->request->getVar('lozinka') == null) &&
            (!$this->validator->hasError('telefon') || $this->request->getVar('telefon') == null)) {
            $km = new KorisnikModel();
            $trenutni = $km->where('email', $this->session->get('Korisnik')->email)->findAll();
            if($this->request->getVar('StaraLozinka') != $trenutni[0]->lozinka){
                $data['LosePonovljenaLozinka'] = 'Netacna lozinka!';
                $this->prikaziSaMenijem($stranica, $data);
                return ;
            }
            
            $putanja = '';
            $deb = "";
            if ($_FILES["izaberiSliku"]["size"] != 0) {
                $putanja = $this->uzmiPutanju($data);
                $this->session->get('Korisnik')->slika = $putanja;
            }
            $putanja = $this->session->get('Korisnik')->slika;
            
            if ($this->request->getVar('telefon') != null) {
                $this->session->get('Korisnik')->telefon = $this->request->getVar('telefon');
                $trenutni[0]->brojTelefona = $this->request->getVar('telefon');
            }

            if ($this->request->getVar('adresa') != null) {
                $this->session->get('Korisnik')->adresa = $this->request->getVar('adresa');
                $trenutni[0]->adresa = $this->request->getVar('adresa');
            }

            if ($this->request->getVar('lozinka') != null) {
                $this->session->get('Korisnik')->lozinka = $this->request->getVar('lozinka');
                $trenutni[0]->lozinka = $this->request->getVar('lozinka');
            }
            $km->update($trenutni[0]->idKor, [
                'brojTelefona' => $trenutni[0]->brojTelefona,
                'adresa' => $trenutni[0]->adresa,
                'lozinka' => $trenutni[0]->lozinka,
                'slika' => $putanja
            ]);
            $data['Ok'] = 'Podatci su azurirani! ';
            $this->prikaziSaMenijem($stranica, $data);
            return;
        } else {
            if ($this->validator->hasError('lozinka')) {
                $data['LoseLozinka'] = $this->validator->getError('lozinka');
            }
            if ($this->validator->hasError('telefon')) {
                $data['LoseTelefon'] = $this->validator->getError('telefon');
            }
            $this->prikaziSaMenijem($stranica, $data);
            return;
        }
    }

    /*
     * funkcija koja vrsi izlogovanje korisnika, unistavanjem trenutne sesije na serveru
     *
     *
     * @return void
     */
    public function izlogujSe()
    {
        $this->session->destroy();
        $this->loginSubmit();
    }

}
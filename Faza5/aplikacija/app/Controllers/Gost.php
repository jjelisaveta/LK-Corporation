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
    protected function prikazi($stranica, $greske){
        echo view("osnova/headerBezMenija");
        echo view($stranica, $greske);
        echo view("osnova/footerBezMenija");
    }

    protected function prikaziSaMenijem($stranica, $podaci){
        if($this->session->get('Korisnik')->idUlo == 0){
            $podaci['controller'] = "Korisnik";
        }else{
            $podaci['controller'] = "Majstor";
        }
        $podaci['ime'] = $this->session->get('Korisnik')->ime;
        $podaci['prezime'] = $this->session->get('Korisnik')->prezime;
        $podaci['profilna'] = $this->session->get('Korisnik')->slika;
        echo view("osnova/header");
        echo view("majstor/meni", $podaci);         // ovde kad bude za korisnika zavrsena strancia ubaci njegov link                
        echo view($stranica, $podaci);       
        echo view("osnova/footer");
    }
	
    
    protected function uzmiPutanju(&$greska) : string{
        $target_dir = "slike/";
        $target_file = $target_dir . basename($_FILES["izaberiSliku"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["izaberiSliku"]["tmp_name"]);
        
        if($check == false) {
            $greska['GreskaSlika'] = 'Fajl koji ste prilozili nije slika!';
            return "";
        }
        
        if ($_FILES["izaberiSliku"]["size"] > 1000000) {
            $greska['GreskaSlika'] = 'Slika koju ste prilozili je veca od 1mb!';
            return "";
        }
        
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"){
            $greska['GreskaSlika'] = 'Slika nije u formatu JPG, JPEG ili PNG!';
            return "";
        }
        
        if (move_uploaded_file($_FILES["izaberiSliku"]["tmp_name"], $target_file)) {
           return $target_file;
        }else{
            $greska['GreskaSlika'] = 'Desila se greska pri ucitavanju slike!';
            return "";
        }
    }
    public function loginSubmit(){
        $stranica = 'gost/Logovanje';
        if (!$_POST){
            return $this->prikazi($stranica, []);
        }
        helper(['form']);
        $data = [];
        if($this->request->getMethod() == 'post'){
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
            if($this->validate($rules)){
                $korisnikModel = new KorisnikModel();
                $korisnik = $korisnikModel->where('email',$this->request->getVar('email'))->findAll();
                if($korisnik == null){
                    $data['LosaAdresa'] = 'Korisnik sa zadatom e-adresom ne postoji u bazi!';
                    return $this->prikazi($stranica, $data);
                }else{
                    if($korisnik[0]->lozinka!=$this->request->getVar('lozinka')){
                        $data['LosaLozinka'] = 'Uneta je pogresna lozinka!';
                        return $this->prikazi($stranica, $data);
                    }else{
                        if($korisnik[0]->odobren!= 1){
                            $data['LosaAdresa'] = 'Administrator jos uvek nije odobrio korisnika!';
                            return $this->prikazi($stranica, $data);
                        }
                        $this->session->set('GostJe',0);                  
                        $this->session->set('Korisnik', $korisnik[0]);
                        return redirect()->to(site_url('Majstor/dodajUslugu'));
                    }
                }
            }else{
                if ($this->validator->hasError('email')){
                    $data['LosaAdresa'] = $this->validator->getError('email');
                }
                if ($this->validator->hasError('lozinka')){
                    $data['LosaLozinka'] = $this->validator->getError('lozinka');
                }
                return $this->prikazi('Majstor/dodajUslugu', $data);            //dodato za testiranje promene podataka
                //ko zeli moze da skloni ali nek napise isti ovakav komentar da znam
            }
        }
    }

    protected function dodeliUlogu($zanimanje) : int {
        $um = new UlogaModel();
        $id = 0;
        if($zanimanje == 'Korisnik'){
            $tmp = $um->where('naziv','korisnik')->findAll();
            return $tmp[0]->idUlo;
        }else{
            $tmp = $um->where('naziv','majstor')->findAll();
            return $tmp[0]->idUlo;
        }
    }
    
    public function registrujSe(){                  //Zavrseno
        $stranica = 'gost/Registrovanje';
         if (!$_POST){
            return $this->prikazi($stranica, []);
        }
        helper(['form']);
        $data = [];
        if($this->request->getMethod() == 'post'){
                $rules = ['ime' => [
                'rules' => 'required|validIme',
                'errors' => [
                    'required' => 'Ime i prezime su obavezna polja!',
                    'validIme' => 'Ime i prezime moraju da sadrze samo slova!'
                ]],
                'prezime' => [
                'rules' => 'required|validIme',
                'errors' => [
                    'required' => 'Ime i Prezime su obavezna polja!',
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
        if($this->validate($rules)){
            $km = new KorisnikModel();
            $duplikat = $km->where('email',$this->request->getVar('email'))->findAll();
            if($duplikat != null){
                $data['LoseEmail'] = 'Već postoji korisnik sa zadatom e-adresom';
                $this->prikazi($stranica,$data);
            }else{
                $putanja = 'slike/profilna.png'; 
                if($_FILES["izaberiSliku"]["size"] != 0){
                    $putanja = $this->uzmiPutanju($data);
                }
                if($putanja == ""){
                    $this->prikazi($stranica, $data);
                    return ;
                }
                $uloga = $this->dodeliUlogu($this->request->getVar('uloga'));
                $km->save([
                    'ime' => $this->request->getVar('ime'),
                    'prezime' => $this->request->getVar('prezime'),
                    'email' => $this->request->getVar('email'),
                    'brojTelefona' => $this->request->getVar('telefon'),
                    'lozinka' => $this->request->getVar('lozinka'),
                    'adresa' => $this->request->getVar('adresa'),
                    'slika' => $putanja,
                    'idUlo' => $uloga,
                    'odobren' => 0
                ]);
                $stranica = 'gost/neodobren';
                $this->prikazi($stranica,$data);
            }
        }else{
            if ($this->validator->hasError('ime')){
                $data['LoseImePrezime'] = $this->validator->getError('ime');
            }
            if($this->validator->hasError('prezime')){
                $data['LoseImePrezime'] = $this->validator->getError('prezime');
            }
            if($this->validator->hasError('telefon')){
                $data['LoseTelefon'] = $this->validator->getError('telefon');
            }
            if($this->validator->hasError('email')){
                $data['LoseEmail'] = $this->validator->getError('email');
            }
            if($this->validator->hasError('adresa')){
                $data['LosaAdresa'] = $this->validator->getError('adresa');
            }
            if($this->validator->hasError('lozinka')){
                $data['LosaLozinka'] = $this->validator->getError('lozinka');
            }
            $this->prikazi($stranica,$data);
        }
    }

    public function promeniPodatke(){
        $rules = 'KURCINA';
        $stranica = 'gost/promeniPodatke';
        $data = [];
        if (!$_POST){
            $this->prikaziSaMenijem($stranica, $data);
            return ;
        }
        helper(['form']);
        if($this->request->getMethod() == 'post'){
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
        if((!$this->validator->hasError('lozinka') || $this->request->getVar('lozinka') == null)  && 
                (!$this->validator->hasError('telefon') || $this->request->getVar('telefon') == null)){
            $km = new KorisnikModel();
            $trenutni = $km->where('email',$this->session->get('Korisnik')->email)->findAll();
            $putanja = 'slike/profilna.png'; 
            $deb = "";
            if($_FILES["izaberiSliku"]["size"] != 0){
                $putanja = $this->uzmiPutanju($data);
                $this->session->get('Korisnik')->slika = $putanja;
            }
            if($putanja == ''){
                $this->prikaziSaMenijem($stranica,$data);
            }
            if($this->request->getVar('telefon') != null){
                $this->session->get('Korisnik')->telefon = $this->request->getVar('telefon');
                $trenutni[0]->brojTelefona = $this->request->getVar('telefon');
            }
            
            if($this->request->getVar('adresa') != null){
                $this->session->get('Korisnik')->adresa = $this->request->getVar('adresa');
                $trenutni[0]->adresa = $this->request->getVar('adresa');
            }
            
            if($this->request->getVar('lozinka') != null){
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
            $this->prikaziSaMenijem($stranica,$data);
            return ;
        }else{
            if ($this->validator->hasError('lozinka')){
                $data['LoseLozinka'] = $this->validator->getError('lozinka');
            }
            if($this->validator->hasError('telefon')){
                $data['LoseTelefon'] = $this->validator->getError('telefon');
            }
            $this->prikaziSaMenijem($stranica,$data);
            return ;
        }
    }
            
    public function izlogujSe(){
        $this->session->destroy();
        $this->loginSubmit();
    }
    
}


/* >update(['departed' => false]); */
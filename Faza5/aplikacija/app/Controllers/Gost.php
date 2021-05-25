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

class Gost extends BaseController
{
    protected function prikazi($stranica, $greske){
        echo view("osnova/headerBezMenija");
        echo view($stranica, $greske);
        echo view("osnova/footerBezMenija");
    }
    
    protected  $greska;
    
    public function pretrazivanje(){
        echo "Ovo Jovan treba da uradi";
    }
    
    protected function uzmiPutanju() : string{
        $target_dir = "slike/";
        $target_file = $target_dir . basename($_FILES["izaberiSliku"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["izaberiSliku"]["tmp_name"]);
        
        if($check == false) {
            $greska['slika'] = 'Fajl koji ste prilozili nije slika!';
            return null;
        }
        
        if ($_FILES["izaberiSliku"]["size"] > 1000000) {
            $greska['slika'] = 'Slika koju ste prilozili je veca od 1mb!';
            return null;
        }
        
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"){
            $greska['slika'] = 'Slika nije u formatu JPG, JPEG ili PNG!';
            return null;
        }
        
        if (move_uploaded_file($_FILES["izaberiSliku"]["tmp_name"], $target_file)) {
           return $target_file;
        }else{
            $greska['slika'] = 'Desila se greska pri ucitavanju slike!';
            return null;
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
                        $this->session->set('GostJe',0);                    //dajem vam indikator da li je gost u pitanju
                        $this->session->set('Korisnik', $korisnik[0]);
                        return redirect()->to(site_url('Gost'));
                    }
                }
            }else{
                if ($this->validator->hasError('email')){
                    $data['LosaAdresa'] = $this->validator->getError('email');
                }
                if ($this->validator->hasError('lozinka')){
                    $data['LosaLozinka'] = $this->validator->getError('lozinka');
                }
                return $this->prikazi($stranica, $data);
            }
        }
    }
    
    public function registrujSe(){                  //tek treba da se radi
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
                $putanja = ''; 
/*               if($this->request->getVar('izaberiSliku') != null){
                    $putanja = $this->uzmiPutanju();
                }*/
                $uloga = 1;
                if($this->request->getVar('adresa') == 'Korisnik'){
                    $uloga = 3;
                }else{
                    $uloga = 2;
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
                    'odobren' => 0
                ]);
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
    
}

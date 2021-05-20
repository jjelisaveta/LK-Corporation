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
use App\Models\UslugaModel;

class Majstor extends BaseController {
    
    protected function prikaz($stranica, $podaci){
        $podaci['controller'] ="Majstor";
        $podaci['ime'] = 'Code';
        $podaci['prezime']='Igniter';
        echo view("osnova/header");
        echo view("majstor/meni", $podaci);
        echo view("majstor/$stranica", $podaci);
        echo view("osnova/footer");
    }
    
    
    public function dodajUslugu(){
        $this->prikaz("dodavanjeusluga",[]);
        
        
       // echo($this->request->getVar("naslov"));
       
        //redirect()->to(site_url("Majstor/novaUsluga"));
    }
    
    public function novaUsluga(){
        
        //napraviti uslugaModel i to ubaciti u bazu posle provere ispravnosti podataka
        
        $uslugaModel = new UslugaModel();
        $uslugaModel->save([
            'idUsl'=>1,
            'naziv'=>$this->request->getVar('naslov'),
            'opis'=>$this->request->getVar('opis'),
            'cena'=>$this->request->getVar('cena'),
            'idMaj'=>1
        ]);
        
        
        echo ("dodata je nova usluga:");
        echo($this->request->getVar("naslov"));
        echo($this->request->getVar('opis'));
        echo($this->request->getVar("cena"));
        
        
    }
    
    public function mojeUsluge(){
        
        $uslugaModel = new UslugaModel();
        echo ($uslugaModel->getInsertId());
    }
}

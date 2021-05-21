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
use App\Models\TagModel;
use App\Models\UslugaTagModel;

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
    
    
    public function dodajUslugu(){
        
        $tagModel = new TagModel();
        $tagovi = $tagModel->findAll();
        
        $this->prikaz("dodavanjeusluga",['tagovi'=>$tagovi]);      

        // echo($this->request->getVar("naslov"));
        //redirect()->to(site_url("Majstor/novaUsluga"));
    }

    public function novaUsluga() {
        //ispravnost podataka
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
    
    public function mojeUsluge(){
        $uslugaModel = new UslugaModel();
        $usluge = $uslugaModel->where('idMaj',1)->findAll();  //stavi id ulogovanog korisnika
       /* $uslugaTagModel = new UslugaTagModel();
        $tagModel = new TagModel();
        foreach ($usluge as $usluga){
            $tagoviId = $uslugaTagModel->where('idUsl', $usluga->idUsl)->findAll();
        }*/
        
        $this->prikaz("mojeUsluge",['usluge'=>$usluge]);
    }

    public function kalendar()
    {
        $termini = [];
        for ($i = 0; $i < 4; $i++) {
            for ($j = 0; $j < 3; $j++) {
                $termin = new \App\Libraries\KalendarTermin((($i * 3 + $j) * 2) . "-" . (($i * 3 + $j) * 2 + 2));
                array_push($termini, $termin);
            }
        }
        $data["termini"] = $termini;
        $this->prikaz("kalendar", $data);
    }

}

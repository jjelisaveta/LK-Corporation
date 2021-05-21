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

use App\Models\Kalendar;
use App\Models\KalendarModel;
use App\Models\UslugaModel;
use App\Models\TagModel;

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


    public function dodajUslugu()
    {

        $tagModel = new TagModel();
        $tagovi = $tagModel->findAll();

        $this->prikaz("dodavanjeusluga", ['tagovi' => $tagovi]);

        // echo($this->request->getVar("naslov"));
        //redirect()->to(site_url("Majstor/novaUsluga"));
    }

    public function novaUsluga()
    {

        $t = $this->request->getVar('izabraniTagovi');
        $tagovi = explode("#", $t);

        /*dodati redove u Usluga-Tag i proveriti ispravnost podataka*/
        /*
        $uslugaModel = new UslugaModel();
        $uslugaModel->save([
            'idUsl' => 1,
            'naziv' => $this->request->getVar('naslov'),
            'opis' => $this->request->getVar('opis'),
            'cena' => $this->request->getVar('cena'),
            'idMaj' => 1
        ]);
        */
    }

    public function mojeUsluge()
    {
        $this->prikaz("mojeUsluge", []);
    }

    public function kalendar($date = null)
    {

        $termini = [];
        for ($i = 0; $i < 4; $i++) {
            for ($j = 0; $j < 3; $j++) {
                $termin = new \App\Libraries\KalendarTermin((($i * 3 + $j) * 2) . "-" . (($i * 3 + $j) * 2 + 2));
                array_push($termini, $termin);
            }
        }
        $kalendarModel = new KalendarModel();
//        $kalendarModel->save([
//            'idMaj' => 1,
//            'idTer' => 19
//        ]);
        $kalendar = $kalendarModel->getWhere("idMaj", 1);
        if (!isset($date)) {
            $date = date("Y-m-d");
        }
        $data["termini"] = $termini;
        $data["date"] = $date;
        $data["kalendar"] = $kalendar;
        $this->prikaz("kalendar", $data);
    }

}

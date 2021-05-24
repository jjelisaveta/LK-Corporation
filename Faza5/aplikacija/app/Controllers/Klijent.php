<?php

namespace App\Controllers;

class Klijent extends BaseController
{
    
    public function index()
	{
		return view('welcome_message');
	}
	

	

    protected function prikaz($stranica, $podaci)
    {
        $podaci['controller'] = "Klijent";
        $podaci['ime'] = 'Code';
        $podaci['prezime'] = 'Igniter';
        echo view("osnova/header");
        echo view("osnova/meni", $podaci);
        echo view("klijent/$stranica", $podaci);
        echo view("osnova/footer");
    }
    public function istorija(){
        
        $uslugaOstvareneModel = new UslugaOstvarenaModel();

        $uslugeOstvarene = $uslugaOstvareneModel->where('idMaj',1)->findAll(); 
        $this->prikaz("istorija",['uslugeOstvarene'=>$uslugeOstvarene]);      

        // echo($this->request->getVar("naslov"));
        //redirect()->to(site_url("Majstor/novaUsluga"));
    }
}
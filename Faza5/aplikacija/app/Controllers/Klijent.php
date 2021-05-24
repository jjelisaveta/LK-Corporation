<?php

namespace App\Controllers;

use App\Models\UslugaOstvarenaModel;
use App\Models\RezervacijaModel;
use App\Models\KorisnikModel;
use App\Models\UslugaModel;
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

        $uslugaModel= new UslugaModel();
        $korisniciModel= new KorisnikModel();
        $rezervacijaModel= new RezervacijaModel();
        $this->prikaz("istorija",['uslugeOst'=>$uslugaOstvareneModel,'usluge'=>$uslugaModel,'korisnici'=>$korisniciModel,
        'rezervacije'=>$rezervacijaModel]);      


    }
    public function sacuvajKomentar()
    {
      
      $id=(int) $this->request->getVar('hidden');
     
       $uslugaOstvareneModel = new UslugaOstvarenaModel();
       $data = [
        'komentar' => $this->request->getVar('komentar')
    ];
    
       $uslugaOstvareneModel->update($id,$data);

    }
}
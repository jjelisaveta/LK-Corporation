<?php

namespace App\Controllers;

use App\Models\UslugaOstvarenaModel;
use App\Models\RezervacijaModel;
use App\Models\KorisnikModel;
use App\Models\UslugaModel;
use App\Models\ZahtevModel;
use App\Models\TerminModel;
class Klijent extends BaseController
{

    public function index()
    {
        return view('welcome_message');
    }


    protected function prikaz($stranica, $podaci)
    {
    /*    $podaci['ime'] = $this->session->get('Korisnik')->ime;
        $podaci['prezime'] = $this->session->get('Korisnik')->prezime;
        $podaci['profilna'] = $this->session->get('Korisnik')->slika;*/
        $podaci['ime'] = 'Jovan';
        $podaci['prezime'] = 'Pavlovic';
        $podaci['profilna'] = '';
        echo view("osnova/header");
        echo view("osnova/meni", $podaci);
        echo view("klijent/$stranica", $podaci);
        echo view("osnova/footer");
    }
    
    public function pretraga(){
        $stranica = 'pretrazivanje';
        $allTags = $this->doctrine->em->getRepository(\App\Models\Entities\Tag::class);
        if (!$_POST){
            return $this->prikaz($stranica, ['tagovi' => $allTags]);
        }
    }
    
    public function prikazUsluga($trazeniTag){             /* prosledi se ovde samo kompresovano*/
        $stranica = 'pretrazivanje';
    }

    public function istorija()
    {

        $uslugaOstvareneModel = new UslugaOstvarenaModel();

        $uslugaModel = new UslugaModel();
        $korisniciModel = new KorisnikModel();
        $rezervacijaModel = new RezervacijaModel();
        $zahtevModel = new ZahtevModel();
        $terminModel= new TerminModel();
        $idkor=6;
        $this->prikaz("istorija", ['uslugeOst' => $uslugaOstvareneModel, 'usluge' => $uslugaModel, 'korisnici' => $korisniciModel,
            'rezervacije' => $rezervacijaModel,'zahtevi'=>$zahtevModel,'idKor'=>$idkor,'termini'=>$terminModel]);


    }
public function aktivnaPopravka()
{
    $uslugaOstvareneModel = new UslugaOstvarenaModel();
    $uslugaModel = new UslugaModel();

    $uslugaModel = new UslugaModel();
    $korisniciModel = new KorisnikModel();
    $rezervacijaModel = new RezervacijaModel();
    $zahtevModel = new ZahtevModel();
    $terminModel= new TerminModel();
    $idkor=6;
    $this->prikaz("aktivnePopravke", ['uslugeOst' => $uslugaOstvareneModel, 'usluge' => $uslugaModel, 'korisnici' => $korisniciModel,
    'rezervacije' => $rezervacijaModel,'zahtevi'=>$zahtevModel,'idKor'=>$idkor,'termini'=>$terminModel]);
}
    public function sacuvajKomentar()
    {

        $id = (int)$this->request->getVar('hidden');

        $uslugaOstvareneModel = new UslugaOstvarenaModel();
        $data = [
            'komentar' => $this->request->getVar('komentar')
        ];
    
        $uslugaOstvareneModel->update($id, $data);
       
        return redirect()->to(site_url("Klijent/istorija"));
      
    }
    
    public function sacuvajOcenu()
    {
        $var = $this->request->getMethod();
        if ($var != 'post') {
            //potrebno popraviti da se salje error 500
            return "zahtev mora biti post";
        }
        $id = (int) $this->request->getVar('id');
        $ocena=(int) $this->request->getVar('ocena');
        $uslugaOstvareneModel = new UslugaOstvarenaModel();
        $data = [
            'ocena' =>$ocena
        ];
        
        $uslugaOstvareneModel->update($id, $data);
        return redirect()->to(site_url("Klijent/istorija"));
  
    }
    public function obrisiIstorija()
    {
        $var = $this->request->getMethod();
        if ($var != 'post') {
            //potrebno popraviti da se salje error 500
            return "zahtev mora biti post";
        }
        $id = (int) $this->request->getVar('id');
        $data = [
            'obrisano' =>1
        ];
        $uslugaOstvareneModel = new UslugaOstvarenaModel();
        $uslugaOstvareneModel->update($id, $data);
 
        return redirect()->to(site_url("Klijent/istorija"));
      

    }
}
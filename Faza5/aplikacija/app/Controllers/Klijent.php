<?php

namespace App\Controllers;

use App\Models\UslugaOstvarenaModel;
use App\Models\RezervacijaModel;
use App\Models\KorisnikModel;
use App\Models\UslugaModel;
use App\Models\ZahtevModel;
use App\Models\TerminModel;
use App\Models\Entities\Zahtev;
use App\Models\Kalendar;
use App\Models\KalendarModel;
use App\Models\Repositories\UslugaOstvarenaRepository;
use App\Models\Repositories\IstorijaRepository;
use CodeIgniter\Model;
use phpDocumentor\Reflection\Types\Array_;
use App\Models\Entities;


class Klijent extends BaseController
{

    /*public function index()
    {
        return view('welcome_message');
    }
*/

    protected function prikaz($stranica, $podaci)
    {
        $podaci['controller'] = 'Klijent';
        $podaci['korisnik'] = $this->session->get('Korisnik');
        $podaci['ime'] = $this->session->get('Korisnik')->ime;
        $podaci['prezime'] = $this->session->get('Korisnik')->prezime;
        $podaci['profilna'] = $this->session->get('Korisnik')->slika;
        echo view("osnova/header");
        echo view("osnova/meni", $podaci);
        echo view("klijent/$stranica", $podaci);
        echo view("osnova/footer");
    }
    
    public function pretrazivanje(){
        $stranica = 'pretrazivanje';
        $allTags = $this->doctrine->em->getRepository(\App\Models\Entities\Tag::class);
        if (!$_POST){
            return $this->prikaz($stranica, ['tagovi' => $allTags]);
        }
    }
    
    public function usluge()
    {
        $usluge = $this->doctrine->em->getRepository(\App\Models\Entities\Tag::class)->find(7)->getUsluge();       
        return $usluge;
    }
    
    public function izlogujSe(){
        $this->session->destroy();
        return redirect()->to(site_url("Gost/loginSubmit"));
    }
    
    public function prikazUsluga($trazeniTag){
        $tag = str_replace("_"," ",$trazeniTag);
        $ostvarene = $this->doctrine->em->getRepository(Entities\UslugaOstvarena::class)->findAll();
        $usluge = $this->doctrine->em->getRepository(\App\Models\Entities\Tag::class)->findOneBy(['opis'=>$tag])->getUsluge();
        $this->prikaz('prikazUsluga', ['usluge'=>$usluge, 'ostvarene'=>$ostvarene]);
    }

    public function dohvatiSlobodneTermine(){
        $majstori = $this->request->getVar('majstori');
        $nizMajstora = explode("_", $majstori);
        $slobodni = [];
        foreach ($nizMajstora as $idMaj){
            $slobodni = array_merge($slobodni, $this->doctrine->em->getRepository(\App\Models\Entities\Kalendar::class)->dohvatiSveSlobodneZaMajstora($idMaj));
        }
        $zaSlanje = [];
        foreach($slobodni as $s) {
            array_push($zaSlanje, [
                'idMaj'=>$s->getIdmaj(),
                'idKal'=> $s->getIdkal(),
                'idTer'=> $s->getIdTer()->getIdter(),
                'vreme'=>$s->getIdTer()->getDatumvreme()
            ]);
        }
        return json_encode($zaSlanje);
    }
    
    public function istorija()
    {
        // $ostvarene = $this->doctrine->em->getRepository(Entities\UslugaOstvarena::class)->where('obrisano'!=1);
        
        // $uslugaOstvareneModel = new UslugaOstvarenaModel();

        // $uslugaModel = new UslugaModel();
        // $korisniciModel = new KorisnikModel();
        // $zahtevModel = new ZahtevModel();
        // $terminModel= new TerminModel();
       
        //ovde treba ubaciti dohvatanje id-a korisnika iz sesije
        $idkor= $podaci['ime'] = $this->session->get('Korisnik')->idKor;

        $ostvarene=$this->doctrine->em->getRepository(Entities\UslugaOstvarena::class)->dohvatiUslugeKorisnika($idkor);
        // $ostvarene=$this->doctrine->em->getRepository(\App\Models\Repositories\IstorijaRepository::class)->dohvatiIstoriju($idkor);

        $this->prikaz("istorija",["ostvarene"=>$ostvarene]);
        // $this->prikaz("istorija", ['uslugeOst' => $uslugaOstvareneModel, 'usluge' => $uslugaModel, 'korisnici' => $korisniciModel,
        //     'rezervacije' => $rezervacijaModel,'zahtevi'=>$zahtevModel,'idKor'=>$idkor,'termini'=>$terminModel]);


    }
public function aktivnaPopravka()
{
    // $uslugaOstvareneModel = new UslugaOstvarenaModel();
    // $uslugaModel = new UslugaModel();

    // $uslugaModel = new UslugaModel();
    // $korisniciModel = new KorisnikModel();
    // $rezervacijaModel = new RezervacijaModel();
    // $zahtevModel = new ZahtevModel();
    // $terminModel= new TerminModel();
      //ovde treba ubaciti dohvatanje id-a korisnika iz sesije
    $idkor= $podaci['ime'] = $this->session->get('Korisnik')->idKor;
    $aktivne=$this->doctrine->em->getRepository(Entities\UslugaOstvarena::class)->dohvatiUslugeKorisnika($idkor);
    $this->prikaz("aktivnePopravke",["aktivne"=>$aktivne]);
//     $this->prikaz("aktivnePopravke", ['uslugeOst' => $uslugaOstvareneModel, 'usluge' => $uslugaModel, 'korisnici' => $korisniciModel,
//     'rezervacije' => $rezervacijaModel,'zahtevi'=>$zahtevModel,'idKor'=>$idkor,'termini'=>$terminModel]);
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
    public function vremeOdgovora($ostvarene)
    {
        $ukupno = 0;
        foreach ($ostvarene as $ostvarena) {
            $vremeOdgovora = $ostvarena->getIdrez()->getVremeodgovora()->format("Y-m-d H:i:s");
            $vremeSlanja = $ostvarena->getIdrez()->getIdRez()->getVremeslanja()->format("Y-m-d H:i:s");
            $razlika = strtotime($vremeOdgovora) - strtotime($vremeSlanja);

            $ukupno += $razlika;
        }
        return $ukupno / sizeof($ostvarene);
    }

    public function preporuke($ostvarene)
    {
        $sum = 0;
        foreach ($ostvarene as $ostvarena) {
            if ($ostvarena->getOcena() == "1") {
                $sum++;
            }
        }
        return number_format($sum / sizeof($ostvarene) * 100, 2);
    }

    public function prosecnaCena($usluge)
    {
        $ukupno = 0;
        foreach ($usluge as $usluga) {
            $ukupno += $usluga->getCena();
        }
        return $ukupno / sizeof($usluge);
    }

    public function prikazMajstora()
    {
        $id = $this->request->getVar('idMaj');
        //$id = 1;
        $majstor = $this->doctrine->em->getRepository(\App\Models\Entities\Korisnik::class)->findBy(['idkor' => $id])[0];
        $usluge = $this->doctrine->em->getRepository(\App\Models\Entities\Usluga::class)->findBy(['idmaj' => $id]);
        $ostvarene = $this->doctrine->em->getRepository(Entities\UslugaOstvarena::class)->dohvatiOstvareneUslugeMajstora($id);

        $vreme = $this->vremeOdgovora($ostvarene);
        $preporuke = $this->preporuke($ostvarene);
        $cena = $this->prosecnaCena($usluge);

        return $this->prikaz("detaljnijiPrikazMajstora", ['majstor' => $majstor, 'usluge' => $usluge, 'ostvarene' => $ostvarene,
            'vreme' => $vreme, 'preporuke' => $preporuke, 'cena' => $cena]);

    }
}
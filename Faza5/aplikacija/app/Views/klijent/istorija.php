<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POPRAVI.com</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>/css/stilOsnova.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/css/stilIstorija.css">
    <script src="<?php echo base_url(); ?>/js/skriptaIstorija.js"></script>

</head>





<body>
<div class="container-fluid">
<div class="sredina">
    <div id="zahtevi">
        <div class="row">
            <div id="zahtev" class="offset-0 col-12 offset-md-2 col-md-10">
                <?php
                $uslugeOstvarene = $uslugeOst->findall();

                foreach ($uslugeOstvarene as $uslugaOstvarena) {
                    $nadjenZahtev=null;
                   if ($uslugaOstvarena->obrisano==1) continue;
                    $zahtev=$zahtevi->find($uslugaOstvarena->idRez);
                  
                    if (!isset($zahtev)) continue;
                        if ($zahtev->idKor==$idKor){
                    $nadjenZahtev=$zahtev;
                    }
                    if ($nadjenZahtev==null) continue;
                    $termin=$termini->find($nadjenZahtev->idTer);
                    if (new DateTime() < new DateTime($termin->datumVreme)) continue;
                    $usluga = $usluge->find($uslugaOstvarena->idUsl);
                    $korisnik = $korisnici->find($usluga->idMaj);
             
                    
                    echo view_cell("\App\Libraries\UslugaIstorija::prikazUsluge", ['imeMajstor' => $korisnik->ime,'prezime'=>$korisnik->prezime, 'datumPopravke' => $termin->datumVreme
              ,'komentar' => $uslugaOstvarena->komentar, 'ocena' => $uslugaOstvarena->ocena, 'id' => $uslugaOstvarena->idUslOstv
                    ,'opis'=>$nadjenZahtev->opis]);
                }

                ?>
                <script>
                    pogasi();
                </script>

            </div>

        </div>
    </div>
</div>
</div>
</body>

</html>
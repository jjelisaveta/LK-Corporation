<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POPRAVI.com</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>/css/stilOsnova.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/css/stilAktivnePopravke.css">


</head>


<body>
<div class="container-fluid">
    <div class="row zahtevi">
        <?php
        $num = 4;
        $uslugeOstvarene = $uslugeOst->findall();

        foreach ($uslugeOstvarene as $uslugaOstvarena) {
            $nadjenZahtev = null;
            if ($uslugaOstvarena->obrisano == 1) continue;
            $zahtev = $zahtevi->find($uslugaOstvarena->idRez);

            if (!isset($zahtev)) continue;
            if ($zahtev->idKor == $idKor) {
                $nadjenZahtev = $zahtev;
            }
            if ($nadjenZahtev == null) continue;
            $termin = $termini->find($nadjenZahtev->idTer);
            if (new DateTime() < new DateTime($termin->datumVreme)) continue;

            $usluga = $usluge->find($uslugaOstvarena->idUsl);
            $korisnik = $korisnici->find($usluga->idMaj);

            echo view_cell("\App\Libraries\AktivnaPopravka::prikazUsluge",
                ['imeMajstor' => $korisnik->ime,'prezime'=>$korisnik->prezime, 'datumPopravke' => $termin->datumVreme, 'opis' => $nadjenZahtev->opis, 'num' => $num]);
            $num += 4;
            $num = $num % 8;
        }
        ?>
    </div>
</div>

</body>

</html>
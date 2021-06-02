<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POPRAVI.com</title>

    <link rel="stylesheet" href="<?php echo base_url(); ?>/css/stilZahtevi.css">
    <script src="<?php echo base_url(); ?>/js/skriptaZahtevi.js"></script>
</head>
<body>
<div class="container-fluid">
    <div id="sredina">
        <div id="zahtevi">
            <div class="row">
                <div id="zahtev" class="offset-0 col-12 offset-md-2 col-md-10">
                    <?php
                    foreach ($zahtevi as $zahtev) {
                        $ime = $zahtev->getIdkor()->getIme();
                        $prezime = $zahtev->getIdkor()->getPrezime();
                        $adresa = $zahtev->getIdkor()->getAdresa();
                        $opis = $zahtev->getOpis();
                        $id = $zahtev->getIdzah();
                        $slika=$zahtev->getIdkor()->getSlika();
                        $datumVreme = $zahtev->getIdter()->getDatumvreme()->format('Y-m-d H:i');
                        echo view_cell("\App\Libraries\OdobravanjeZahteva::prikazZahteva", ['ime' => $ime, 'prezime' => $prezime,
                            'adresa' => $adresa, 'opis' => $opis, 'id' => $id, 'datumVreme' => $datumVreme,'slika'=>$slika]);
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
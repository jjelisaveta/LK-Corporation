

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.6.0/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>/css/stilOsnova.css">
<script src="<?php echo base_url(); ?>/js/skriptaOsnova.js"></script>
    
<div class="container-fluid">
        <div id="meniMali" class="d-block d-md-none overlay">
            <a href="javascript:void(0)" class="dugmeZatvori" onclick="zatvoriMeni()">&times;</a>
            <div class="maliMeniSadrzaj">
                <a href="pretrazivanje.html">Rezerviši termin</a>
                    <a href="aktivnapopravka.html">U toku</a>
                    <a href="istorija.html">Istorija</a>
                    <a href="<?php echo site_url("Majstor/zahtevi") ?>">Zahtevi</a>
                    <a href="<?php echo site_url("Majstor/kalendar") ?>">Kalendar</a>
                    <a href="<?php echo site_url("Majstor/mojeUsluge") ?>">Moje usluge</a>
                    <a href="<?php echo site_url("Majstor/dodajUslugu") ?>">Dodaj uslugu</a>
                <div class="padajuciMeni">
                    <button class="padajuceDugme">Moj nalog</button>
                    <div class="padajuciSadrzaj">
                    <a href="<?php echo site_url("Gost/promeniPodatke") ?>">Promeni podatke</a>
                    <a href="<?php echo site_url("Gost/izlogujSe") ?>"> Izloguj se </a>
                    </div>
                </div>
            </div>
            <div id="korisnik">
                <img src="<?php echo base_url() . "/" . $profilna; ?>" alt="korisnicka slika">
                <a href="pretrazivanje.html"><?=$ime ?> <?=$prezime ?></a>
            </div>
        </div>
        
        <div id="meni" class="d-none d-md-block col-md-2">
            <a href="pretrazivanje.html">Rezerviši termin</a>
                    <a href="aktivnapopravka.html">U toku</a>
                    <a href="istorija.html">Istorija</a>
                    <a href="<?php echo site_url("Majstor/zahtevi") ?>">Zahtevi</a>
                    <a href="<?php echo site_url("Majstor/kalendar") ?>">Kalendar</a>
                    <a href="<?php echo site_url("Majstor/mojeUsluge") ?>">Moje usluge</a>
                    <a href="<?php echo site_url("Majstor/dodajUslugu") ?>">Dodaj uslugu</a>
            <div class="padajuciMeni">
                <button class="padajuceDugme">Moj nalog</button>
                <div class="padajuciSadrzaj">
                    <a href="<?php echo site_url("Gost/promeniPodatke") ?>">Promeni podatke</a>
                    <a href="<?php echo site_url("Gost/izlogujSe") ?>"> Izloguj se </a>
                </div>
            </div>
                <div id="korisnik">
                <img src="<?php echo base_url() . "/" . $profilna; ?>" alt="korisnicka slika">
                <a href="pretrazivanje.html"><?=$ime ?> <?=$prezime ?></a>
            </div>
        </div>
        

        </div>
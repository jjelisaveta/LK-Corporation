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
            <a href="#">Pregled Korisnika</a>
            <a href="#">Zahtevi Majstora</a>
            
            <div class="padajuciMeni">
                <button class="padajuceDugme">Moj nalog</button>
                <div class="padajuciSadrzaj">
                    <a href="logovanje.html">Uloguj se</a>

                </div>
            </div>
        </div>
        <div id="korisnik">
            <img src="<?php echo base_url(); ?>/slike/Kalu.jpg" alt="korisnicka slika">
            <a href="pretrazivanje.html">Kalu</a>
        </div>
    </div>

    <div id="meni" class="d-none d-md-block col-md-2">
           <a href="#">Pregled Korisnika</a>
            <a href="#">Zahtevi Majstora</a>
        <div class="padajuciMeni">
            <button class="padajuceDugme">Moj nalog</button>
            <div class="padajuciSadrzaj">
                <a href="logovanje.html">Uloguj se</a>
           
            </div>
        </div>
        <div id="korisnik">
            <img src="<?php echo base_url(); ?>/slike/Kalu.jpg" alt="korisnicka slika">
            <a href="pretrazivanje.html"><?= $ime ?> <?= $prezime ?></a>
        </div>
    </div>

</div>
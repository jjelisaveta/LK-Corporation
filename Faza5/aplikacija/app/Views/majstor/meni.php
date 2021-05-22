
<div class="container-fluid">
        <div id="meniMali" class="d-block d-md-none overlay">
            <a href="javascript:void(0)" class="dugmeZatvori" onclick="zatvoriMeni()">&times;</a>
            <div class="maliMeniSadrzaj">
                <a href="pretrazivanje.html">Rezerviši termin</a>
                    <a href="aktivnapopravka.html">U toku</a>
                    <a href="istorija.html">Istorija</a>
                    <a href="zahtevi.html">Zahtevi</a>
                    <a href="kalendar.html">Kalendar</a>
                    <a href="mojeUsluge.html">Moje usluge</a>
                    <a href="dodavanjeusluga.html">Dodaj uslugu</a>
                <div class="padajuciMeni">
                    <button class="padajuceDugme">Moj nalog</button>
                    <div class="padajuciSadrzaj">
                        <a href="logovanje.html">Uloguj se</a>
                        <a href="registrovanje.html">Registruj se</a>
                    </div>
                </div>
            </div>
            <div id="korisnik">
                <img src="<?php echo base_url(); ?>/slike/Kalu.jpg" alt="korisnicka slika">
                <a href="pretrazivanje.html">Kalu</a>
            </div>
        </div>
        
        <div id="meni" class="d-none d-md-block col-md-2">
            <a href="pretrazivanje.html">Rezerviši termin</a>
                    <a href="aktivnapopravka.html">U toku</a>
                    <a href="istorija.html">Istorija</a>
                    <a href="zahtevi.html">Zahtevi</a>
                    <a href="kalendar.html">Kalendar</a>
                    <a href="mojeUsluge.html">Moje usluge</a>
                    <a href="dodavanjeusluga.html">Dodaj uslugu</a>
            <div class="padajuciMeni">
                <button class="padajuceDugme">Moj nalog</button>
                <div class="padajuciSadrzaj">
                    <a href="logovanje.html">Uloguj se</a>
                    <a href="registrovanje.html">Registruj se</a>
                </div>
            </div>
                <div id="korisnik">
                <img src="<?php echo base_url(); ?>/slike/Kalu.jpg" alt="korisnicka slika">
                <a href="pretrazivanje.html"><?=$ime ?> <?=$prezime ?></a>
            </div>
        </div>
        
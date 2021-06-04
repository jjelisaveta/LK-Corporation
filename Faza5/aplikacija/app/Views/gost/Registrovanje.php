<!--Stefan Pajovic 2018/0287-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>POPRAVI.com</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>/css/stilLogovanjeRegistrovanje.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/css/stilOsnova.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div id="content" class="col-12 abx">
                <form name="loginform" action="<?= site_url("Gost/registrujSe") ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <input class="offset-2 col-4 offset-md-4 col-md-2 okvir" type="text" name="ime" id="ImeId" value="<?= set_value('ime')?>"  placeholder="Ime">
                        <input class="col-4 col-md-2 okvir" type="text" name="prezime" id="prezimeId" value="<?= set_value('prezime')?>" placeholder="Prezime">
                    </div>
                    <font color='red'>
                    <?php
                        if(isset($LoseImePrezime))
                            echo $LoseImePrezime;
                    ?>
                    </font>
                    <div class="row">
                         <input class="offset-2 col-8 offset-md-4 col-md-4 okvir" type="tel" name="telefon" id="telefonId" value="<?= set_value('telefon')?>" placeholder="Broj telefona">
                    </div>
                    <font color='red'>
                    <?php
                        if(isset($LoseTelefon))
                            echo $LoseTelefon;
                    ?>
                    </font>
                    <div class="row">
                         <input class="offset-2 col-8 offset-md-4 col-md-4 okvir" type="text" name="adresa" id="adresaId"  value="<?= set_value('adresa')?>" placeholder="Adresa" >
                    </div>  
                    <font color='red'>
                    <?php
                        if(isset($LosaAdresa))
                            echo $LosaAdresa;
                    ?>
                    </font>
                    <div class="row">
                         <input class="offset-2 col-8 offset-md-4 col-md-4 okvir" type="text" name="email" id="emailid2" value="<?= set_value('email')?>" placeholder="E-adresa">
                    </div>
                    <font color='red'>
                    <?php
                        if(isset($LoseEmail))
                            echo $LoseEmail;
                    ?>
                    </font>
                    <div class="row">
                         <input class="offset-2 col-8 offset-md-4 col-md-4 okvir" type="password" name="lozinka" id="idpass" value="<?= set_value('password')?>" placeholder="Lozinka">
                    </div>
                    <font color='red'>
                    <?php
                        if(isset($LosaLozinka))
                            echo $LosaLozinka;
                    ?>
                    </font>
                    <div class="row">
                        <div class="offset-2 col-4 offset-md-4 col-md-2">
                            <label for="radioMajstor">Majstor</label>
                            <input type="radio" name="uloga" id="radioMajstor" value='Majstor'>
                        </div>
                        <div class="col-4 col-md-2">
                            <label for="radioKorisnik">Korisnik</label>
                            <input type="radio" name="uloga" id="radioKorisnik" value='Korisnik' checked>
                        </div>
                    </div>
                    <div class="row">
                        <div class="offset-2 col-8 offset-md-4 col-md-4" style="text-align: center">
                            <input type="file" class="custom-file-input okvir" name="izaberiSliku" id="izaberiSliku">
                            <label class="custom-file-label okvir" for="izaberiSliku" id="izaberiSliku" >Učitajte profilnu sliku</label>  
                        </div> 
                    </div> 
                    <font color='red'>
                    <?php
                        if(isset($GreskaSlika))
                            echo $GreskaSlika;
                    ?>
                    </font>
                    <div class="row">
                        <input class="offset-2 col-8 offset-md-4 col-md-4 dugmic" type="submit" value="Registruj se" id="idDugmeR">
                    </div>
                    <div class="row">
                        <div class="offset-2 col-8 offset-md-4 col-md-4">
                            <a href="<?php echo site_url("Gost/loginSubmit") ?>" ><p id="p1" >Već imate nalog? Prijavite se.</p></a> 
                            <a href="<?php echo site_url("Klijent/pretrazivanje") ?>"><p id="p2">Nastavite kao gost.</p></a> 
                        </div>
                    </div>  
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>
<!--Jovan Pavlovic 2018/0012-->
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
            <div id="content" class="offset-2 col-10 abx">
                <form name="loginform" action="<?= site_url("Gost/promeniPodatke") ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                         <input class="offset-xs-2 col-xs-12 offset-md-4 col-md-4 okvir" type="tel" name="telefon" id="telefonId" value="<?= set_value('telefon')?>" placeholder="Broj telefona">
                    </div>
                    
                    <font color='red'>
                    <?php
                        if(isset($LoseTelefon))
                            echo $LoseTelefon;
                    ?>
                    </font>
                    
                    <div class="row">
                         <input class="offset-xs-2 col-xs-12 offset-md-4 col-md-4 okvir" type="text" name="adresa" id="adresaId"  value="<?= set_value('adresa')?>" placeholder="Adresa" >
                    </div>  
                    <div class="row">
                         <input class="offset-xs-2 col-xs-12 offset-md-4 col-md-4 okvir" type="password" name="StaraLozinka" id="idpass" value="<?= set_value('password')?>" placeholder="Stara lozinka">
                    </div>
                    
                    <font color='red'>
                    <?php
                        if(isset($LosePonovljenaLozinka))
                            echo $LosePonovljenaLozinka;
                    ?>
                    </font>
                    
                    <div class="row">
                         <input class="offset-xs-2 col-xs-12 offset-md-4 col-md-4 okvir" type="password" name="lozinka" id="idpass" value="<?= set_value('password')?>" placeholder="Lozinka">
                    </div>

                    <font color='red'>
                    <?php
                        if(isset($LoseLozinka))
                            echo $LoseLozinka;
                    ?>
                    </font>
                    
                    <div class="row">
                        <div class="offset-xs-2 col-xs-12 offset-md-4 col-md-4" style="text-align: center">
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
                        <input class="offset-2 col-8 offset-md-4 col-md-4 dugmic" type="submit" value="Promeni podatke" id="idDugmeR">
                    </div>
                    
                    <font color='green'>
                    <?php
                        if(isset($Ok))
                            echo $Ok;
                    ?>
                    </font>
                    
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>
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
        <div id="content" class="col-12">
            <form name="loginform" action="<?= site_url("Gost/loginSubmit") ?>" method="post">
                <div class="row">
                    <h3 class="offset-2 col-8 offset-md-3 col-md-6">Dobrodošli!</h3>
                </div>
                <div class="row">
                <input class="offset-2 col-8 offset-md-4 col-md-4 okvir" type="text" name="email" id="emailid" value="<?= set_value('email')?>"
                            placeholder="Mejl adresa">
                </div>
                <font color='red'>
                    <?php
                        if(isset($LosaAdresa))
                            echo $LosaAdresa;
                    ?>
                </font>
                <div class="row">
                    <input class="offset-2 col-8 offset-md-4 col-md-4 okvir" type="password" name="lozinka" id="idpass" value="<?= set_value('password')?>"
                        placeholder="Lozinka">
                </div>
                <font color='red'>
                    <?php
                        if(isset($LosaLozinka))
                            echo $LosaLozinka;
                    ?>
                </font>
                <div class="row">
                    <input class="offset-2 col-8 offset-md-4 col-md-4 dugmic" type="submit" value="Prijavi se" id="idDugme">
                </div>
                <div class="row">
                    <div class="offset-2 col-8 offset-md-4 col-md-4">
                        <a href="<?php echo site_url("Gost/registrujSe") ?>"><p id="p1" >Nemate nalog? Registrujte se.</p></a> 
                        <a href="../pretrazivanje"><p id="p2">Nastavite kao gost.</p></a>
                    </div>
                </div>  
            </form>
        </div>
        </div>
        </div>
</body>
</html>
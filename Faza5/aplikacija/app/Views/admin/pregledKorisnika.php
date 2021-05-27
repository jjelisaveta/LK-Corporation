<!--Jelisaveta Jevtic 2018/0127-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POPRAVI.com</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>/css/stilKlijenti.css">
</head>

<body>
<div class="container-fluid">
<div id="con">
        <div id="sredina">
        <div class="row">
            <div class="offset-0 col-12 offset-md-2 col-md-10">
            <?php
                foreach ($korisnici as $korisnik) {
                    
                    echo view_cell("\App\Libraries\KorisnikPregled::prikazUsluge",['ime'=>$korisnik->ime]);
                }

                ?>
                </div>
                </div>
        </div>
    </div>
    </div>
 
     
</body>

</html>
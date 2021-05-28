<!--Jelisaveta Jevtic 2018/0127-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POPRAVI.com</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>/css/stilMajstori.css">
    <script src="<?php echo base_url(); ?>/js/skriptaPregledMajstora.js"></script>
</head>

<body>
<div class="container-fluid">
<div id="con">
        <div id="sredina">
        <div class="row">
          
            <?php
              $num = 3;
                foreach ($korisnici as $korisnik) {
                    
                    echo view_cell("\App\Libraries\MajstorPregled::prikazUsluge",['ime'=>$korisnik->ime,'prezime'=>$korisnik->prezime,
                    'email'=>$korisnik->email,'id'=>$korisnik->idKor,'num'=>$num]);
                    $num += 3;
                    $num = $num % 6;
                }

                ?>
               
                </div>
        </div>
    </div>
    </div>
 
     
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POPRAVI.com</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>/css/stilMajstori2.css">
    <script src="<?php echo base_url(); ?>/js/skriptaPregledMajstora.js"></script>
</head>

<body>
<div class="container-fluid">
    <div id="con">
  

        <div class="row">
          
            <?php
              $num = 3;
                foreach ($majstori as $majstor) {
                  
                        $ukupno = 0;
                        $pozitivna = 0;
                    
                        foreach($ostvarene as $ostvarena){
                            $idP=$ostvarena->getIdusl()->getIdmaj()->getIdkor();
                            if ($idP!=$majstor->getIdkor()) continue;
                                $ukupno++;
                               
                                if ($ostvarena->getOcena()!=null && $ostvarena->getOcena()=="1")
                                    $pozitivna++;
                        }
                        if ($ukupno!=0) {
                            $procenat = $pozitivna/$ukupno * 100;
      
                        }
                        else $procenat =0;
            
                    echo view_cell("\App\Libraries\MajstorPregled::prikazUsluge",['ime'=>$majstor->getIme(),'prezime'=>$majstor->getPrezime(),
                    'email'=>$majstor->getEmail(),'id'=>$majstor->getidKor(),'num'=>$num,'procenat'=>$procenat, 'slika' => $majstor->getSlika()]);
                    
                    $num += 3;
                    $num = $num % 6;
                }
                ?>
            </div>
        </div>
    
</div>
</body>
</html>
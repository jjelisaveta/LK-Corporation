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

<body onload="ini()">
<div class="container-fluid">
    <div id="con">
  

        <div class="row">
           <span class="offset-0 col-12 offset-md-2 col-md-10 text-center  nemaRezultata" hidden>Odobreni majstori ne postoje</span>
            <?php
              $num = 3;
                foreach ($majstori as $majstor) {
                  
                        $ukupno = 0;
                        $pozitivna = 0;
                    
                        foreach($ostvarene as $ostvarena){
                            $idP=$ostvarena->getIdusl()->getIdmaj()->getIdkor();
                            if ($idP!=$majstor->getIdkor()) continue;
                            if ($ostvarena->getOcena()==null) continue;
                            $datum=$ostvarena->getIdrez()->getIdrez()->getIdter()->getDatumvreme()->format("Y-m-d H:i:s");;
                            if (new DateTime() < new DateTime($datum)) continue;
                                $ukupno++;
                               
                                if ( $ostvarena->getOcena()=="1")
                                    $pozitivna++;
                        }
                        if ($ukupno!=0) {
                            $procenat = $pozitivna/$ukupno * 100;
                            
                        }
                        else $procenat =0;
            
                    echo view_cell("\App\Libraries\MajstorPregled::pregledMajstora",['ime'=>$majstor->getIme(),'prezime'=>$majstor->getPrezime(),
                    'email'=>$majstor->getEmail(),'id'=>$majstor->getidKor(),'num'=>$num,'procenat'=>$procenat, 'slika' => $majstor->getSlika(),'ukupno'=>$ukupno]);
                    
                    $num += 3;
                    $num = $num % 6;
                }
                ?>
            </div>
        </div>
    
</div>
</body>
</html>
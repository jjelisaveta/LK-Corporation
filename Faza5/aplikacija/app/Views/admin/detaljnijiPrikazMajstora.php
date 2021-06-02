
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POPRAVI.com</title>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.6.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="<?php echo base_url(); ?>/css/stilDetaljnijiPrikazM.css">
    <script src="<?php echo base_url(); ?>/js/skriptaDetaljnijiPrikazM.js"> </script>
  
</head>
<body>
    
    <div class="container-fluid">
        <div class="row">
            <div class="prikazMajstora offset-0 col-12 offset-md-2 col-md-10">
                <div class="row">
                    <div id="info" class="offset-1 col-10">
                        <table>
                            <tr>
                                <td class="slikaMajstora"><img src="<?php echo base_url(); ?>/slike/covek1.webp"></td>
                                <td class="podaci">
                                    <h1>
                                        <?= $majstor->getIme()?> <?= $majstor->getPrezime() ?>
                                    </h1>
                                    <p>
                                        <b>telefon: </b><?= $majstor->getBrojtelefona()?><br>
                                        <b>mejl: </b><?= $majstor->getEmail()?><br>
                                    </p>
                                </td>
                                <td class="ocene" style="border-left: solid; width:33%">
                                    <h3>
                                        Majstora preporučuje: <b><?= $preporuke ?>%</b> <br> 
                                        Prosečno vreme odgovora: <b><?= gmdate("H:i:s", $vreme) ?></b> <br> 
                                        Prosečna cena svih usluga: <b><?= $cena ?></b>
                                    </h3>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="offset-1 col-10 text-center" style="margin-top:20px; margin-bottom:10px;">
                        <h4>Komentari korisnika</h4>
                    </div>
                </div>
                
                <div class="row">
                    <div class="komentarii offset-1 col-10">
                        <?php 
                            foreach ($ostvarene as $ostvarena){
                                if ($ostvarena->getKomentar()!="" && $ostvarena->getKomentar()!=null){
                                echo view_cell("\App\Libraries\KomentarPrikazMajstoraLibBrisanje::prikazKomentara", ['komentar' => $ostvarena->getKomentar(), 
                                'korisnik'=>$ostvarena->getIdrez()->getIdRez()->getIdkor(), 
                                    'idOstvUsl'=>$ostvarena->getIduslostv()]);
                                }
                            }
                        ?>
                    </div>
                </div>

                <div class="row">
                    <div class="offset-1 col-10 text-center" style="margin-top:20px; margin-bottom:10px;">
                        <h4>Usluge koje majstor nudi</h4>
                    </div>
                </div>

                <div class="row sveUsluge">
                    <?php 
                        foreach ($usluge as $usluga) {
                            $ukupno = 0;
                            $pozitivna = 0;
                            foreach($ostvarene as $ostvarena){
                                if ($ostvarena->getIdusl()->getIdusl() == $usluga->getIdusl() && $ostvarena->getOcena()!=null) {
                                    $ukupno++;
                                    if ($ostvarena->getOcena()=="1")
                                        $pozitivna++;
                                }
                            }
                            if ($ukupno!=0) {
                                $prep = $pozitivna/$ukupno * 100;
                                $prep = number_format($prep, 2);
                                $prep = "" . $prep ."%";
                            }
                            else $prep = " - ";
                            echo view_cell("\App\Libraries\UslugaPrikazMajstora::prikazUsluge", ['naslov' => $usluga->getNaziv(), 
                            'opis' => $usluga->getOpis(), 'id' => $usluga->getIdusl(),
                            'tagovi'=>$usluga->getTagovi(), 'cenaUsluge'=>$usluga->getCena(), 'prep'=>$prep]);
                        }
                    ?>
                    
                </div>
        </div>
    </div>
        

  
</body>
</html>
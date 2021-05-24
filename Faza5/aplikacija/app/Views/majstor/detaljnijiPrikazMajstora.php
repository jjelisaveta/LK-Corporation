<!--Jovan Pavlovic 2018/0012-->
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
</head>
<body>
    
    <div class="container-fluid">
        <div class="row">
            <div class="prikazMajstora offset-0 col-12 offset-md-2 col-md-10">
                <div class="row">
                    <div id="info" class="offset-1 col-10">
                        <table>
                            <tr>
                                <td class="slikaMajstora"><img src="slike/covek1.webp"></td>
                                <td class="podaci">
                                    <h1>
                                        <?= $majstor->getIme()?> <?= $majstor->getPrezime()?>
                                    </h1>
                                    <p>
                                        <b>telefon: </b><?= $majstor->getBrojtelefona()?><br>
                                        <b>mejl: </b><?= $majstor->getEmail()?><br>
                                    </p>
                                </td>
                                <td class="ocene" style="border-left: solid; width:33%">
                                    <h3>
                                        Majstora preporucuje: <b>66%</b> <br> 
                                        Prosecno vreme reakcije: <b>03:40</b> <br> 
                                        Prosecan cena svih usluga: <b>4500</b>
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
                            foreach ($ostvrene as $ostvarena){
                                echo view_cell("\App\Libraries\KomentarPrikazMajstoraLib::prikazKomentara", ['komentar' => $ostvarena->getKomentar(), 
                                'korisnik'=>$ostvarena->getIdrez()->getZahtev->getIdkor()]);
                            }
                        ?>
                    </div>
                </div>

                <div class="row">
                    <div class="offset-1 col-10 text-center" style="margin-top:20px; margin-bottom:10px;">
                        <h4>Usluge koje majstor nudi</h4>
                    </div>
                </div>

                <div class="row">
                    <?php 
                        foreach ($usluge as $usluga){
                            echo view_cell("\App\Libraries\MojaUslugaMajstor::prikazUsluge", ['naslov' => $usluga->getNaziv(), 
                            'opis' => $usluga->getOpis(), 'id' => $usluga->getIdusl(),
                            'tagovi'=>$usluga->getTagovi()]);
                        }
                    ?>
                    
                </div>
        </div>
    </div>
  
</body>
</html>
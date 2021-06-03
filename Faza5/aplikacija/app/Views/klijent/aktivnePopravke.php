<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POPRAVI.com</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>/css/stilOsnova.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/css/stilAktivnePopravke.css">


</head>


<body>
<div class="container-fluid">
    <div class="row zahtevi">
        <?php
        $num = 4;
  
        foreach ($aktivne as $aktivna){
            $ime= $aktivna->getIdrez()->getIdmaj()->getIme();
            $prezime= $aktivna->getIdrez()->getIdmaj()->getPrezime();
            $slika=$aktivna->getIdrez()->getIdmaj()->getSlika();
            $datum=$aktivna->getIdrez()->getIdrez()->getIdter()->getDatumvreme()->format("Y-m-d H:i:s");;
            if (new DateTime() > new DateTime($datum)) continue;
             $id=$aktivna->getIduslostv();
             $opis=$aktivna->getIdrez()->getIdrez()->getOpis();
             echo view_cell("\App\Libraries\AktivnaPopravka::aktivnePopravke",
                ['imeMajstor' => $ime,'prezime'=>$prezime, 'datumPopravke' => $datum, 'opis' => $opis, 'num' => $num,'slika'=>$slika]);

            $num += 4;
            $num = $num % 8;
        }
        ?>
    </div>
</div>

</body>

</html>
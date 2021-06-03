<!--Luka Stojanovic 2018/0053-->
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kalendar</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.6.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <title>POPRAVI.com</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>/css/stilOsnova.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/css/stilDodavanjeUsluge.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/css/stilKalendar.css">
    <script src="<?php echo base_url(); ?>/js/skriptaOsnova.js"></script>
    <script src="<?php echo base_url(); ?>/js/skriptaKalendar.js"></script>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div id="kalendar" class="offset-sm-0 col-12 col-md-10 offset-md-2 text-center">
            <div id="termini">
                <?php
                if (!isset($date)) {
                    $date = "GRESKA";
                }
                if (isset($termini)) {
                    $i = 0;
                    foreach ($termini as $key) {
                        echo view_cell("\App\Libraries\KalendarTermin::prikaz",
                            ['terminText' => $key['vreme'], 'id' => $key['id'], 'class' => $key['class']]);
                        $i++;
                        if ($i == 3) {
                            $i = 0;
                            echo "<br>";
                        }
                    }
                }
                ?>
            </div>
            <div id="donji_deo" class="">
                <form id="datum">
                    <input type="date" id="datuminput" onchange="promenaKalendar(this)"
                           min=<?php echo $date ?>
                           max=<?php echo date('Y-m-d', strtotime($date . ' + 30 days')) ?>
                           value=<?php echo $date ?>>
                </form>
            </div>
        </div>
    </div>
    <?php
    if (isset($radi))
        foreach ($radi as $ter) {
            echo "<script>updateTermin('$ter');</script>";
        }
    if (isset($rezervisan))
        foreach ($rezervisan as $ter) {
            echo "<script>rezervisi('$ter[0]','$ter[1]');</script>";
        }
    ?>
</div>
</body>
</html>



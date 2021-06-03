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


    <link rel="stylesheet" href="<?php echo base_url(); ?>/css/stilOsnova.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/css/stilOdobravanjeMajstora.css">
    <script src="<?php echo base_url(); ?>/js/skriptaOdobravanjeMajstora.js"></script>

</head>
<body>
<?php
if (!isset($majstori))
    $majstori = [];
?>
<div class="container-fluid">
    <div id="zahtevi">
        <div class="row">
            <div id="zahtev" class="offset-0 col-12 offset-md-2 col-md-10">
                <?php
                foreach ($majstori as $majstor) {
                    echo view_cell("\App\Libraries\OdobravanjeMajstora:odobravanjeMajstora",
                        ['ime' => $majstor->getIme(), 'prezime' => $majstor->getPrezime(),
                         'email' => $majstor->getEmail(), 'broj' => $majstor->getBrojtelefona(), 'slika' => $majstor->getSlika(), 'id' => $majstor->getIdkor()]);
                }
                ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>
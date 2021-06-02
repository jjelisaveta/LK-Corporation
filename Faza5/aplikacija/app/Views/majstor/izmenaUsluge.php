<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.6.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <title>POPRAVI.com</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>/css/stilOsnova.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/css/stilDodavanjeUsluge.css">

    <script src="<?php echo base_url(); ?>/js/skriptaOsnova.js"></script>
    <script src="<?php echo base_url(); ?>/js/skriptaIzmenaUsluge.js"></script>
</head>

<body>
<?php
if (!isset($naslov))
    $naslov = "GRESKAAA";
if (!isset($opis))
    $opis = "GRESKAAA";
if (!isset($cena))
    $cena = "GRESKAAA";
if (!isset($id))
    $id = "GRESKAAA";
?>
<div class="container-fluid">
    <div class="row">
        <div id="sadrzaj" class="offset-0 col-12 offset-md-2 col-md-10">
            <form id="content" action="../izmenaUsluge" method="POST">
                <div class="row">
                    <div class="offset-2 col-8 offset-md-4 col-md-4 offset-2 greska text-center">
                        <?php
                        if (isset($naslovGreska))
                            echo $naslovGreska
                        ?>
                    </div>
                    <input class="offset-2 col-8 offset-md-4 col-md-4" type="text" name="naslov" id="naslovId"
                           value="<?php echo $naslov; ?>">
                </div>
                <div class="row">
                    <div class="offset-2 col-8 offset-md-4 col-md-4 offset-2 greska text-center">
                        <?php
                        if (isset($opisGreska))
                            echo $opisGreska;
                        ?>
                    </div>
                    <textarea class="offset-2 col-8 offset-md-4 col-md-4 offset-2" name="opis" id="opisId" cols="40"
                              rows="8" draggable="false"><?php echo $opis; ?></textarea>
                </div>

                <div class="row red text-center">
                    <div class="offset-2 col-8 offset-md-4 col-md-4 offset-md-4 offset-2">
                        <div class="col-5 greska text-center">
                            <?php
                            if (isset($cenaGreska))
                                echo $cenaGreska;
                            ?>
                        </div>
                        <input class="col-5" type="number" step="100" name="cena" id="cenaId" value="<?php echo $cena; ?>">
                        <select class="col-5" name="t" id="selectId">
                            <option value="default">--Izaberi--</option>
                            <?php if (isset($sviTagovi))
                                foreach ($sviTagovi as $tag) { ?>
                                    <option value="<?php echo $tag->opis ?>"><?php echo $tag->opis ?></option>
                                <?php } ?>
                        </select>
                        <input type="hidden" id="izabraniTagovi" name="izabraniTagovi">
                        <input type="hidden" id="idUsluge" name="id" value="<?php echo $id ?>">
                        <button id="plus" type="button" class="col-1 plus">+</button>
                    </div>
                </div>

                <div class="row">
                    <div class="offset-2 col-8 offset-md-4 col-md-4 offset-md-4 offset-2">
                        <div name="tagovi" id="tagovi">
                            <?php
                            if (isset($tagovi))
                                foreach ($tagovi as $tag)
                                    echo view_cell('\App\Libraries\Tag::prikazTag', ['opis' => $tag->getOpis()]);
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="offset-2 col-8 offset-md-4 col-md-4 text-center offset-2">
                        <a href="#">
                            <button id="idDugmeR" class="col-11" type="submit"> Izmeni</button>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
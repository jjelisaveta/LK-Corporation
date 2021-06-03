<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.6.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url(); ?>/css/stilOsnova.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/css/stilPretrazivanje.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body>
        <?php
            if(isset($tagovi)){
                $prosledi = []; 
                $nizTagova = $tagovi->findall();
                foreach ($nizTagova as $tg) {
                        array_push($prosledi, $tg->getOpis());          //mogu proveriti da li se pushuju iste ili razlicite
                }
            }
        ?>
    <div class="container-fluid">
        <div class="row">
            <div id="sadrzaj" class="col-12 offset-md-2 col-md-10 wrapper">
                <h3>Imate kvar? Mi imamo majstora!</h3>
                <div class="search-input">
                    <a href="" target="_blank" hidden></a>
                    <input id = "poljePretraga" type="text" placeholder="Unesite pojam za pretragu..">
                </div>
            </div>
        </div>
        <div class="row">
            <div id="tagovi" class="col-12 offset-md-2 col-md-10 d-flex justify-content-center">
               
            </div>
        </div>
    </div>
    <script type="text/javascript">var jArray =<?php echo json_encode($prosledi); ?>;
    </script>
    <script src="<?php echo base_url(); ?>/js/skriptaSugestije.js"></script>
    <script src="<?php echo base_url(); ?>/js/suggestions.js"></script>
</body>
</html>
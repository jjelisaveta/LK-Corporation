<!--Jovan Pavlovic 2018/0012-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>POPRAVI.com</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>/css/neodobren.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/css/stilOsnova.css">
</head>
<body>
    <div class="container-fluid">
    
        <div class = "row">
            <div id="content" class="offset-2 col-8 offset-md-3 col-md-6">
                <p class="tekst">Uspesno ste popunili prijavu. Administrator ce validirati vasu prijavu
                u najkracem roku</p>
            </div>
        </div>
        <div class="row">
            <div class="offset-2 col-8 offset-md-4 col-md-4 linkovi">
                <a href="<?php echo site_url("Gost/loginSubmit") ?>"><p id="p1" >Prijavite se sa drugim nalogom.</p></a> 
                <a href="pretrazivanje.html"><p id="p2">Nastavite kao gost.</p></a> 
            </div>
        </div>  
    </div>
</body>
</html>
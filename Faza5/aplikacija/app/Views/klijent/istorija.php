
Luka Stojanovic 2018/0053
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POPRAVI.com</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>/css/stilOsnova.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/css/stilIstorija.css">
</head>


<script>
    function onTestChange(area) {
        var key = window.event.keyCode;
        // If the user has pressed enter
        if (key === 13) {
            area.readOnly = "false";
        }
    }
    function myFunction(objButton) {
        var label = objButton.parentNode.parentNode.getElementsByClassName("ocenaLabel")[0];
        var da =  objButton.parentNode.parentNode.getElementsByClassName("ocenaDugme")[0];
        var ne =  objButton.parentNode.parentNode.getElementsByClassName("ocenaDugme")[1];
        label.innerHTML = objButton.innerHTML;
        da.parentNode.removeChild(da);
        ne.parentNode.removeChild(ne);
        if (label.innerHTML=="+"){
            label.style.color="green"
        }else{
            label.style.color="red"
        }
        console.log("proslo")
    }
</script>

<script>
    function deleteTextArea(button) {
        var element = button.parentNode.parentNode.getElementsByClassName("komentarinput")[0];
        var label = button.parentNode.parentNode.getElementsByClassName("komentarLabel")[0];
        label.innerHTML = element.value;
        element.parentNode.removeChild(element);
        button.parentNode.removeChild(button);
    }
    function ukloniPopravku(button) {
        var zahtev = button.parentNode.parentNode.parentNode.parentNode.parentNode;
        zahtev.parentNode.removeChild(zahtev);
        console.log(zahtev);
    }
</script>

<body>
   <div class="container-fluid">
       <div class="sredina">

       <div class="zahtevi">
       <div class="row">
        <div id="usluga" class="offset-0 col-12 offset-md-2 col-md-10">
            <?php 
                foreach($uslugeOstvarene as $uslugaOstvarena) {
                    $uslugaModel = new UslugaModel();
                    $usluge = $uslugaModel->find($uslugaOstvarena->idUsl);
                    
                    echo view_cell("\App\Libraries\UslugaIstorija::prikazUsluge",['imeMajstor'=>$usluga->naziv,'opis'=> $usluga->opis]);
                }
            ?>
        </div>
    </div>



       </div>
       </div>
   </div>

</body>

</html>
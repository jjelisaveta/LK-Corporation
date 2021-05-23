<!-- <h2>Neka kita</h2> -->
Luka Stojanovic 2018/0053
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POPRAVI.com</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>/css/stilOsnova.css">
    <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>/css/stilIstorija.css"> -->
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
   
<!-- <div class="container-fluid">
    <div id="sredina">
        <div id="zahtevi">
            <div class="zahtev">
                <table>
                    <tr>
                        <td id="userimg"><img src="slike/profilna.png"></td>
                        <td>
                            <h1>
                                Majstor A
                            </h1>
                            <h3>
                                20.05.2020.
                            </h3>
                            <h4>
                                masina za ves
                            </h4>
                        </td>
                        <td class="komentartd">
                            <form class="Komentar">
                                <label class="komentarLabel"></label><br>
                                <textarea type="text" placeholder="Komentar:" class="komentarinput" rows="4"
                                    cols="25"></textarea>
                            </form>
                            <button class="komentardugme" onclick="deleteTextArea(this)">Sacuvaj komentar</button>
                            <label class="ocenaLabel"></label>
                            <button class="ocenaDugme" onclick="myFunction(this)">+</button>
                            <button class="ocenaDugme" onclick="myFunction(this)"> -</button>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <div class="ukloni">
                                <button type="button" onclick="ukloniPopravku(this)">
                                    ukloni iz istorije
                                </button>
                            </div>
                        </td>

                    </tr>
                </table>
        
   
  
            </div>
        </div>

    </div> 
  </div> -->
</body>

</html>
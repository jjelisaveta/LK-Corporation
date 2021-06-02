<?php
$klasa = "col-10 col-md-3 offset-1 offset-md-" . $num;
?>
<div class="<?php echo $klasa; ?>" style="margin-bottom: 30px">
    <table class="prikazUslugaIstorija">
        <tr>
            <td class="userimg"><img src="<?php echo base_url() . "/" . $slika ?>" ></td>
            <td>
                <h1>
                    <?= $imeMajstor ?>
                    <?= $prezime ?>
                </h1>
                <h4>
                    <?= $datumPopravke ?>
                </h4>
                <h4>
                    <?= $opis ?>
                </h4>
            </td>
        </tr>
    </table>
</div>


            
   
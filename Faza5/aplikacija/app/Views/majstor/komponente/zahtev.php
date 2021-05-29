<?php
$idrow = "row" . $id;
?>

<div class="row" id="<?php echo $idrow ?>">
    <div class="offset - 1 col - 10">
        <table>
            <tr>
                <!-- ovde treba ubaciti da se ucitava korisnicka slika -->
                <td id="userimg"><img src=" <?php echo base_url(); ?>/slike/profilna.png"></td>
                <td>
                    <h1 class="ime">
                        <b> <?= $ime ?> <?= $prezime ?> </b>
                    </h1>
                    <hr/>
                    <h3 class="adresa">
                        <b>adresa:</b> <?= $adresa ?>
                    </h3>
                    <h3 class="opis">
                        <b>opis:</b> <i> <?= $opis ?> </i> 
                    </h3>
                    <h3 class="datumVreme">
                        <b>datum i vreme:</b> <?= $datumVreme ?>
                    </h3>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="prihvati">
                        <button type="button" onclick="prihvati('<?php echo $id ?>')">
                            prihvati
                        </button>
                    </div>
                    <div class="odbij">
                        <button type="button" onclick="odbij('<?php echo $id ?>')">
                            odbij
                        </button>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>
             
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
                        <?= $ime ?>
                        <?= $prezime ?>
                    </h1>
                    <h3 class="adresa">
                        <?= $adresa ?>
                    </h3>
                    <h4 class="opis">
                        <?= $opis ?>
                    </h4>
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
             
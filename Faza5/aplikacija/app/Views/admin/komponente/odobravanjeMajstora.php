<?php
$rowId = "red" . $id;
?>
<div id="<?php echo $rowId; ?>" class="row">
    <div class="offset-1 col-10">
        <table class="offset-0 offset-md-1 col-10 col-md-8 majstor">
            <tr>
                <td class="userimg"><img src="<?php echo base_url(); ?>/slike/profilna.png"></td>
                <td style="width:38%;">
                    <h1>
                        <?php echo $ime . " " . $prezime; ?>
                    </h1>
                    <h3>
                        <?php echo $email; ?>
                    </h3>
                    <h3>
                        <?php echo $broj; ?>
                    </h3>
                </td>
                <td>
                    <textarea name="emailArea" class="emailArea" cols="25" rows="4"
                              placeholder="Posalji email:"></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="prihvati">
                        <button id="<?php echo $id; ?>" type="button" onclick="prihvati(this)">
                            prihvati
                        </button>
                    </div>
                    <div class="odbij">
                        <button id="<?php echo $id; ?>" type="button" onclick="ukloni(this)">
                            odbij
                        </button>
                    </div>
                </td>
                <td>
                    <button class="emailButton">
                        pošalji
                    </button>
                </td>
            </tr>
        </table>
    </div>
</div>



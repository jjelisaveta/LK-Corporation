<?php
$rowId = "red" . $id;
$textId = "text" . $id;
?>
<div id="<?php echo $rowId; ?>" class="row">
    <div class="offset-1 col-10">
        <table class="majstor">
            <tr>
                <td class="userimg" style="width: 15%"><img src="<?php echo base_url() . "/" . $slika ?>" ></td>
                <td style="width:40%;">
                    <h1>
                        <b> <?php echo $ime . " " . $prezime; ?> </b>
                    </h1>
                    <h3>
                        <b> mejl: </b><?php echo $email; ?>
                    </h3>
                    <h3>
                        <b>telefon: </b><?php echo $broj; ?>
                    </h3>
                </td>
                <td style="width: 45%">
                    <textarea name="emailArea" id="<?php echo $textId; ?>" class="emailArea" cols="50" rows="5"
                              placeholder="Posalji mejl:"></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="prihvati">
                        <button id="<?php echo $id; ?>" type="button" onclick="prihvati('<?php echo $id; ?>')">
                            prihvati
                        </button>
                    </div>
                    <div class="odbij">
                        <button id="<?php echo $id; ?>" type="button" onclick="ukloni('<?php echo $id; ?>')">
                            odbij
                        </button>
                    </div>
                </td>
                <td>
                    <button id="" class="emailButton" onclick="mail('<?php echo $id; ?>','<?php echo $email; ?>')">
                        pošalji
                    </button>
                </td>
            </tr>
        </table>
    </div>
</div>



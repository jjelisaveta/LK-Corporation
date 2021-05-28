<?php
$klasa = "col-10 col-md-4 offset-1 offset-md-" . $num;
?>
<div class="<?php echo $klasa; ?>" id="<?php echo $id; ?>" style="margin-bottom: 30px">
    <div class="oblak">
        <table class="gornja">
            <tr>
                <td class="userimg"><img src="<?php echo base_url(); ?>/slike/profilna.png"></td>
                <td>
                    <button class="btn btn-danger
                    " onclick="ukloniMajstora('<?php echo $id; ?>')">&times;
                    </button>
                    <h1>
                        <?= $ime ?>
                        <?= $prezime ?>
                    </h1>
                    <p class="mala">Procenat pozitivnih ocena:</p>
                    <div class="progress">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 25%;"
                             aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%
                        </div>
                    </div>

                    <a class="mail" href="mailto:" +<?= $email ?>>Posalji mejl majstoru</a>
                    <input type="text" class="hidden" style="display:none">
                    <br>
                    <a href="" class="vise">detaljnije...</a>

                    <br/>
                </td>
            </tr>
        </table>
    </div>
</div>

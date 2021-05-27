<?php
$klasa = "col-10 col-md-4 offset-1 offset-md-".$num;
?>
<div class="<?php echo $klasa; ?>" style="margin-bottom: 30px">
<div class="oblak">
        <table class="gornja">
            <tr>
                <td class="userimg"><img src="<?php echo base_url(); ?>/slike/profilna.png"></td>
                <td>
                    <h1>
                    <?= $ime?>
                    <?=$prezime?>
                    </h1>
                    <h2>
                    <a href="mailto:"+<?=$email?>>Posalji mejl majstoru</a>
                    </h2>
                      <br>
                    <h2 style="font-size: medium;">
                        <!-- Prosek ocena: <= $prosek?> -->
                    </h2>
                 <a href="" class="vise">detaljnije...</a>
                    <br/>
                </td>
            </tr>
        </table>
       
    </div>
</div>


<div class="offset-1 col-10 jednaUsluga">
    <table class="uslugaPrikaz">
        <tr>
            <td class="slikaMajstora"><img src="<?php echo base_url(); ?>/slike/Kalu.jpg" ></td>
            <td class="opisUsluge">
                <h1>
                    <?= $naslov ?>
                </h1>
                <p>
                    <?= $opis ?>
                </p>
                <h5>
                    <?php 
                        $ispis = "";
                        foreach ($tagovi as $tag){
                            if ($ispis==""){
                                $ispis = $ispis . $tag->getOpis();
                            } else {
                                $ispis = $ispis . ", " . $tag->getOpis();
                            }
                        }
                        echo $ispis;
                    ?>
                </h5>
            </td>
            <td style="border-left: 1px solid orange; width:33%;">
                <h3>
                    Majstora preporucuje: 82% <br>
                    Prosecno vreme reakcije:02:25 <br>
                    Prosecan cena ove usluge: 3242 
                </h3>
            </td>
        </tr>
    </table>
</div>

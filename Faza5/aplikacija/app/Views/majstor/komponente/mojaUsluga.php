<div class="row">
    <div class="offset-1 col-10">
        <table class="uslugaPrikaz">
            <tr>
                <td class="slikaMajstora"><img src="<?php echo base_url(); ?>/slike/Kalu.jpg" ></td>
                <td class="opisUsluge">
                    <h1>
                        <?= $naslov ?>
                    </h1>
                    <hr/>
                    <p>
                        <?= $opis ?>
                    </p>
                    <h5>
                        
                        tagovi kad se doda doctirne
                    </h5>
                    <button type="submit" onclick="window.location='#KaluNapraviIzmenuUsluge';">
                        Izmeni
                    </button>
                </td>
            </tr>
        </table>
    </div>
</div>
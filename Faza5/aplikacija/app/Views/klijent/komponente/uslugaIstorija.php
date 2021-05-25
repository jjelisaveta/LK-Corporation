<
<div class="row">
    <div class="offset-1 col-10">

        <table class="prikazUslugaIstorija">
      
                <tr>

                    <td id="userimg"><img src="<?php echo base_url(); ?>/slike/profilna.png"></td>
                    <td>
                        <h1>
                            <?= $imeMajstor ?>
                        </h1>
                        <h4>
                            <?= $datumPopravke ?>
                        </h4>
                        <h4>
                            <!-- < $tag ?>  -->
                        </h4>
                    </td>
                    <form action="sacuvajKomentar" method="POST">
                <input type="text" name="hidden" id="" value= <?= $id ?> style="display:none">
                    <td class="komentartd">

                        <div class="Komentar">
                            <label class="komentarLabel"></label><br>
                            <textarea type="text" placeholder="Komentar:" name="komentar" class="komentarinput" rows="4"
                                      cols="25"><?php
                                if (isset($komentar)) {
                                    echo $komentar;
                                }
                                ?></textarea>
                        </div>
              

                        <button class="komentardugme" type="SUBMIT">Sacuvaj komentar
                        </button>
                        </form>
                        <form action="sacuvajOcenu" method="POST">
                           
                        <input type="text" name="hidden2" id="" value= <?=$id?> style="display:none">
                        <input type="text" name="hidden3" class="hidden3"  style="display:none">
                        <label class="ocenaLabel"></label>
                        <button class="ocenaDugme" id="dugmeP" name="submit1" type="SUBMIT" onsubmit="myFunction(this)">+</button>
                        
                        <button class="ocenaDugme" id="dugmeM" name="submit2" type="SUBMIT" onsubmit="myFunction(this)">-</button>
                      
                        </form>
                        <?php
                        if (isset($ocena)) {
                        if ($ocena == 0) {
                            ?>
                            <script>
                                myFunction(document.getElementById('dugmeM'));
                            </script>
                        <?php
                        }
                        if ($ocena == 1){
                        ?>
                            <script>
                                myFunction(document.getElementById('dugmeP'));
                            </script>
                            <?php
                        }
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <form action="obrisiIstorija" method="POST">
                        <input type="text" name="hidden2" id="" value= <?=$id?> style="display:none">
                        <div class="ukloni">
                            <button type="SUBMIT" onsubmit="ukloniPopravku(this)">
                                ukloni iz istorije
                            </button>
                        </div>
                        </form>
                    </td>

                </tr>
            </form>
        </table>

    </div>
</div>

            
   
<!-- <div class="zahtev"> -->
    <div class="row zahtev">
    <div class="offset-1 col-10">
        <table class="prikazUslugaIstorija">
            <tr>
                <td class="slikaMajstora"><img src="<?php echo base_url(); ?>/slike/Kalu.jpg" ></td>
                <td>
                            <h1>
                             <? $imeMajstor ?>
                            </h1>
                            <h3>
                            <? $datumPopravke ?>
                            </h3>
                            <h4>
                            <? $tag ?>
                            </h4>
               </td>
               <td class="komentartd">
                            <form class="Komentar">
                                <label class="komentarLabel"></label><br>
                                <textarea type="text" placeholder="Komentar:" class="komentarinput" rows="4"
                                    cols="25"></textarea>
                            </form>
                            <button class="komentardugme" onclick="deleteTextArea(this)">Sacuvaj komentar</button>
                            <label class="ocenaLabel"></label>
                            <button class="ocenaDugme" onclick="myFunction(this)">+</button>
                            <button class="ocenaDugme" onclick="myFunction(this)"> -</button>
                        </td>
            </tr>
            <tr>
                        <td colspan="3">
                            <div class="ukloni">
                                <button type="button" onclick="ukloniPopravku(this)">
                                    ukloni iz istorije
                                </button>
                            </div>
                        </td>

                    </tr>
        </table>
    </div>
<!-- </div> -->

            
   
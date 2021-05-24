<
    <div class="row">
    <div class="offset-1 col-10">
      
        <table class="prikazUslugaIstorija">
              <form action="<?php echo base_url(); ?>/Klijent/sacuvajKomentar" method="POST">
                  <input type="text" name="hidden" id="" value="<?php= $id?>" style="display:none"> 
                 
            <tr>
                
                <td id="userimg"><img src="<?php echo base_url(); ?>/slike/profilna.png" ></td>
                <td>
                            <h1>
                             <?=$imeMajstor?>
                            </h1>
                            <h3>
                            <?= $datumPopravke ?>
                            </h3>
                            <h4>
                          <!-- < $tag ?>  -->
                            </h4>
               </td>
               <td class="komentartd">
                            <div class="Komentar">
                                <label class="komentarLabel"></label><br>
                                <textarea type="text" placeholder="Komentar:" name="komentar" class="komentarinput" rows="4"cols="25"><?php
                                if (isset($komentar))
                                {
                                 echo $komentar ;
                                }
                                ?></textarea>
                            </div>
                           
                            <button class="komentardugme" type="submit" onclick="deleteTextArea(this)">Sacuvaj komentar</button>
                            <label class="ocenaLabel"></label>
                       
     
                            <button class="ocenaDugme" id="dugmeP" onclick="myFunction(this)">+</button>
                            <button class="ocenaDugme"  id="dugmeM" onclick="myFunction(this)"> -</button>
                            <?php
                          if (isset($ocena))
                           {
                            if ($ocena==0) {
                                   ?> 
                                 <script>
                           myFunction(document.getElementById('dugmeM'));
                           </script>
                           <?php 
                            }
                            if ($ocena==1){
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
                            <div class="ukloni">
                                <button type="button" onclick="ukloniPopravku(this)">
                                    ukloni iz istorije
                                </button>
                            </div>
                        </td>

                    </tr>
                </form>  
        </table>
      
    </div>
</div>

            
   
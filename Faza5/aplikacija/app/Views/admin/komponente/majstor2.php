<?php
$klasa = "col-10 col-md-4 offset-1 offset-md-" . $num;
?>
<div class="<?php echo $klasa; ?>" id="<?php echo $id; ?>" style="margin-bottom: 30px"><div class="gornja">
  <div class="row" class="gornja">
      <div class="col-4 col-md-4">
              <!-- ovde treba ubaciti da se ucitava korisnicka slika -->
      <img  class="userimg" src="<?php echo base_url(); ?>/slike/profilna.png">
      </div>
    <div class="col-8 col-md-8">
        <div class="row no-gutters">
        <div class="col-7 imeP">
        <h1>
                        <?= $ime ?>
                        <?= $prezime ?>
                    </h1>
        </div>
        <div class="col-lg-2 offset-lg-3 col-md-2 offset-md-0 col-sm-2 offset-sm-3 col-3 offset-2 ">
        <button class=" btn btn-danger  " id="btnD" onclick="ukloniMajstora('<?php echo $id; ?>')">&times;
                    </button>
        </div>
        <div class="col-1"></div>

        </div>
        <div class="row no gutters">
        <div class="col-5 ">
      
        <p class="mala">Procenat pozitivnih ocena:</p>
        </div>
        <div class="col-lg-3 offset-lg-2 col-md-3 offset-md-0 col-sm-3 offset-sm-3 col-4 offset-2 ">
        <button class=" btn btn-secondary btn-sm" onclick="mail('<?php echo $id; ?>','<?php echo $email; ?>')" >Posalji mejl</button>
        </div>
        <div class="col-2"></div>

        </div>
        
        <div class="row no-gutters">
        <div class="col-8">
        <div class="progress">
                        <div class=" progress-bar bg-warning" role="progressbar" style="width:<?= $procenat ?>%"
                             aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                        </div>
                     <span><?= $procenat?>%</span>
                    </div>
                    
        </div>
        <div class="col-lg-2 offset-lg-2 col-md-2 offset-md-0 col-sm-2 offset-sm-2 col-3 offset-1 ">
        <a href="" class="vise">...
          </a>
        </div>
        <div class="col-1"></div>

        </div>
    </div>
  </div>
        <!-- <table class="gornja">
            <tr>
               
                <td>
                  
                 
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
        </table> -->
        </div>
</div>

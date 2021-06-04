<?php
$klasa = "col-10 col-md-4 offset-1 offset-md-" . $num;
?>
<div class="<?php echo $klasa; ?>" id="<?php echo $id; ?>" style="margin-bottom: 30px">
    <div class="gornja">
        <div class="row" class="gornja">
            <div class="col-4 col-md-4">
                <!-- ovde treba ubaciti da se ucitava korisnicka slika -->
                <img  class="userimg" src="<?php echo base_url() . "/" . $slika ?>"   >
             
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
                        <button  id="btnD" onclick="ukloniMajstora('<?php echo $id; ?>')">✖</button>
                    </div>
                    <div class="col-1"></div>

                </div>
                <div class="row no gutters">
                    <div class="col-5 ">
                        <p class="mala">procenat pozitivnih ocena:</p>
                    </div>
                    <div class="col-lg-3 offset-lg-2 col-md-3 offset-md-0 col-sm-3 offset-sm-3 col-4 offset-2 ">
                        <button class=" btn btn-secondary btn-sm"
                                onclick="mail('<?php echo $id; ?>','<?php echo $email; ?>')">pošalji mejl
                        </button>
                    </div>
                    <div class="col-2"></div>

                </div>

                <div class="row no-gutters">
                    <div class="col-7">
                        <div class="progress">
                            <div class=" progress-bar progress-bar-striped" role="progressbar " style="width:<?= $procenat ?>%"
                                 aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                            </div>
                            <span><?= $procenat ?>%</span>
                        </div>

                    </div>
                    <div class="col-lg-3 offset-lg-1 col-md-3 offset-md-0 col-sm-3 offset-sm-1 col-3 offset-1 ">
                        <!-- <a href="<?php echo site_url("Admin/prikazMajstoraAdmin") ?>"> -->
                        <form action="prikazMajstoraAdmin" method="POST">
                            <input type="hidden" id="idUsluge" name="id" value="<?php echo $id ?>">
                            <input type="submit" class="vise btn btn-warning" formtarget="_blank" value="..."/>
                        </form>
                        <!-- </a> -->
                        <!-- <a href="" class="vise" ondetaljnijePrikazi>...
                          </a> -->
                    </div>
                    <div class="col-2"></div>

                </div>
            </div>
        </div>

    </div>
</div>

<br>
<div class="row">
    <div class="offset-1 col-10">

<table>
                    <tr>
                        <!-- ovde treba ubaciti da se ucitava korisnicka slika -->
                    <td id="userimg"><img src="<?php echo base_url(); ?>/slike/profilna.png"></td>
                        <td>
                            <h1 class="ime">
                            <?= $ime?>
                            <?= $prezime?>
                            </h1>
                            <h3 class="adresa">
                                <?= $adresa?>
                            </h3>
                            <h4 class="opis">
                            <?= $opis?>
                            </h4>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="prihvati">
                                <button type="button" onclick="ukloniPopravku(this)">
                                    prihvati
                                </button>
                            </div>
                            <div class="odbij">
                                <button type="button" onclick="ukloniPopravku(this)">
                                    odbij
                                </button>
                            </div>
                        </td>

                    </tr>
                </table>
                </div>
                </div>
             
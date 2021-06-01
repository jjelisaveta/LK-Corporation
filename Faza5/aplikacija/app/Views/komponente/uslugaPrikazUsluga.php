<div class="row ">
            <div class="offset-1 col-10 polje">
                <table class="uslugaTabela" id="<?= $idUsl ?>">
                    <tr>
                        <td id="userimg"><img src="<?php echo base_url() . "/" . $slika ?>"></td>
                        <td width="60%">
                            <h1>
                                <?= $naslov ?>
                            </h1>
                            <hr/>
                            <p>
                              <?= $opis ?>
                            </p>
                        </td>
                        <td class="statistika" width="25%">
                            <h3>
                                Majstora preporučuje: <b class="preporuke"> <?= $prep ?></b> <br>
                                Prosečno vreme odgovora: <b class="vremeOdgovora">02:25</b> <br> 
                                Cena usluge: <b class="cenaUsluge"> <?= $cenaUsluge ?></b> 
                            </h3>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" width="100%">
                            <div class="detaljnijeMajstor" id="<?= $idMaj ?>">
                                <button type="button" onclick="window.location='detaljnijiPrikazMajstora.html';">
                                    Prikaži profil majstora
                                </button>
                            </div>
                            <div class="odbij">
                                <button>
                                    <label for="cb">Odaberi</label>
                                    <input type="checkbox" id ="cb">
                                </button>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

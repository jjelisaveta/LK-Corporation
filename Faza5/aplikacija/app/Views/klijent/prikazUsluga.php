<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POPRAVI.com</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>/css/stilPrikazUsluga.css">

</head>
<body>
<?php
if (!isset($usluge))
    $usluge = [];
if (!isset($ostvarene))
    $ostvarene = [];
$date = date("Y-m-d");
?>


<script src="<?php echo base_url(); ?>/js/skriptaPrikazUsluga.js"></script>
<div class="container-fluid">
    <span style="font-size:30px;cursor:pointer;top: 30px;right: 30px;z-index: 1;position: fixed;" onclick="openNav()">&#9776;</span>
    <div class="row">
        <div class="col-12 offset-md-2 col-md-10" id="poljeZaUsluge">
            <div class="row">
                <div id="filteri" class="col-12 offset-md-6 col-md-4 overlay" style="display:none;">
                    <a href="javascript:void(0)" id="zatvaranje" class="closebtn" onclick="closeNav()">&times;</a>
                    <form action="" method="">
                        <label id="labelaDatum" for="termin">Datum:</label>
                        <input type="date"
                               min=<?php echo $date ?>
                               max=<?php echo date('Y-m-d', strtotime($date . ' + 30 days')) ?>
                               value=<?php echo $date ?> id="termin" name="termin">

                        <table id="termini" class="text-center">
                            <tr>
                                <td><input type="checkbox" id="0"><label for="0" class="satnice"> 00:00 - 02:00</label>
                                </td>
                                <td><input type="checkbox" id="2"><label for="2" class="satnice"> 02:00 - 04:00</label>
                                </td>
                                <td><input type="checkbox" id="4"><label for="4" class="satnice"> 04:00 - 06:00</label>
                                </td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" id="6"><label for="6" class="satnice"> 06:00 - 08:00</label>
                                </td>
                                <td><input type="checkbox" id="8"><label for="8" class="satnice"> 08:00 - 10:00</label>
                                </td>
                                <td><input type="checkbox" id="10"><label for="10" class="satnice"> 10:00 -
                                        12:00</label></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" id="12"><label for="12" class="satnice"> 12:00 -
                                        14:00</label>
                                </td>
                                <td><input type="checkbox" id="14"><label for="14" class="satnice"> 14:00 -
                                        16:00</label></td>
                                <td><input type="checkbox" id="16"><label for="16" class="satnice"> 16:00 -
                                        18:00</label>
                                </td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" id="18"><label for="18" class="satnice"> 18:00 -
                                        20:00</label>
                                </td>
                                <td><input type="checkbox" id="20"><label for="20" class="satnice"> 20:00 -
                                        22:00</label>
                                </td>
                                <td><input type="checkbox" id="22"><label for="22" class="satnice"> 22:00 -
                                        00:00</label>
                                </td>
                            </tr>
                        </table>
                        <div class="slidecontainer">
                            <input type="range" min="0" max="12000" value="6000" class="slider" id="SkalaCena">
                            <p style="color: white; font-family: Arial; text-align-last: center;">Maksimalna cena: <span
                                        id="cena"></span></p>
                            <input type="range" min="0" max="100" value="50" class="slider" id="ocena">
                            <p style="color: white; font-family: Arial; text-align-last: center;">Majstora preporučuje:
                                <span id="mojaOcena"></span>% korisnika</p>
                            <input type="range" min="0" max="600" value="300" class="slider" id="vremeOdziva">
                            <p style="color: white; font-family: Arial; text-align-last: center;">Maksimalno vreme
                                odgovora: <span id="odziv"></span> minuta</p>
                        </div>

                        <div id="selektorSortiranje">
                            <label for="sortiranje" style="color: white;">Sortiraj po:</label>
                            <select name="sortiranje" id="sortiranje">
                                <option value="s1">prosečnoj ceni rastuće</option>
                                <option value="s2">prosečnoj ceni opadajuće</option>
                                <option value="s3">prosečnoj oceni rastuće</option>
                                <option value="s4">prosečnoj oceni opadajuće</option>
                                <option value="s5">vremenu odgovora rastuće</option>
                                <option value="s6">vremenu odgovora opadajuće</option>
                            </select>
                        </div>
                        <div id="posaljiDugme">
                            <button type="button" id="dugmePretrazi">
                                Pretraži usluge
                            </button>
                        </div>
                        <script>
                            var slider = document.getElementById("ocena");
                            var output = document.getElementById("mojaOcena");
                            var slider2 = document.getElementById("SkalaCena");
                            var output2 = document.getElementById("cena");
                            var slider3 = document.getElementById("vremeOdziva");
                            var output3 = document.getElementById("odziv");
                            output.innerHTML = slider.value;
                            output2.innerHTML = slider2.value;
                            output3.innerHTML = slider3.value;
                            slider.oninput = function () {
                                output.innerHTML = this.value;
                            }
                            slider2.oninput = function () {
                                output2.innerHTML = this.value;
                            }
                            slider3.oninput = function () {
                                output3.innerHTML = this.value;
                            }
                        </script>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="offset-1 col-10 polje">
                    <table>
                        <tr>
                            <td rowspan="2" class="width:40%">
                                <textarea id="opisProblema" name="opisProblema" rows="7" cols="50"
                                          placeholder="Opis problema:"></textarea>
                            </td>
                            <td style="width:60%">
                                <h3 id=tekstSlanje>Pošaljite poruku svim odabranim majstorima i rešite svoj problem u
                                    najkraćem roku!</h3>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:60%;">
                                <button type="button" id="dugmePosalji">Prvo izaberite željene usluge</button>
                                <button type="button" id="dugmeOznaciSve" onclick="oznaciSve()">Odaberi sve</button>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <?php
            $ocene = [];
            $kasnjenje = [];
            foreach ($usluge as $usluga) {
                
                if (!isset($ocene[$usluga->getIdmaj()->getIdkor()])) {
                    $ukupno = 0;
                    $pozitivna = 0;
                    $kasni = 0;
                    $brojOstvarenih = 0;
                    foreach ($ostvarene as $ostvarena) {
                        if ($usluga->getIdmaj()->getIdkor() == $ostvarena->getIdusl()->getIdmaj()->getIdkor()){
                            $brojOstvarenih++;
                            $vremeOdgovora = $ostvarena->getIdrez()->getVremeodgovora()->format("Y-m-d H:i:s");
                            $vremeSlanja = $ostvarena->getIdrez()->getIdRez()->getVremeslanja()->format("Y-m-d H:i:s");
                            $razlika = strtotime($vremeOdgovora) - strtotime($vremeSlanja);

                            $kasni += $razlika;
                        }
                        if ($ostvarena->getIdusl()->getIdusl() == $usluga->getIdusl() && $ostvarena->getOcena()!=null) {
                            
                            $ukupno++;
                            if ($ostvarena->getOcena() == "1")
                                $pozitivna++;
                        }
                    }
                    if ($ukupno != 0) {
                        $prep = $pozitivna / $ukupno * 100;
                        $prep = number_format($prep, 2);
                        $prep = "" . $prep . "%";
                    } else $prep = " - ";
                    if ($brojOstvarenih == 0) $kasni = 0;
                    else $kasni /= $brojOstvarenih; 
                   
                } else {
                    $prep = $ocene[$usluga->getIdusl()->getIdmaj()];
                }
                echo view_cell("\App\Libraries\UslugaPrikazUslugaLib::prikazUsluge", ['naslov' => $usluga->getNaziv(),
                    'opis' => $usluga->getOpis(), 'id' => $usluga->getIdusl(),
                    'tagovi' => $usluga->getTagovi(), 'cenaUsluge' => $usluga->getCena(), 'prep' => $prep,
                    'slika' => $usluga->getIdmaj()->getSlika(), 'idUsl' => $usluga->getIdusl(),
                    'idMaj' => $usluga->getIdmaj()->getIdkor(), 'vreme'=>$kasni]);
            }
            ?>
        </div>
    </div>
</div>
</body>
</html>
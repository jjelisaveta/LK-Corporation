<table>
    <tr>
        <td class="slikaKorisnika"><img src="<?php echo base_url() . "/" . $korisnik->getSlika() ?>"></td>
        <td>
            <h1>
                <?= $komentar ?>
            </h1>
            <h4>
                - <?= $korisnik->getIme()?> <?= $korisnik->getPrezime()?>
            </h4>
        </td>
        <td class="brisanje" valign="top">
            <button type="SUBMIT" name="<?= $idOstvUsl ?>" onclick="">✖</button>
        </td>
    </tr>
</table>


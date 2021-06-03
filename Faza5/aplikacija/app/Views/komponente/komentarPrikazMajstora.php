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
    </tr>
</table>
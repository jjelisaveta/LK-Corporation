<table>
    <tr>
        <td class="slikaKorisnika"><img src="<?php echo base_url(); ?>/slike/covek1.webp"></td>
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
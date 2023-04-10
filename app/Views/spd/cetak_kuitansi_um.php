<!DOCTYPE html>
<html lang="en">

<head>
    <style>
    body {
        font-family: Arial, Helvetica, sans-serif;
        /* font-family: "Times New Roman", Times, serif; */
    }

    table {
        border-collapse: collapse;
        vertical-align: top;
        /* overflow: wrap; */
    }

    table.table-no-border tr td {
        border-collapse: collapse;
        border: 0px solid;
        word-wrap: break-word;
        padding: 4px;
    }
    </style>
</head>

<body>
    <table width="100%" class="table-no-border">
        <thead>
            <tr>
                <td>
                    <img width="80px" src="<?=base_url().'/public/img/logo_kpu.png'?>">
                </td>
                <td colspan="11" style="text-align:center; ">
                    <p>
                        <b style="font-size: 16pt;"><?='KOMISI PEMILIHAN UMUM<br/>'.strtoupper($kabkota)?></b>
                        <br />
                        <?=$alamat
                  .'<br/>Surel: '.$email
                  .'<br/>Website: '.$website
                  .'<br/> <b style="font-size: 13pt">'.strtoupper($ibukota) .'</b>'
                  ?>
                    </p>
                </td>
            </tr>
            <tr>
                <td colspan="12" style="border-bottom:1px solid #000 "></td>
            </tr>

            <tr>
                <td colspan="12"
                    style="font-size:15pt;font-weight:bold;text-align:center; padding-top:12pt; padding-bottom:12pt">
                    KUITANSI
                </td>
            </tr>
        </thead>
    </table>
    <table class="table-no-border " width="100%">

        <tr>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td valign="top" width="33%">Telah diterima dari</td>
            <td valign="top" width="2%">:</td>
            <td valign="top">Bendahara Pengeluaran/Pembantu
                <?='Komisi Pemilihan Umum '.ucwords($kabkota)?>
            </td>
        </tr>
        <tr>
            <td valign="top">Uang sebesar<br></td>
            <td valign="top">:</td>
            <td valign="top"><?=ucwords(terbilang($uang_muka).' Rupiah')?></td>
        </tr>

        <tr>
            <td valign="top">Guna keperluan membayar</td>
            <td valign="top">:</td>
            <td valign="top">Uang muka perjalanan dinas:
                <table class="table-no-border" width="100%">
                    <tr>
                        <td>Nomor SPD</td>
                        <td>:</td>
                        <td><?=$nomor_spd;?></td>
                    </tr>
                    <tr>
                        <td>Tanggal </td>
                        <td>:</td>
                        <td><?=$tanggal_spd;?></td>
                    </tr>
                    <tr>
                        <td>Perihal</td>
                        <td>:</td>
                        <td><?=$perihal_st;?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2"
                style="text-align:center;font-size: 14pt; background-color: #eeeeee; padding: 10px 20px 10px 20px; border:1.6px dashed #333333">
                Rp. <?=number_format($uang_muka,2,',','.')?></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td align="center"><?=$tanggal_kuitansi;?></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td align="center">Penerima,<br><br><br><br><?=$nama_pelaksana_spd?>
                <br>NIP <?=$nip_pelaksana_spd?>
            </td>
        </tr>
    </table>


</body>

</html>
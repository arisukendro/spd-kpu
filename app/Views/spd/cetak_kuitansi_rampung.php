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
        padding: 2px;
    }

    table.main_table {
        font-size: 11pt;
        color: #000;
    }

    table.main_table th,
    td {
        border: 1px solid #232323;
        padding: 4px 4px 4px 4px;
        word-wrap: break-word;
    }

    tr.row_border td {
        border-bottom: 1pt solid #000;
    }

    td.border-right-0,
    th.border-right-0 {
        border-right: 0px;
    }

    td.border-left-0 {
        border-left: 0px;
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
                    style="font-size:12pt;font-weight:bold;text-align:center; padding-top:12pt; padding-bottom:12pt">
                    RINCIAN BIAYA PERJALANAN DINAS
                </td>
            </tr>
        </thead>
    </table>
    <table width="100%" class="table-no-border">
        <tr>
            <td width="25%">Lampiran Nomor SPD<br></td>
            <td width="1%">:</td>
            <td><?=$nomor_spd?></td>
        </tr>
        <tr>
            <td>Tanggal SPD</td>
            <td>:</td>
            <td><?=$tanggal_spd?><br></td>
        </tr>
        <tr>
            <td>Perihal</td>
            <td>:</td>
            <td><?=$perihal_st?><br></td>
        </tr>
    </table>
    <br />
    <table width="100%" class="main_table">
        <tr>
            <th width="5%" align="center" style="padding: 5px 0px 5px 0px"><b>NO</b></th>
            <th width="30%" align="center"><b>URAIAN RINCIAN BIAYA</b></th>
            <th width="22%" align="center"><b>JUMLAH</b></th>
            <th align="center"><b>KETERANGAN</b></th>
        </tr>
        <tr>
            <td align="center">1</td>
            <td>Uang harian</td>
            <td align="right">Rp. <?=number_format((int)$uang_harian,2,',','.')?></td>
            <td><?=$ket_uang_harian?></td>
        </tr>
        <tr>
            <td align="center">2</td>
            <td>Tiket</td>
            <td align="right">Rp. <?=number_format((int)$uang_tiket,2,',','.')?></td>
            <td><?=$ket_uang_tiket?></td>
        </tr>
        <tr>
            <td align="center">3</td>
            <td>Transport / BBM</td>
            <td align="right">Rp. <?=number_format((int)$uang_transport,2,',','.')?></td>
            <td><?=$ket_uang_transport?></td>
        </tr>
        <tr>
            <td align="center">4</td>
            <td>Penginapan/hotel</td>
            <td align="right">Rp. <?=number_format((int)$uang_penginapan,2,',','.')?></td>
            <td><?=$ket_uang_penginapan?></td>
        </tr>
        <tr>
            <td align="center">5</td>
            <td>Komponen lain <i>(jika ada)</i></td>
            <td align="right">Rp. <?=number_format((int)$uang_lain,2,',','.')?></td>
            <td><?=$ket_uang_lain?></td>
        </tr>
        <?php
            $jml_terima =  (int)$uang_harian + (int)$uang_tiket + (int)$uang_transport + (int)$uang_penginapan+ (int)$uang_lain ;
            $sisa = $jml_terima - (int)$uang_muka ;
        ?>

        <tr>
            <td colspan="2" align="right">Jumlah</td>
            <td align="right">Rp.
                <?=number_format( $jml_terima ,2,',','.')?></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2" align="right">Terbilang</td>
            <td colspan="2"><i><?=ucwords(terbilang( $jml_terima).' rupiah')?></i>

            </td>
        </tr>
    </table>
    <br /><br />
    <table width="100%" class="table-no-border">
        <tr>
            <td colspan="2" align="center"></td>
            <td><?=$tanggal_kuitansi;?></td>
        </tr>
        <tr>
            <td>Telah dibayar sejumlah<br></td>
            <td></td>
            <td>Telah menerima jumlah uang sebesar<br></td>
        </tr>
        <tr>
            <td>Rp <?=number_format($jml_terima,2,',','.')?></td>
            <td></td>
            <td>Rp <?=number_format($jml_terima,2,',','.')?></td>
        </tr>
        <tr>
            <td>Bendahara Pengeluaran/Pembantu<br><br><br><br><?=$bendahara?><br>NIP.
                <?=$nip_bendahara?><br></td>
            <td></td>
            <td>Yang Menerima<br><br><br><br><?=$nama_pelaksana_spd?><br>NIP
                <?=$nip_pelaksana_spd?></td>
        </tr>
    </table>
    <hr />

    <table width="100%" class="table-no-border">
        <tr>
            <th colspan="2" align="center"><br />PERHITUNGAN SPPD RAMPUNG</th>
        </tr>
        <tr>
            <td width="35%">Ditetapkan Sejumlah<br></td>
            <td>: Rp. <?=number_format($jml_terima,2,',','.')?></td>
        </tr>
        <tr>
            <td>Yang telah dibayar semula<br></td>
            <td>: Rp. <?=number_format($jml_terima,2,',','.')?><br></td>
        </tr>
        <tr>
            <td>Sisa kurang/lebih<br></td>
            <td>: Rp. -<br></td>
        </tr>
        <tr>
            <td></td>
            <td align="center"><br />Pejabat Pembuat Komitmen,<br><br><br><br><br>
                <?=$ppkom?><br>NIP <?=$nip_ppkom?>
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
        </tr>
    </table>

</body>

</html>
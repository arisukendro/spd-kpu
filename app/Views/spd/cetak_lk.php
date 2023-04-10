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

    table.main_table td {
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
                <td width="30pt" valign="middle">
                    <img width="30pt" src="<?=base_url().'/public/img/logo_kpu.png'?>">

                </td>
                <td valign="middle"><b><?=strtoupper($instansi).'<br>'.strtoupper($kabkota)?></b></td>
                <td valign="bottom">Nomor</td>
                <td valign="bottom">:</td>
                <td valign="bottom" style="overflow: wrap; "><?=$nomor_spd?></td>
            </tr>

            <tr>
                <td colspan="5"
                    style="font-size:12pt;font-weight:bold;text-align:center; padding-top:12pt; padding-bottom:12pt">
                    FORM BUKTI KEHADIRAN PELAKSANAAN PERJALANAN DINAS<br>DALAM KOTA SAMPAI DENGAN 8 (DELAPAN)
                    JAM<br /><br />
                </td>
            </tr>
        </thead>
    </table>

    <table width="100%" style="border:0px">
        <tr>
            <td width="27%">1. Surat Tugas</td>
            <td width="2%">:</td>
            <td>Nomor <?=$nomor_st?></td>
        </tr>

        <tr>
            <td valign="top">2. Keperluan Dinas</td>
            <td width="2%">:</td>
            <td valign="top"><?=$perihal ?><br /><br /></td>
        </tr>
        <tr>
            <td valign="top">3. Tujuan</td>
            <td width="2%">:</td>
            <td valign="top">
                <?php
        if ($jml_lokasi == 1)
            foreach ($st_lokasi as $lokasi): 
                echo $lokasi['nama_lokasi'].' - '.($lokasi['alamat_lokasi'] <> NULL? $lokasi['alamat_lokasi'] .' - ': NULL).$lokasi['kota_lokasi'];
            endforeach;
        else {
            $no=1;
            foreach ($st_lokasi as $lokasi): 
                echo '['.$no++.'] '.$lokasi['nama_lokasi'].' - '.($lokasi['alamat_lokasi'] <> NULL? $lokasi['alamat_lokasi'] .' - ': NULL).$lokasi['kota_lokasi'].' ';
            endforeach;
        };
        ?>
            </td>
        </tr>
        <tr>
            <td>4. Hari, tanggal</td>
            <td width="2%">:</td>
            <td><?=nama_hari($tgl_berangkat) .', '.tgl_id($tgl_berangkat); ?></td>
        </tr>
        <tr>
            <td>5. Pelaksana</td>
            <td width="2%">:</td>
            <td> <?=$nama. ( (!empty($nip)) ? ' / NIP. '.$nip: '' ); ?></td>
        </tr>
        <tr>
            <td valign="top">6. Pangkat dan Golongan</td>
            <td width="2%">:</td>
            <td valign="top"><?=(!empty($pangkat) ? $pangkat.' / '.$golongan : '-/-')  ; ?></td>
        </tr>

        <tr>
            <td valign="top">7. Jabatan / instansi</td>
            <td width="2%">:</td>
            <td valign="top"><?=$jabatan.' / '.$klompeg?></td>
        </tr>
    </table>

    <table width="100%" style="border:1px solid; margin-top:10px;">
        <tr style="border:1px solid; ">
            <th colspan="4" align="center" valign="middle" style="border:1px solid; padding:3px">PEJABAT/PETUGAS YANG
                MENGESAHKAN</th>
        </tr>
        <tr style="border:1px solid; ">
            <td width="0.7cm" align="center" valign="middle" style="border:1px solid; font-weight:normal">No</td>
            <td width="6cm" align="center" valign="middle" style="border:1px solid; font-weight:normal">Nama Lengkap
            </td>
            <td width="5cm" align="center" valign="middle" style="border:1px solid; font-weight:normal">Jabatan</td>
            <td align="center" valign="middle" style="border:1px solid; font-weight:normal">Tanda Tangan & Stempel</td>
        </tr>
        <?php
$i=1;
  foreach ($st_lokasi as $lokasi): 
  ?>
        <tr>
            <td valign="middle" align="center" height="3.5cm" style="border:1px solid; "><?=$i?></td>
            <td style="border:1px solid; width:6cm; text-align:center; vertical-align:bottom">
                ____________________________________<p style="padding-bottom:20px; font-weight:bold">
                    <?=$lokasi['nama_lokasi']?></p>
            </td>
            <td style="border:1px solid; width:5cm"></td>
            <td valign="top" align="center" style="border:1px solid;"></td>
        </tr>
        <?php
    $i++;
  endforeach;
 ?>

    </table>

</body>

</html>
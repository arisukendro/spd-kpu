<!DOCTYPE html>
<html lang="en">

<head>

    <style>
    body {
        font-family: Arial, Helvetica, sans-serif;
        /* font-family: "Times New Roman", Times, serif; */
    }
    </style>
</head>

<body>
    <table width="100%" style="padding-top:-25px">
        <?php if ($jenis_st == "ketua") : ?>
        <!-- KOP KETUA -->
        <tr>
            <td colspan="12" style="text-align:center; ">
                <img width="80px" src="<?=base_url().'/public/img/logo_kpu.png'?>">
            </td>
        </tr>
        <tr>
            <td colspan="12" style="text-align:center; ">
                <p style="line-height:17pt; font-size:12pt">
                    <b><?='KOMISI PEMILIHAN UMUM<br/>'.strtoupper($kabkota)?></b><br />
                </p>
            </td>
        </tr>
        <!-- END KOP KETUA -->
        <?php endif; ?>

        <!-- KOP SEKRETARIS -->
        <?php if ($jenis_st == "sekretaris") : ?>
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
        <?php endif; ?>
        <!-- END KOP SEKRETARIS -->

        <!-- ISI UTAMA MULAI SINI -->
        <tr>
            <th colspan="12" style="padding-top: 0.7cm; text-align:center">
                <b>S&nbsp;U&nbsp;R&nbsp;A&nbsp;T&nbsp;&nbsp;&nbsp;&nbsp;T&nbsp;U&nbsp;G&nbsp;A&nbsp;S</b>
            </th>
        </tr>&nbsp;
        <tr>
            <td colspan="12" style="text-align:center; padding-bottom:15px">Nomor <?=$nomor_st?></td>
        </tr>

        <tr>
            <td width="17%" valign="top"><b>MENIMBANG</b></td>
            <td width="2%" valign="top">:</td>
            <td valign="top" colspan="10" style="text-align:justify">
                <table style="width:100%; padding-top:-1px">
                    <?php
                    foreach ($template as $dasar): ?>
                    <tr>
                        <td valign="top" width="30px"><?=$dasar['nomor_urut']?>.</td>
                        <td valign="top" style="text-align:justify"><?=$dasar['keterangan']?></td>
                    </tr>
                    <?php endforeach ?>
                </table>

            </td>
        </tr>

        <tr>
            <td valign="top"><b>DASAR</b></td>
            <td valign="top">:</td>
            <td colspan="10" style="text-align:justify"><?=$dasar_st?></td>
        </tr>
        <tr>
            <td colspan="12" style="text-align:center; padding-top:10px"><b>MENUGASKAN</b><br /></td>
        </tr>
        <tr>
            <td valign="top"><b>KEPADA</b></td>
            <td valign="top">:</td>
            <td colspan="10" valign="top">
                <?php if ($st_personil_numrows == 1) : 
                    foreach ($st_personil as $personil): 
                    ?>
                <table width="100%">
                    <tr>
                        <td valign="top" width="70px">Nama</td>
                        <td valign="top" width="15px">:</td>
                        <td valign="top" colspan="10"><?=$personil['nama']?>.</td>
                    </tr>
                    <tr>
                        <td valign="top">NIP</td>
                        <td valign="top">:</td>
                        <td valign="top" colspan="10"><?=$personil['nip']?></td>
                    </tr>
                    <tr>
                        <td valign="top">Jabatan</td>
                        <td valign="top">:</td>
                        <td valign="top" colspan="10"><?=$personil['jabatan']?>.</td>
                    </tr>
                </table>

                <?php 
                    endforeach; 
                endif 
                ?>

            </td>
        </tr>
    </table>
    <?php
        if ($st_personil_numrows > 1) : 
        $no=1;
        foreach ($st_personil as $personil): 
            ?>
    <table width="100%">
        <tr>
            <td width="17%" valign="top"></td>
            <td width="2%" valign="top"></td>
            <td valign="top" width="30px"><?=$no++?>.</td>
            <td valign="top" width="70px">Nama</td>
            <td valign="top" width="15px">:</td>
            <td valign="top" colspan="7"><?=$personil['nama']?></td>
        </tr>
        <tr>
            <td valign="top"></td>
            <td valign="top"></td>
            <td valign="top"></td>
            <td valign="top">NIP</td>
            <td valign="top">:</td>
            <td valign="top" colspan="7"><?=$personil['nip']?></td>
        </tr>
        <tr>
            <td valign="top"></td>
            <td valign="top"></td>
            <td valign="top"></td>
            <td valign="top">Jabatan</td>
            <td valign="top">:</td>
            <td valign="top" colspan="7"><?=$personil['jabatan']?></td>
        </tr>
    </table>
    <?php endforeach;
    endif; ?>
    <table width="100%">
        <tr>
            <td width="17%" valign="top"><b>KEPERLUAN</b></td>
            <td width="2%" valign="top">:</td>
            <td colspan="10"><?=$perihal_st?><br></td>
        </tr>

        <tr>
            <td valign="top"><b>WAKTU</b></td>
            <td valign="top">:</td>
            <td valign="top" colspan="10">
                <table width="100%" class="table-border-0">
                    <tr>
                        <td valign="top" width="27px">a.</td>
                        <td valign="top" width="70px">Lama</td>
                        <td valign="top" width="15px">:</td>
                        <td valign="top" colspan="9"><?=$masa_tugas.' ('.terbilang($masa_tugas).' ) hari ' ?></td>
                    </tr>

                    <tr>
                        <td>b.</td>
                        <td>Tanggal</td>
                        <td>:</td>
                        <td colspan="7"><?=tgl_id($tgl_berangkat). ' s.d. '.tgl_id($tgl_kembali)?></td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr>
            <td valign="top"><b>LOKASI</b></td>
            <td valign="top">:</td>
            <td colspan="10" valign="top">
                <?php
                if ($st_lokasi_numrows == 1) : 
                $no=1;
                foreach ($st_lokasi as $lokasi): 
                    echo $lokasi['nama_lokasi'].' ('.($lokasi['alamat_lokasi'] <> NULL? $lokasi['alamat_lokasi'] .' - ': NULL).$lokasi['kota_lokasi'].')';
                endforeach;
                endif; ?>
            </td>
        </tr>
        <?php
        if ($st_lokasi_numrows > 1) : 
        $no=1;
        foreach ($st_lokasi as $lokasi): 
            ?>
        <tr>
            <td valign="top"></td>
            <td valign="top"></td>
            <td valign="top" width="10px"><?=$no++?>.</td>
            <td valign="top" colspan="9">
                <?=$lokasi['nama_lokasi'].' ('.($lokasi['alamat_lokasi'] <> NULL? $lokasi['alamat_lokasi'] .' - ': NULL).$lokasi['kota_lokasi'].')' ?>
            </td>
        </tr>
        <?php endforeach;
        endif; ?>

        <tr>
            <td colspan="12" style="text-align: justify"><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Demikian
                surat tugas ini dibuat untuk digunakan sesuai keperluan dan dilaksanakan dengan penuh tanggung
                jawab.<br>

                <table width="100%">
                    <tr>
                        <td colspan="8" style="padding-top:10px; text-align:justify;" width="60%">&nbsp;</td>
                        <td colspan="4" style="padding-top:10px; text-align:center;">
                            <?=$ibukota.', '.tgl_id($tgl_st)?><br />
                            <?=ucfirst($jabatan_ttd).' '. $instansi.'<br/>'.$kabkota.'<br/><br/><br/><br/><br/><b>'.$nama_ttd.'</b>'?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

    </table>

</body>

</html>
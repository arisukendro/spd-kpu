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
                <td rowspan="3">
                    <img width="25pt" src="<?=base_url().'/public/img/logo_kpu.png'?>">

                </td>
                <td rowspan="3"><b><?=strtoupper($instansi).'<br>'.strtoupper($kabkota)?></b></td>
                <td>Lembar Ke</td>
                <td>:</td>
                <td></td>
            </tr>
            <tr>
                <td>Kode No</td>
                <td>:</td>
                <td></td>
            </tr>
            <tr>
                <td>Nomor</td>
                <td>:</td>
                <td><?=$nomor_spd?></td>
            </tr>
            <tr>
                <td colspan="5"
                    style="font-size:12pt;font-weight:bold;text-align:center; padding-top:14pt; padding-bottom:7pt">
                    SURAT PERJALANAN DINAS
                </td>
            </tr>
        </thead>
    </table>
    <table class="main_table" width="100%">
        <tr>
            <td width="20pt">1</td>
            <td colspan="5">Pejabat Pembuat Komitmen</td>
            <td colspan="6"><?=$nama_ttd.' / NIP. '.$nip_ttd?></td>
        </tr>
        <tr>
            <td class="text-center ">2</td>
            <td colspan="5" class="">Pegawai yang melaksanakan perjalanan dinas</td>
            <td colspan="6"><?=$nama.'<br>NIP. '.$nip?></td>
        </tr>

        <tr>
            <td rowspan="3" class="text-center border-right-0">3</td>
            <td style="border-right:0px solid" width="17pt">a.</td>
            <td style="border-left:0px solid" colspan="4" class="border-left-0">Pangkat dan golongan</td>
            <td colspan="6"><?=(!empty($pangkat) ? $pangkat.' / '.$golongan : '-/-')  ; ?></td>
        </tr>
        <tr>
            <td style="border-right:0px solid">b.</td>
            <td style="border-left:0px solid" colspan="4">Jabatan / instansi</td>
            <td colspan="6"><?=$jabatan.' / '.$klompeg?></td>
        </tr>

        <tr>
            <td style="border-right:0px solid">c.</td>
            <td style="border-left:0px solid" colspan="4" class="border-left-0">Tingkat biaya perjalanan dinas</td>
            <td colspan="6"><?=$tingkat_spd?></td>
        </tr>

        <tr>
            <td>4</td>
            <td colspan="5">Maksud Perjalanan dinas</td>
            <td colspan="6"><?=$perihal?></td>
        </tr>
        <tr>
            <td>5</td>
            <td colspan="5">Alat angkutan yang digunakan</td>
            <td colspan="6"><?=$kendaraan ?></td>
        </tr>

        <tr>
            <td rowspan="2">6</td>
            <td style="border-right:0px solid">a.</td>
            <td style="border-left:0px solid" colspan="4">Tempat berangkat</td>
            <td colspan="6"><?=$ibukota?></td>
        </tr>
        <tr>
            <td style="border-right:0px solid">b.</td>
            <td style="border-left:0px solid" colspan="4">Tempat tujuan</td>
            <td colspan="6">
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
            <td rowspan="3" class="text-center ">7</td>
            <td style="border-right:0px solid">a.</td>
            <td style="border-left:0px solid" colspan="4">Lamanya perjalanan dinas</td>
            <td colspan="6"><?=$masa_tugas.' ('.terbilang($masa_tugas).' ) hari ' ?></td>
        </tr>
        <tr>
            <td style="border-right:0px solid">b.</td>
            <td style="border-left:0px solid" colspan="4">Tanggal berangkat</td>
            <td colspan="6"><?=tgl_id($tgl_berangkat)?></td>
        </tr>

        <tr>
            <td style="border-right:0px solid">c.</td>
            <td style="border-left:0px solid" colspan="4">Tanggal harus kembali</td>
            <td colspan="6"><?=tgl_id($tgl_kembali)?></td>
        </tr>

        <tr>
            <td rowspan="2">8</td>
            <td colspan="11">Pengikut</td>
        </tr>
        <tr>
            <td colspan="11" class="padding-0">
                <table class="table-no-border" style="width: 100%">
                    <tr>
                        <td align="left" width="5%" style=" border-bottom:1px solid #000000">No</th>
                        <td align="left" width="35%" style="border-bottom:1px solid #000000">Nama</th>
                        <td align="left" width="25%" style=" border-bottom:1px solid #000000">Tanggal Lahir</th>
                        <td align="left" style="border-bottom:1px solid #000000 ">Keterangan</th>
                    </tr>
                    <tr>
                        <td>-</td>
                        <td style="text-align: left;">-</td>
                        <td style="text-align: left;">-</td>
                        <td style="text-align: left;">-</td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr>
            <td rowspan="3">9</td>
            <td colspan="11">Pembebanan Anggaran</td>
        </tr>
        <tr>
            <td style="border-right:0px solid">a.</td>
            <td style="border-left:0px solid" colspan="4">Instansi</td>
            <td colspan="6"><?=$instansi_singkat.' '.$kabkota?></td>
        </tr>

        <tr>
            <td style="border-right:0px solid">b.</td>
            <td style="border-left:0px solid" colspan="4">Akun</td>
            <td colspan="6"><?=$akun?></td>
        </tr>
        <tr>
            <td rowspan="2" class="text-center ">10</td>
            <td rowspan="2" colspan="5">Keterangan lain-lain</td>
            <td colspan="1" style="border-right: 0px; width: 80pt">Nomor ST</td>
            <td colspan="5" style="border-left: 0px">: <?=$nomor_st?></td>
        </tr>
        <tr>
            <td colspan="1" style="border-right: 0px">Sumber Dana</td>
            <td colspan="5" style="border-left: 0px">: <?=$sumber_dana?></td>
        </tr>
    </table>
    <table width="100%" class="table-no-border">
        <tr>
            <td colspan="12">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="6" width="9cm"></td>
            <td colspan="2" width="20px">Dikeluarkan di</td>
            <td colspan="4">: <?=$ibukota?></td>
        </tr>
        <tr>
            <td colspan="6"></td>
            <td colspan="2">Tanggal</td>
            <td colspan="4">: <?=tgl_id($tgl_ttd)?></td>
        </tr>
        <tr>
            <td colspan="6"></td>
            <td colspan="6">Pejabat Pembuat Komitmen <br /><br /><br /><br /><br /></td>
        </tr>
        <tr>
            <td colspan="6"></td>
            <td colspan="6">
                <?=$nama_ttd.'<br/> NIP. '.$nip_ttd?>
            </td>
        </tr>
    </table>

    <!-- halaman 2 SPD mulai dari sini #########################################################################################-->
    <div style="page-break-after:always;"></div>
    <table class="table-no-border " style="border:1px solid #000" width="100%">
        <tr>
            <td colspan="6" rowspan="4" width="50%"></td>
            <td width="15pt">I</td>
            <td colspan="2">Berangkat dari<br />(tempat kedudukan)</td>
            <td colspan="3" width="20%">: <?=$instansi_singkat.' '.$kabkota_singkat?></td>
        </tr>
        <tr>
            <td></td>
            <td colspan="2">Ke</td>
            <td colspan="3">:
                <?=($jml_lokasi > 1) ? '...............' :$lokasi_pertama['nama_lokasi']?>
            </td>
        </tr>
        <tr>
            <td></td>
            <td colspan="2">Pada tanggal<br></td>
            <td colspan="3">: <?=tgl_id($tgl_berangkat)?></td>
        </tr>
        <tr>
            <td></td>
            <td colspan="5">
                Kepala<br /><br /><br /><br /><?=$kepala.'<br>NIP.'.$nip_kepala?> </td>
        </tr>

        <?php
	$x=2;
	foreach ($st_lokasi as $lokasi)
	{
		$i=$x;
		?>
        <tr>
            <td colspan="12" style="border-top:1px solid #000"></td>
        </tr>
        <tr>
            <td width="4%"><?=angka_romawi($i)?></td>
            <td colspan="2" width="8%">Tiba di<br></td>
            <td colspan="3">: <?=$lokasi['nama_lokasi'];?></td>
            <td class="border-left-1"></td>
            <td colspan="2">Berangkat dari<br></td>
            <td colspan="3">: <?=$lokasi['nama_lokasi'];?></td>
        </tr>
        <tr>
            <td></td>
            <td colspan="2">Pada tanggal<br></td>
            <td colspan="3">:
                <?=$jml_lokasi > 1 ? '...............' : tgl_id($tgl_berangkat)?>
            </td>
            <td class="border-left-1"></td>
            <td colspan="2">Ke</td>
            <td colspan="3">:
                <?=($jml_lokasi > 1)? '...............': $ibukota?>
            </td>
        </tr>
        <tr>
            <td></td>
            <td colspan="2"></td>
            <td colspan="3"></td>
            <td class="border-left-1"></td>
            <td colspan="2">Pada tanggal<br></td>
            <td colspan="3">:
                <?=$jml_lokasi > 1 ? '...............': tgl_id($tgl_kembali)?></td>
        </tr>
        <tr>
            <td></td>
            <td colspan="5">
                Kepala<br /><br /><br /><br />____________________________<br>
                <div style="padding-top:35px">NIP. </div>
            </td>
            <td></td>
            <td colspan="5">
                Kepala<br /><br /><br /><br />____________________________<p></p>NIP. </td>
        </tr>
        <?php
		$x++;
	}
	?>

        <tr>
            <td colspan="12" style="border-top:1px solid #000"></td>
        </tr>
        <tr>
            <td>
                <?php
	    	$x=$jml_lokasi+2;
			echo angka_romawi($x);
			?>
            </td>
            <td colspan="2" with="18pt">Tiba di </td>
            <td colspan="3">: <?=$ibukota?><br></td>
            <td></td>
            <td colspan="5" rowspan="2" style="text-align:justify">Telah diperiksa dengan keterangan bahwa perjalanan
                tersebut diatas atas
                perintahnya dan semata-mata untuk kepentingan jabatan dalam waktu yang sesingkat-singkatnya.<br></td>
        </tr>
        <tr>
            <td></td>
            <td colspan="2">Pada tanggal</td>
            <td colspan="3">: <?=tgl_id($tgl_kembali)?><br></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td colspan="5">Pejabat Pembuat
                Komitmen<br /><br /><br /><br /><?=$nama_ttd.' <br/> NIP. '.$nip_ttd; ?>
            </td>
            <td></td>
            <td colspan="5">Pejabat Pembuat
                Komitmen<br /><br /><br /><br /><?=$nama_ttd.' <br/> NIP. '.$nip_ttd; ?>
            </td>
        </tr>
        <tr>
            <td colspan="12" style="border-top:1px solid #000"></td>
        </tr>
        <tr>
            <td><?php
		    $x=$jml_lokasi+3;
			echo angka_romawi($x);
			?></td>
            <td colspan="11">Catatan lain-lain:</td>
        </tr>
        <tr>
            <td colspan="12" style="border-top:1px solid #000"></td>
        </tr>
        <tr>
            <td><?php
		    $x=$jml_lokasi+4;
			echo angka_romawi($x);
			?>
            </td>
            <td colspan="11" class="">PERHATIAN: </td>
        </tr>
        <tr>
            <td></td>
            <td colspan="11" style="text-align:justify">
                PPK yang menerbitkan SPD, pegawai yang melakukan perjalanan dinas, para pejabat mengesahkan tanggal
                berangkat/tiba, serta bendahara pengeluaran bertanggung jawab berdasarkan peraturan-peraturan Keuangan
                Negara apabila negara menderita rugi akibat kesalahan, kelalaian dan kealpaannya.
            </td>
        </tr>
    </table>
</body>

</html>
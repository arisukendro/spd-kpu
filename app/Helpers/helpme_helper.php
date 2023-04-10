<?php 
/*
@filename 	: helpme_helper
@package	: helper
*/

function option_pangkat($selected){
?>
<option value='Ia/Juru Muda' <?php if ($selected=='Ia') { echo 'selected="selected"';} ?>>Ia/Juru Muda</option>
<option value='Ib/Juru Muda Tingkat I' <?php if($selected=='Ib') { echo 'selected="selected"';} ?>>Ib/Juru Muda Tingkat
    I</option>
<option value='Ic/Juru' <?php if($selected=='Ic') { echo 'selected="selected"';} ?>>Ic/Juru</option>
<option value='Id/Juru Tingkat I' <?php if($selected=='Id') { echo 'selected="selected"';} ?>>Id/Juru Tingkat I</option>

<option value='IIa/Pengatur Muda' <?php if($selected=='IIa') { echo 'selected="selected"';} ?>>IIa/Pengatur Muda
</option>
<option value='IIb/Pengatur Muda Tingkat I' <?php if($selected=='IIb') { echo 'selected="selected"';} ?>>IIb/Pengatur
    Muda Tingkat I</option>
<option value='IIc/Pengatur' <?php if($selected=='IIc') { echo 'selected="selected"';} ?>>IIc/Pengatur</option>
<option value='IId/Pengatur Tingkat I' <?php if($selected=='IId') { echo 'selected="selected"';} ?>>IId/Pengatur Tingkat
    I</option>

<option value='IIIa/Penata Muda' <?php if($selected=='IIIa') { echo 'selected="selected"';} ?>>IIIa/Penata Muda</option>
<option value='IIIb/Penata Muda Tingkat I' <?php if($selected=='IIIb') { echo 'selected="selected"';} ?>>IIIb/Penata
    Muda Tingkat I</option>
<option value='IIIc/Penata' <?php if($selected=='IIIc') { echo 'selected="selected"';} ?>>IIIc/Penata</option>
<option value='IIId/Penata Tingkat I' <?php if($selected=='IIId') { echo 'selected="selected"';} ?>>IIId/Penata Tingkat
    I</option>

<option value='IVa/Pembina' <?php if($selected=='IVa') { echo 'selected="selected"';} ?>>IVa/Pembina</option>
<option value='IVb/Pembina Tingkat I' <?php if($selected=='IVb') { echo 'selected="selected"';} ?>>IVb/Pembina Tingkat I
</option>
<option value='IVc/Pembina Utama Muda' <?php if($selected=='IVc') { echo 'selected="selected"';} ?>>IVc/Pembina Utama
    Muda<?=$selected?></option>
<option value='IVd/Pembina Utama Madya' <?php if($selected=='IVd') { echo 'selected="selected"';} ?>>IVd/Pembina Utama
    Madya <?=$selected?></option>
<option value='IVe/Pembina Utama' <?php if($selected=='IVe') { echo 'selected="selected"';} ?>>IVe/Pembina Utama
</option>

<?php
}

function angka_romawi($i)
{
	$array_romawi = array(1=>"I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII","XIII","XIV","XV","XVI","XVII","XIII","XIX","XX");
	return $array_romawi[$i];
}

function terbilang($x) 
{
  $angka = ["", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas"];
  if ($x < 12)
    return " " . $angka[$x];
  elseif ($x < 20)
    return terbilang($x - 10) . " belas";
  elseif ($x < 100)
    return terbilang($x / 10) . " puluh" . terbilang($x % 10);
  elseif ($x < 200)
    return "seratus" . terbilang($x - 100);
  elseif ($x < 1000)
    return terbilang($x / 100) . " ratus" . terbilang($x % 100);
  elseif ($x < 2000)
    return "seribu" . terbilang($x - 1000);
  elseif ($x < 1000000)
    return terbilang($x / 1000) . " ribu" . terbilang($x % 1000);
  elseif ($x < 1000000000)
    return terbilang($x / 1000000) . " juta" . terbilang($x % 1000000);
}


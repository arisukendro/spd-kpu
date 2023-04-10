# SPD KPU v.2

## Aplikasi apa ini?
Aplikasi SPD ini dibuat untuk digunakan di KPU Kab. Cilacap, namun tidak menutup kemungkinan juga bisa diterapkan di KPU Kabupaten/kota yang lain. Versi 2 merupakan pengembangan dari versi sebelumnya dan sekarang dibuat menggunakan framework CodeIgniter 4. 

## Kebutuhan Minimal
Aplikasi ini dapat diinstall dalam komputer dengan spesifikasi yang relatif rendah dan di Sistem Operasi apapun (disarankan Linux OS), dengan minimal RAM 2 GB. 
PHP versi 7.4 atau lebih tinggi, atau untuk kemudahan bisa menginstall Xampp (apachefriends.org)

## Cara Instalasi
- Install aplikasi Xampp
- Unduh keseluruhan isi aplikasi ini dan letakkan di folder htdocs aplikasi XAMPP
- Jalankan server PHP dan PHPmyAdmin
- Buka browser dan arahkan ke alamat localhost/phpmhadmin
- Buat database bernama "spd"
- Import database yang ada di dalam folder aplikasi ini (master_db.sql)
- Sesuaikan beberapa keterangan yang ada di dalam file app/config/site.php 
- Sesuaikan beberapa keterangan yang ada di dalam file app/config/app.php

## Catatan Release
@ 1 Ramadhan 1444 H - Inisial Release
- Beralih ke CI 4
- Penggunaan myth/auth untuk modul login
- Redesain modul laporan 
- Form SPD sekarang memunculkan opsi Lembar Konfirmasi atau SPD.
- Penambahan lokasi sekarang bisa langsung pada saat membuat surat tugas.

## Lisensi
Aplikasi bebas digunakan dan dikembangkan oleh siapapun, tidak terbatas untuk kepentingan komersial pun di perbolehkan. Tidak ada hak cipta disini. 
Wassalamualaikum,
Ari Sukendro

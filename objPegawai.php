<?php

require 'Tugas5_PHP.php';  

//5 instance object pegawai
$pegawai1 = new Pegawai('1234567890', 'Budi', 'Manager', 'Islam', 'Menikah');
$pegawai2 = new Pegawai('0987654321', 'Susi', 'Asisten Manager', 'Kristen', 'Menikah');
$pegawai3 = new Pegawai('1234567891', 'Siti', 'Kepala Bagian', 'Islam', 'Single');
$pegawai4 = new Pegawai('0987654322', 'Rudi', 'Staff', 'Islam', 'Menikah');
$pegawai5 = new Pegawai('1234567892', 'Rina', 'Staff', 'Hindu', 'Single');

$ar_pegawai = [$pegawai1, $pegawai2, $pegawai3, $pegawai4, $pegawai5]; //array of object

//cetaklah semua struktur gaji pegawai
foreach ($ar_pegawai as $pegawai) {
    $pegawai->cetak();
}

// Cetak jumlah pegawai
echo "<br><h1>Jumlah Pegawai : ".Pegawai::$jml . " orang </h1>";
?>
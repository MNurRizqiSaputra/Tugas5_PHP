<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tugas 5 PHP</title>
</head>
<body>
    <!-- Styling CSS Internal -->
    <style>
        body {
            background-color: navy;
            color: white;
            margin: 50px;
            padding: 10px;
        }

        h1 {
            text-align: center;
        }

        summary {
            font-size : 24px;
            font-weight: bold;
        }

        details{
            font-size : 18px;}
    </style>

    <!-- Bagian Header judul hanya pakai tag html -->
    <h1 align='center'>PENERAPAN OOP PADA STUDI KASUS DATA KEPEGAWAIAN<br>MENGGUNAKAN PHP</h1>
    <hr color='white'>

    <!-- Bagian menampilkan soal hanya pakai tag html -->
    <details>
        <summary>SOAL</summary>
        <p>
            Lanjutkan kode dari file pegawai.php yang sudah dibuat pada pertemuan pembelajaran, dengan ketentuan berikut:
            <ol type = '1'>
                <li>setTunjab = 20% dari Gaji Pokok</li>
                <li>setTunkel= 10% dari Gaji Pokok untuk sudah menikah (ternary)</li>
                <li>setZakatProfesi= 2,5% dari GajiPokok untuk muslim dan Gaji Kotor minimal 6jt</li>
                <li>mencetak => nip, nama, jabatan, agama, status, Gaji Pokok, Tunj Jab, Tunkel, Zakat, Gaji Bersih </li>
                <br>
                <li>Buatlah objPegawai dengan data:</li>
                <ul>
                    <li>5 instance object pegawai</li>
                    <li>cetaklah semua struktur gaji pegawai</li>
                </ul>
            </ol>
        </p>
    </details>
    <hr color='white'>

    <?php

    error_reporting(0);

    // Bagian class Pegawai
    class Pegawai{
        // Bagian property
        protected $nip;
        public $nama;
        private $jabatan;
        private $agama;
        private $status;
        static $jml = 0;
        const PT = 'PT. HTP Indonesia';

        // Bagian method constructor untuk menginisialisasi nilai awal dari property
        public function __construct($nip, $nama, $jabatan, $agama, $status){
            $this->nip = $nip;
            $this->nama = $nama;
            $this->jabatan = $jabatan;
            $this->agama = $agama;
            $this->status = $status;
            self::$jml++;
        }

        // Bagian method untuk menentukan gaji pokok berdasarkan jabatan
        public function setGajiPokok($jabatan){ 
            $this->jabatan = $jabatan;
            switch($jabatan){ // Switch case untuk menentukan gaji pokok berdasarkan jabatan
                case 'Manager': $gapok = 15000000; break;
                case 'Asisten Manager': $gapok = 10000000; break;
                case 'Kepala Bagian': $gapok = 7000000; break;
                case 'Staff': $gapok = 5000000; break;
                default: $gapok;
            }
            return $gapok; // Mengembalikan nilai gaji pokok berdasarkan jabatan
        }

        // Bagian method untuk menentukan tunjangan jabatan
        public function setTunjab($gapok){
            return $gapok * 0.2; // Mengembalikan nilai tunjangan jabatan sebesar 20% dari gaji pokok
        }
        
        // Bagian method untuk menentukan tunjangan keluarga
        public function setTunkel($gapok, $status){
            return $status == 'Menikah' ? $gapok * 0.1 : 0; // Mengembalikan nilai tunjangan keluarga sebesar 10% dari gaji pokok jika sudah menikah
        }
        
        // Bagian method untuk menentukan gaji kotor
        public function gajikotor($gapok, $tunjJab, $tunkel){
            return $gapok + $tunjJab + $tunkel; // Mengembalikan nilai gaji kotor
        }

        // Bagian method untuk menentukan zakat profesi
        public function setZakatProfesi($gajiKotor, $agama){
            if($agama == 'Islam' && $gajiKotor >= 6000000){ // Jika pegawai beragama islam dan gaji kotor lebih dari atau sama dengan 6 juta
                $zakat = $gajiKotor * 0.025; // Zakat sebesar 2.5% dari gaji kotor
                return $zakat;
            } else {
                return 0; // Jika tidak beragama islam atau gaji kotor kurang dari 6 juta maka tidak ada zakat
            }
        }


        // Bagian method untuk menentukan gaji bersih
        public function getGajiBersih(){
            $gajiPokok = $this->setGajiPokok($this->jabatan);
            $tunjJab = $this->setTunjab($gajiPokok);
            $tunkel = $this->setTunkel($gajiPokok, $this->status);
            $zakat = $this->setZakatProfesi($this->gajikotor($gajiPokok, $tunjJab, $tunkel), $this->agama);
            $gajiBersih = $gajiPokok + $tunjJab + $tunkel - $zakat;
            return $gajiBersih; // Mengembalikan nilai gaji bersih setelah dikurangi zakat profesi jika beragama islam dan gaji pokok lebih dari 6jt 
        }
        
        // Bagian method untuk mencetak data pegawai
        public function cetak(){
            echo "<h3><u>".self::PT."</u></h3><br>";
            echo "NIP : $this->nip <br>"; // Mencetak nip
            echo "Nama : $this->nama <br>"; // Mencetak nama
            echo "Jabatan : $this->jabatan <br>"; // Mencetak jabatan
            echo "Agama : $this->agama <br>"; // Mencetak agama
            echo "Status : $this->status <br>"; // Mencetak status
            $gajiPokok = $this->setGajiPokok($this->jabatan);
            echo 'Gaji Pokok : Rp. '.number_format($gajiPokok, 0, ',', '.').'<br>'; // Mencetak gaji pokok dengan format rupiah
            $tunjJab = $this->setTunjab($gajiPokok);
            echo 'Tunjangan Jabatan : Rp. '.number_format($tunjJab, 0, ',', '.').'<br>'; // Mencetak tunjangan jabatan dengan format rupiah
            $tunkel = $this->setTunkel($gajiPokok, $this->status);
            echo 'Tunjangan Keluarga : Rp. '.number_format($tunkel, 0, ',', '.').'<br>'; // Mencetak tunjangan keluarga dengan format rupiah
            $gajiKotor = $this->gajikotor($gajiPokok, $tunjJab, $tunkel);
            echo 'Gaji Kotor : Rp. '.number_format($gajiKotor, 0, ',', '.').'<br>'; // Mencetak gaji kotor dengan format rupiah
            $zakat = $this->setZakatProfesi($this->gajikotor($gajiPokok, $tunjJab, $tunkel), $this->agama);
            echo 'Zakat Profesi : Rp. '.number_format($zakat, 0, ',', '.').'<br>';  // Mencetak zakat profesi dengan format rupiah
            $gajiBersih = $this->getGajiBersih();
            echo 'Gaji Bersih : Rp. '.number_format($gajiBersih, 0, ',', '.').'<br>'; // Mencetak gaji bersih dengan format rupiah
            echo "<hr color='yellow'>";            
        }        
    }
?>
</body>
</html>
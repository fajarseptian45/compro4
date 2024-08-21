<?php
// Load file koneksi.php
require '../functions.php';

// Load file autoload.php
require '../vendor/autoload.php';

// Include librari PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

if(isset($_POST['import'])){ // Jika user mengklik tombol Import
  $nama_file_baru = $_POST['namafile'];
    $path = 'file-upload/' . $nama_file_baru; // Set tempat menyimpan file tersebut dimana

    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    $spreadsheet = $reader->load($path); // Load file yang tadi diupload ke folder tmp
    $sheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

  $numrow = 1;
  foreach($sheet as $row){
    // Ambil data pada excel sesuai Kolom
    $a = $row['A']; // Ambil data NIS
    $b = $row['B']; 
    $c = $row['C']; // Ambil data nama
    $d = $row['D']; // Ambil data jenis kelamin
    $e = $row['E']; // Ambil data telepon
    $f = $row['F']; // Ambil data alamat
    $g = $row['G'];
    $h = $row['H'];
    $i = $row['I'];
    $j = $row['J'];
    $p = password_hash($b, PASSWORD_DEFAULT);
    
    if($numrow > 1){
      // Buat query Insert
      $query = "INSERT INTO `tb_peserta`(`email`, `password`, `role`, `nm_user`, `tgl_lhr`, `tmpt_lhr`, `jekel`, `pekerjaan`, `hp`, `nik`, `alamat`) VALUES ('" . $a . "','" . $p . "','peserta','" . $c . "','" . $d . "','" . $e . "','" . $f . "','" . $g . "','" . $h . "','" . $i . "','" . $j . "')";

      //print_r($query);
      // Eksekusi $query
      mysqli_query($conn, $query);
    }

    $numrow++; // Tambah 1 setiap kali looping
  }

    unlink($path); // Hapus file excel yg telah diupload, ini agar tidak terjadi penumpukan file
}

//header('location: daftar-ujian-grup.php'); // Redirect ke halaman awal
?>
<script>
    alert('Data Peserta Berhasil di Import!');
    document.location.href = 'daftar-ujian-grup.php';
</script>
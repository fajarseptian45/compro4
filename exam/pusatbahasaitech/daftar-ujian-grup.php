<?php 
error_reporting(E_ALL);
session_start();

if( !isset($_SESSION["login"]) ) {
    header("location: ../login.php");
    exit;
}

if( $_SESSION['role'] === "peserta" ) {
    header("location: ../peserta/home.php");
    exit;
}

//koneksi db
require '../functions.php';
require '../vendor/autoload.php';
// Include librari PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

$peserta = query("SELECT `id_user`, `email`, `password`, `role`, `nm_user`, `tgl_lhr`, `tmpt_lhr`, `jekel`, `pekerjaan`, `hp`, `nik`, `alamat` FROM `tb_peserta` where role = 'peserta'");
?>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Daftar Peserta Grup</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
<!--     <link href="../vendor/DataTables/datatables.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="../vendor/DataTables/buttons-2.3.6/css/buttons.dataTables.min.css"> -->

</head>
<body id="page-top">
<!-- Page Wrapper -->
<div id="wrapper">

<!-- side bar -->
<?php
include('sidebar.php');
?>
<!-- end of side bar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php
                    include('top_nav.php');
                ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Content Row -->
                    <div class="container-fluid">
                    <div class="row">
                    <!-- Content Wrapper -->
                    <div id="content-wrapper" class="d-flex flex-column">
                        <!-- Main Content -->
                        <div id="content">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">UPLOAD DATA PESERTA BARU</h6>
                  
                        </div>
                        <!-- Begin Page Content -->
                    <div class="card shadow mb-4">
                        <div class="container-fluid">
                            <form method="post" action="daftar-ujian-grup.php" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Pilih File</label>
                                <input type="file" name="file" class="form-control" id="file">
                            </div>
                            <div class="form-group">
                                <!-- <button type="submit" class="btn btn-primary" name="preview" value="preview">Import</button> -->
                                <button type="submit" name="preview" value="preview" class="btn btn-primary">Preview</button>
                                <div style="float: right;"><a href="file-upload/sample/data-peserta.xlsx" class="btn btn-success">Download Format Excel</a>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>

                    <?php
    // Jika user telah mengklik tombol Preview
    if (isset($_POST['preview'])) {
        //$tgl_sekarang = date('YmdHis'); // Ini akan mengambil waktu sekarang dengan format yyyymmddHHiiss
       // $filename = $_POST['file'];
        $nama_file_baru = 'import-data-peserta' . '.xlsx';
        // Cek apakah terdapat file data.xlsx pada folder tmp
        if (is_file('file-upload/' . $nama_file_baru)) // Jika file tersebut ada
            unlink('file-upload/' . $nama_file_baru); // Hapus file tersebut
        $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION); // Ambil ekstensi filenya apa
        $tmp_file = $_FILES['file']['tmp_name'];
        // Cek apakah file yang diupload adalah file Excel 2007 (.xlsx)
        if ($ext == "xlsx") {
            // Upload file yang dipilih ke folder tmp
            // dan rename file tersebut menjadi data{tglsekarang}.xlsx
            // {tglsekarang} diganti jadi tanggal sekarang dengan format yyyymmddHHiiss
            // Contoh nama file setelah di rename : data20210814192500.xlsx
            move_uploaded_file($tmp_file, 'file-upload/' . $nama_file_baru);
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            $spreadsheet = $reader->load('file-upload/' . $nama_file_baru); // Load file yang tadi diupload ke folder tmp
            $sheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
            // Buat sebuah tag form untuk proses import data ke database
            echo "<form method='post' action='import.php'>";
            // Disini kita buat input type hidden yg isinya adalah nama file excel yg diupload
            // ini tujuannya agar ketika import, kita memilih file yang tepat (sesuai yg diupload)
            echo "<input type='text' name='namafile' value='" . $nama_file_baru . "'>";
                echo "<table class='table table-bordered' width='100%' cellspacing='0'>
                <tr>
                  <th colspan='10' class='text-center'>Preview Data</th>
                </tr>
                <tr>
                  <th>Email</th>
                  <th>Nama Peserta</th>
                  <th>Tanggal Lahir</th>
                  <th>Tempat Lahir</th>
                  <th>Jenis Kelamin</th>
                  <th>Pekerjaan</th>
                  <th>No.HP</th>
                  <th>NIK</th>
                  <th>Alamat</th>
                </tr>";
                  $numrow = 1;
                  $kosong = 0;
                  foreach ($sheet as $row) { // Lakukan perulangan dari data yang ada di excel
                      // Ambil data pada excel sesuai Kolom
                      $a = $row['A']; // Ambil data NIS
                      $c = $row['C']; // Ambil data nama
                      $d = $row['D']; // Ambil data jenis kelamin
                      $e = $row['E']; // Ambil data telepon
                      $f = $row['F']; // Ambil data alamat
                      $g = $row['G'];
                      $h = $row['H'];
                      $i = $row['I'];
                      $j = $row['J'];
                      // Cek jika semua data tidak diisi
                      if ($numrow > 1) {
                          echo "<tr>";
                          echo "<td>" . $a . "</td>";
                          echo "<td>" . $c . "</td>";
                          echo "<td>" . $d . "</td>";
                          echo "<td>" . $e . "</td>";
                          echo "<td>" . $f . "</td>";
                          echo "<td>" . $g . "</td>";
                          echo "<td>" . $h . "</td>";
                          echo "<td>" . $i . "</td>";
                          echo "<td>" . $j . "</td>";
                          echo "</tr>";
                      }
                      $numrow++; // Tambah 1 setiap kali looping
                  }
                  echo "</table>";
                  // Cek apakah variabel kosong lebih dari 0
                  // Jika lebih dari 0, berarti ada data yang masih kosong
                  if ($kosong > 0) {
          ?>
                      <script>
                          $(document).ready(function() {
                              // Ubah isi dari tag span dengan id jumlah_kosong dengan isi dari variabel kosong
                              $("#jumlah_kosong").html('<?php echo $kosong; ?>');
                              $("#kosong").show(); // Munculkan alert validasi kosong
                          });
                      </script>
          <?php
                  } else { // Jika semua data sudah diisi
                      echo "<hr>";
                      // Buat sebuah tombol untuk mengimport data ke database
                      echo "<button type='submit' class='btn btn-primary' name='import' value='import'>Import</button>";
                  }
                  echo "</form>";
              } else { // Jika file yang diupload bukan File Excel 2007 (.xlsx)
                  // Munculkan pesan validasi
                  echo "<div style='color: red;margin-bottom: 10px;'>
                Hanya File Excel 2007 (.xlsx) yang diperbolehkan
                      </div>";
              }
          }
          ?>
                        </div>
                    </div>
                    </div>

            <!-- End of Main Content -->
            <?php
                include('../footer.php');
            ?>
            <!-- Footer -->
            
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/datatables/datatables.min.js"></script>
  
    <!-- Page level custom scripts -->
    <script src="../js/demo/datatables-demo.js"></script>

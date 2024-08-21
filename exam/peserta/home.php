<?php
error_reporting(E_ALL);
session_start();

if( !isset($_SESSION["login"]) ) {
    header("location: ../login.php");
    exit;
}

if( $_SESSION['role'] === "admin" ) {
    header("location: ../pusatbahasaitech/index.php");
    exit;
}
 

//koneksi db
require '../functions.php';

if(isset($_POST["submit"])){
    //cek arraynya ada apa ga?  
    
    //cek data masuk atau engga
     if( daftar_ujian($_POST) > 0 ) {
        ?>
        <div class="alert alert-success" role="alert">
           Data berhasil di simpan!
       </div>
   <?php
    } else {
       ?>
        <div class="alert alert-success" role="alert">
           Data gagal di simpan!
       </div>
        <?php
    }

}

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Home</title>

    <!-- Custom fonts for this template -->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            <?php
            include('menubar.php');
            ?>
            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800">Selamat datang di Pusat Bahasa I-Tech Bapak/Ibu <b><?= $_SESSION["nama"]; ?></b></h1>
                <p class="mb-4">Website ini digunakan untuk melaksanakan Test TOEP atau TOEFL.</p>
                <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Petunjuk Penggunaan Website</h1>
                    </div>
                    <hr>
                    <p>
                        <ul>
                            <li>Disarankan untuk menggunakan browser Google Chrome versi 111 untuk mengakases website.</li>
                            <li>Lakukan ubah password (jika dibutuhkan) melalui menu <b>Profile</b>, dan tombol <b>Change Password.</b></li>
                            <li>Untuk memulai ujian, anda dapat melihat di menu <b>Schedule Test</b> dan klik pada bagian Link Ujian. Link Ujian akan aktif sesuai dengan tanggal dan waktu ujian. diluar waktu tersebut, link ujian akan non aktif (disable).</li>
                            <li>Link ujian hanya berlaku untuk satu kali ujian, jika anda telah selesai mengerjakan sampai akhir soal, maka otomatis link ujian akan disable. </li>
                            <li>Soal akan berjalan maju dan TIDAK DAPAT MUNDUR ke soal sebelumnya, untuk itu pastikan anda mengerjakan soal saat soal ditampilkan.</li>
                            <li>Score ujian dapat dilihat di menu <b>Report</b> setelah anda menyelesaikan ujian.</li>
                            <li>Formulir dibawah ini (Daftar Test/Pelatihan) digunakan untuk mendaftar Test. Jika anda sudah didaftarkan secara kolektif, tidak perlu diisi.</li> 
                        </ul>
                    </p>
                </div>
                </div>
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                    
                    <!-- ini untuk konten -->
                    <div class="card-body">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Daftar Test / Pelatihan</h1>
                        </div>
                        <hr>
                        <form class="user" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                Pelatihan yang tersedia:<br>
                                <select name="jepel"  class="form-control" required>
                                    <option>Pilih Pelatihan</option>
                                    <option value="ITP">ITP</option>
                                    <option value="TOEP">TOEP</option>
                                    <option value="TOEFL">TOEFL</option>
                                </select>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label for="exampleInputPassword1">Upload Bukti Transfer</label><br>
                                    <input type="file" name="gambar" class="form-control">
                                </div>
                                <div class="col-sm-6">
                                    <label for="exampleInputPassword1">Tanggal Transfer</label><br>
                                    <input type="date" class="form-control" id="tgltrans" name="tgltrans" placeholder="Tanggal Transfer" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                <select name="bank"  class="form-control" required>
                                    <option>Pilih Bank</option>
                                    <option value="BCA">BCA</option>
                                    <option value="BNI">BNI</option>
                                    <option value="BRI">BRI</option>
                                    <option value="BTN">BTN</option>
                                    <option value="DKI">DKI</option>
                                    <option value="Mandiri">Mandiri</option>
                                    <option value="Other">Other</option>
                                </select>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="pemilik" name="pemilik" placeholder="Nama Pemilik Rekening" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block" name="submit">Daftar!</button>
                        </form>

                    </div> 
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Pusat Bahasa I-Tech 2023</span>
                </div>
            </div>
        </footer>
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
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

</body>

</html>
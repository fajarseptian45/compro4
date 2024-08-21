<?php 
error_reporting(E_ALL);
session_start();

if( !isset($_SESSION["login"]) ) {
    header("location: ../login.php");
    exit;
}
//koneksi db
require '../functions.php';

if( $_SESSION['role'] === "admin" ) {
    header("location: ../pusatbahasaitech/index.php");
    exit;
}

//$hasil = query("SELECT p.*, j.*, u1.id_jadwal, u2.id_jadwal, u3.id_jadwal FROM `tb_pendaftaran` p, tb_jadwal j, tb_ujian u1, tb_ujian_sec1 u2, tb_ujian_sec2 u3 WHERE p.id_daftar = j.id_daftar and j.id_jadwal=u1.id_jadwal and j.id_jadwal=u2.id_jadwal and j.id_jadwal=u3.id_jadwal and p.id_user = '".$_SESSION["iduser"]."' group by j.id_jadwal");

$hasil = query("SELECT p.*, j.*, u1.id_jadwal, u2.id_jadwal, u3.id_jadwal FROM `tb_pendaftaran` p, tb_jadwal j, tb_ujian u1, tb_ujian_sec1 u2, tb_ujian_sec2 u3 WHERE p.id_daftar = j.id_daftar and j.id_jadwal=u1.id_jadwal and j.id_jadwal=u2.id_jadwal and j.id_jadwal=u3.id_jadwal and p.id_user = '".$_SESSION["iduser"]."' group by j.id_jadwal");

//$hasil2 = query("SELECT u.*, j.* FROM `tb_ujian` u, tb_jadwal j WHERE u.id_jadwal = j.id_jadwal GROUP BY u.id_jadwal");

?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Hasil Ujian</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

</head>
<body>
<div id="wrapper">
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
    <div id="content">
        <?php
        include('menubar.php');
        ?>

<div class="card shadow mb-4">
    
    <div class="card-body">
        <div class="text-center">
            <h1 class="h4 text-gray-900 mb-4">Score Test</h1>
        </div>
        <div class="text-center">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Hari, Tanggal</th>
                        <th>Waktu</th>
                        <th>Lokasi</th>
                        <th>Ujian</th>
                        <th>Hasil Ujian</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
//                  $hari   = date('l', strtotime($tanggal));
                    foreach ($hasil as $row) : 
                  ?>
                    <tr>
                        <td><?= date('l', strtotime($row["tgl_ujian"])).' ,'.date('d F Y', strtotime($row["tgl_ujian"])); ?>
                        </td>
                        <td><?= $row["wkt_ujian"]; ?></td>
                        <td><?= $row["tipe_ujian"]; ?></td>
                        <td><?= $row["jenis_test"]; ?></td>
                        <td>                        
                                <a href="score_sec1.php?token=<?= $_SESSION['token']; ?>&idj=<?= $row["id_jadwal"]; ?>&j=<?= $row["jenis_test"]; ?>">Listening</a>&nbsp;&nbsp;|&nbsp;&nbsp;
                                <a href="score_sec2.php?token=<?= $_SESSION['token']; ?>&idj=<?= $row["id_jadwal"]; ?>&j=<?= $row["jenis_test"]; ?>">Structure</a>&nbsp;&nbsp;|&nbsp;&nbsp;
                                <a href="score_sec3.php?token=<?= $_SESSION['token']; ?>&idj=<?= $row["id_jadwal"]; ?>&j=<?= $row["jenis_test"]; ?>">Reading</a>
                        </td>
                    </tr>
                </tbody>      
                <?php endforeach; ?>
            </table>   
        </div>
    </div>
</div>

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
</div>


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
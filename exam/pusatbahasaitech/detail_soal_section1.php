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
$jenis = $_GET['jenis'];
$tipe = $_GET['tipe'];

$soal = query("SELECT s.*, j.jenis, a.*, t.tipe FROM `tb_section1` s, tb_jenis j, tb_audio a, tb_tipe t WHERE s.id_jenis = j.id_jenis and s.id_audio = a.id_audio and s.id_tipe = t.id_tipe and s.id_jenis = '$jenis' and s.id_tipe = '$tipe'");
?>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Section 1</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

</head>
<body id="page-top">
    <!-- Page Wrapper -->
<div id="wrapper">
<?php
include('sidebar.php');
?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
    <div id="content">
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Detail Soal Section 1</h6>
    </div>
</div>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Jenis</th>
                        <th>Tipe</th>
                        <th>Audio</th>
                        <th>A</th>
                        <th>B</th>
                        <th>C</th>
                        <th>D</th>
                        <th>Kunci</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Jenis</th>
                        <th>Tipe</th>
                        <th>Audio</th>
                        <th>A</th>
                        <th>B</th>
                        <th>C</th>
                        <th>D</th>
                        <th>Kunci</th>
                    </tr>
                </tfoot>
                <tbody>
                  <?php foreach ($soal as $row) : ?>
                    <tr>
                        <td><?= $row["jenis"]; ?></td>
                        <td><?= $row["tipe"]; ?></td>
                        <td><?= $row["ket"]; ?></td>
                        <td><?= $row["jwbn1"]; ?></td>          
                        <td><?= $row["jwbn2"]; ?></td>          
                        <td><?= $row["jwbn3"]; ?></td>          
                        <td><?= $row["jwbn4"]; ?></td> 
                        <td><?= $row["kunci"]; ?></td>                           
                    </tr>       
                </tbody>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>
</div>

<!-- Footer -->
<?php
                include('../footer.php');
            ?>
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
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/datatables-demo.js"></script>
</body>
</html>
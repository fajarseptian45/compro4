<?php 
session_start();

if( !isset($_SESSION["login"]) ) {
    header("location: login.php");
    exit;
} 
//koneksi db
require 'functions.php';

//$hasil = query("SELECT p.*, j.*, u.nm_user FROM `tb_pendaftaran` p, tb_jadwal j, tb_peserta u WHERE p.id_daftar = j.id_daftar and p.id_user = u.id_user");

?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Hasil Ujian Section 3</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

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

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Rekap Hasil Ujian Section 3 (READING)</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                        <tr>
                                            <th>Hari, Tanggal</th>
                                            <th>Waktu</th>
                                            <th>Lokasi</th>
                                            <th>Ujian</th>
                                            <th>Nama Peserta</th>
                                            <th>Hasil Ujian</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php        
                                        // cocokan kunci jawaban dengan database
                                        $query    =mysqli_query($conn, "SELECT u.*, s.*, j.*, d.*, p.nm_user FROM `tb_ujian` u, tb_section3 s, tb_jadwal j, tb_pendaftaran d, tb_peserta p WHERE u.id_soal=s.id_soal and u.id_jadwal=j.id_jadwal  and j.id_daftar = d.id_daftar and p.id_user = d.id_user GROUP BY j.id_jadwal");
                                        //$cek    =mysqli_num_rows($query);
                                        //print_r($cek);

                                        //$hasil    = $cek;
                                        //$query2    = mysqli_query($conn, "SELECT * FROM `tb_konversi_sec3` WHERE ttl_bnr = '$hasil'");
                                        //$cek2 = mysqli_fetch_array($query2);
                                        //print_r($cek2);

                    //                  $hari   = date('l', strtotime($tanggal));
                                        foreach ($query as $row) : 
                                    ?>
                                        <tr>
                                            <td><?= date('l', strtotime($row["tgl_ujian"])).' ,'.date('d F Y', strtotime($row["tgl_ujian"])); ?>
                                            </td>
                                            <td><?= $row["wkt_ujian"]; ?></td>
                                            <td><?= $row["tipe_ujian"]; ?></td>
                                            <td><?= $row["jenis_test"]; ?></td>
                                            <td><?= $row["nm_user"]; ?></td>
                                            <td>
                                                <?php 
                                                // cocokan kunci jawaban dengan database
                                                $queries = mysqli_query($conn, "SELECT u.*, s.*, j.*, d.*, p.nm_user FROM `tb_ujian` u, tb_section3 s, tb_jadwal j, tb_pendaftaran d, tb_peserta p WHERE u.id_soal=s.id_soal and u.jwbn_user=s.kunci and u.id_jadwal=j.id_jadwal  and j.id_daftar = d.id_daftar and p.id_user = d.id_user GROUP BY j.id_jadwal");
                                                $cek    =mysqli_num_rows($queries);
                                                //print_r($cek);

                                                $hasil    = $cek;
                                                $query2    = mysqli_query($conn, "SELECT * FROM `tb_konversi_sec3` WHERE ttl_bnr = '$hasil'");
                                                $cek2 = mysqli_fetch_array($query2);    
                                                ?>
                                                <?= $cek2['konversi']; ?>
                                            </td>
                                        </tr>
                                    </tbody>      
                                    <?php endforeach; ?>
                                </table>

                    </div>
                </div>
            </div>
        </div>

            <!-- End of Main Content -->
            <?php
                include('footer.php');
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
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


$hasil = query("SELECT DISTINCT(`tgl_ujian`), `wkt_ujian`,`link_zoom`,`tipe_ujian` FROM `tb_jadwal`  
ORDER BY `tb_jadwal`.`tgl_ujian` DESC");

?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Jadwal Test</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../vendor/DataTables/datatables.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="../vendor/DataTables/buttons-2.3.6/css/buttons.dataTables.min.css">

    
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
                            <h6 class="m-0 font-weight-bold text-primary">JADWAL UJIAN</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="jadwal" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Tanggal Ujian</th>
                                            <th>Waktu Ujian</th>
                                            <th>Lokasi</th>
                                            <th>Link Zoom</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Tanggal Ujian</th>
                                            <th>Waktu Ujian</th>
                                            <th>Lokasi</th>
                                            <th>Link Zoom</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
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
                                            <td><a href="<?= $row["link_zoom"]; ?>"><?= $row["link_zoom"]; ?></a></td>
                                            <td><a href="detail_jadwal.php?tgl=<?= $row["tgl_ujian"]; ?>&wkt=<?= $row["wkt_ujian"]; ?>">Peserta</a></td>
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
   <!--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script> -->
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/buttons-2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="../vendor/datatables/pdfmake-0.1.36/pdfmake.min.js"></script>
    <script src="../vendor/datatables/buttons-2.3.6/js/buttons.html5.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script> 
    <script src="../vendor/datatables/buttons-2.3.6/js/buttons.print.min.js"></script> 
    
    <!-- Page level custom scripts -->
   <script src="../js/demo/datatables-demo.js"></script> 

    <script>
    $(document).ready( function () {
        $('#jadwal').DataTable({
            dom: 'Bfrtip',
            buttons: ['copy', 'excel', 'pdf', 'print'],
            
        });
    });
    </script>

</body>
</html>
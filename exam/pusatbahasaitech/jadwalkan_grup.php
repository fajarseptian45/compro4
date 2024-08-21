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

$chk = $_POST['checked'];
if(!isset($chk)){
    echo "<script>alert('Tidak ada data yang dipilih!'); window.location='list_konfirm.php';</script>";
}
else {
    

//koneksi db
require '../functions.php';

$soal1 = query("SELECT distinct(j.jenis), t.tipe FROM `tb_section1` s, tb_jenis j, tb_tipe t WHERE j.id_jenis = s.id_jenis and t.id_tipe = s.id_tipe");

$soal1b = query("SELECT distinct(j.jenis), t.tipe FROM `tb_section1_b` s, tb_jenis j, tb_tipe t WHERE j.id_jenis = s.id_jenis and t.id_tipe = s.id_tipe");

$soal2 = query("SELECT distinct(j.jenis), t.tipe FROM `tb_section2` s, tb_jenis j, tb_tipe t WHERE j.id_jenis = s.id_jenis and t.id_tipe = s.id_tipe");

$soal3 = query("SELECT distinct(j.jenis), t.tipe FROM `tb_section3` s, tb_jenis j, tb_tipe t WHERE j.id_jenis = s.id_jenis and t.id_tipe = s.id_tipe");



?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Pendaftaran Ujian</title>

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
                            <h6 class="m-0 font-weight-bold text-primary">JADWALKAN PENDAFTAR TEST</h6></div>
                        <div class="card-body">
                        <form method="post" action="proses_penjadwalan_grup.php">
                                
                            <div class="table-responsive">
                                <table class="table table-bordered" id="pendaftaran" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>                                            
                                            <th>No.</th>
                                            <th>Nama Peserta</th>
                                            <th>Jenis Tes</th>
                                            <th>Tanggal Ujian</th>
                                            <th>Waktu Ujian</th>
                                            <th>Soal Section 1</th>
                                            <th>Soal Section 2</th>
                                            <th>Soal Section 3</th>
                                            <th>Link Zoom</th>
                                            <th>Pelaksanaan</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Peserta</th>
                                            <th>Jenis Tes</th>
                                            <th>Tanggal Ujian</th>
                                            <th>Waktu Ujian</th>
                                            <th>Soal Section 1</th>
                                            <th>Soal Section 2</th>
                                            <th>Soal Section 3</th>
                                            <th>Link Zoom</th>
                                            <th>Pelaksanaan</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                      <?php
                                        $nomor = 1; 
                                        foreach ($chk as $id){
                                            $pendaftar = mysqli_query($conn, "SELECT p.*, u.nm_user, u.hp, u.email FROM `tb_pendaftaran` p, tb_peserta u WHERE p.id_user = u.id_user and p.id_daftar = '$id'");
                                            

                                            while($row = mysqli_fetch_array($pendaftar)) {
                                      ?>
                                        <tr>
                                            <td>
                                                <?php echo $nomor++; ?>
                                                <input type="hidden" name="id[]" value="<?=$row['id_daftar']?>">
                                            </td>
                                            <td><?= $row['nm_user']; ?></td>
                                            <td><?= $row['jenis_test']; ?></td>
                                            <td><input type="date" name="tglujian[]"  class="form-control" required></td>
                                            <td><input type="time" name="wktujian[]"  class="form-control" required></td>
                                            <td>
                                            <select name="tipesoal[]" class="form-control" >
                                                <option value="">Pilih Soal Section 1</option>
                                                <?php foreach ($soal1 as $rows) : ?>
                                                <option value="<?= $rows['tipe']; ?>"> <?= $rows['jenis']; ?> - <?= $rows['tipe']; ?> </option>                                                    
                                                <?php endforeach; ?>
                                            </select>
                                            </td>                                            
                                            <td>
                                            <select name="tipesoal2[]" class="form-control" >
                                                <option value="">Pilih Soal Section 2</option>
                                                <?php foreach ($soal2 as $rows) : ?>                
                                                <option value="<?= $rows['tipe']; ?>"> <?= $rows['jenis']; ?> - <?= $rows['tipe']; ?> </option>                                                    
                                                <?php endforeach; ?>
                                            </select>
                                            </td>
                                            <td>
                                            <select name="tipesoal3[]" class="form-control" >
                                                <option value="">Pilih Soal Section 3</option>
                                                <?php foreach ($soal3 as $rows) : ?>                
                                                <option value="<?= $rows['tipe']; ?>"> <?= $rows['jenis']; ?> - <?= $rows['tipe']; ?> </option>                                                    
                                                <?php endforeach; ?>
                                            </select>
                                            </td>
                                            <td><textarea class="form-control" name="zoom[]" required></textarea></td>
                                            <td>
                                            <select name="lokasi[]" class="form-control" >
                                                <option value="Offline">Offline</option>
                                                <option value="Online">Online</option>
                                            </select>
                                            </td>
                                       </tr>     
                                       </tbody>
                                       
                                    <?php 
                                }
                            }
                                 ?>
                                </table>
                                <div class="modal-footer">
                            <button type="submit" name="submit" value="submit" class="btn btn-primary">Jadwalkan Masal</button>
                            </form>   
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
    <?php
    }
    
    ?>
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
    <script src="../vendor/datatables/pdfmake-0.1.36/pdfmake.min.js"></script>
    <script src="../vendor/datatables/buttons-2.3.6/js/buttons.html5.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script> 
    <script src="../vendor/datatables/buttons-2.3.6/js/buttons.print.min.js"></script> 
    
    <!-- Page level custom scripts -->
    <script src="../js/demo/datatables-demo.js"></script>

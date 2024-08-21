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
//$hasil = query("select * from tb_peserta where id_user = '".$_SESSION["iduser"]."'");

if(isset($_POST["submit"])){
    //cek arraynya ada apa ga?  
    
    //cek data masuk atau engga
     if( ubah_password($_POST) > 0 ) {
         ?>
         <div class="alert alert-success" role="alert">
            Data berhasil di update!
        </div>
    <?php
     } else {
        ?>
         <div class="alert alert-success" role="alert">
            Data gagal di update!
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

    <title>Ubah Password Peserta</title>

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
                
                <!-- DataTales Example -->
                <div class="card shadow mb-4">                    
                <div class="card-body">
                <!-- ini untuk konten -->
                <div class="card-body">
                <div class="text-center">
            	    <h1 class="h4 text-gray-900 mb-4">Change Password</h1>
                </div>
            	<div class="card-body">
                    <div class="table-responsive">
                    <form class="user" method="post">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                
                                <tr>
                                    <td width="30%">Old Password</td>
                                    <td><input type="password" class="form-control" id="ps1" name="ps1" required></td>
                                </tr>
                                <tr>
                                    <td width="30%">New Password</td>
                                    <td><input type="password" class="form-control" id="ps2" name="ps2" required></td>
                                </tr>
                                <tr>
                                    <td width="30%">Confirm New Password</td>
                                    <td><input type="password" class="form-control" id="ps3" name="ps3" required></td>
                                </tr>
                                
                                <tr>
                                    <td colspan="2">
                                        <input type="submit" name="submit" value="Update" class="btn btn-primary btn-user btn-block">
                                </tr>
                        </table>
                    </form>
                    </div>
                </div>

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
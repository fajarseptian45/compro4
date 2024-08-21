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
$hasil = query("select * from tb_peserta where id_user = '".$_SESSION["iduser"]."'");

if(isset($_POST["submit"])){
    //cek arraynya ada apa ga?  
    
    //cek data masuk atau engga
     if( ubah_profile($_POST) > 0 ) {
         echo "
            <script>
                alert('Data Berhasil Diupdate!');
                document.location.href = 'profile_admin.php';
            </script>
         ";
     } else {
         echo "
            <script>
                alert('Data Gagal Diupadate!');
                document.location.href = 'profile_admin.php';
            </script>
         ";
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

    <title>Profile Admin</title>

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
                            <h6 class="m-0 font-weight-bold text-primary">PROFILE ADMIN</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <form class="user" method="post">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <?php
                                    foreach ($hasil as $row) : 
                                ?>
                                        <tr>
                                            <td width="30%">Nama</td>
                                            <td><input type="text" class="form-control" id="nm" name="nm" value="<?= $row["nm_user"]; ?>"></td>
                                        </tr>
                                        <tr>
                                            <th>NIK</th>
                                            <td><input type="number" class="form-control" id="nik" name="nik" value="<?= $row["nik"]; ?>"></td>
                                        </tr>
                                        <tr>
                                            <th>Pekerjaan</th>
                                            <td><input type="text" class="form-control" id="krj" name="krj" value="<?= $row["pekerjaan"]; ?>"></td>
                                        </tr>
                                        <tr>
                                            <th>E-Mail</th>
                                            <td><input type="email" class="form-control" id="email" name="email" value="<?= $row["email"]; ?>"></td>
                                        </tr>
                                        <tr>
                                            <th>Tempat, Tanggal Lahir</th>
                                            <td><input type="text" class="form-control" id="tmptlhr" name="tmptlhr" value="<?= $row["tmpt_lhr"]; ?>">, <input type="date" class="form-control" id="tgllhr" name="tgllhr" value="<?= $row["tgl_lhr"]; ?>"></td>
                                        </tr>
                                        <tr>
                                            <th>Jenis Kelamin</th>
                                            <td>
                                                <select name="jekel" class="form-control">
                                                    <option value="<?= $row["jekel"]; ?>"><?= $row["jekel"]; ?></option>
                                                    <option value="Laki=laki">Laki-laki</option>
                                                    <option value="Perempuan">Perempuan</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>No.Hp</th>
                                            <td><input type="text" class="form-control" id="hp" name="hp" value="<?= $row["hp"]; ?>"></td>
                                        </tr>
                                        <tr>
                                            <th>Alamat</th>
                                            <td><textarea name="alamat" class="form-control"><?= $row["alamat"]; ?></textarea></td>
                                        </tr>
                                    <?php endforeach; ?>
                                        <tr>
                                            <td colspan="2">
                                                <input type="hidden" class="form-control form-control-user" id="idu" name="idu" value="<?= $row["id_user"]; ?>">
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
    <script src="../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/chart-area-demo.js"></script>
    <script src="../js/demo/chart-pie-demo.js"></script>

</body>

</html>
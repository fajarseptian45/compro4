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

$id = $_GET["idj"];
$j = $_GET["j"];


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
<div class="card shadow mb-4">
    <div class="card-header py-3">
        
    </div>
    <div class="card-body">
        <div class="text-center">
            <h1 class="h4 text-gray-900 mb-4">Score Test Listening</h1>
        </div>
        <div class="text-center">

<?php        
// cocokan kunci jawaban dengan database
$query    =mysqli_query($conn, "SELECT u.*, s.* FROM `tb_ujian_sec1` u, tb_section1 s WHERE u.id_soal=s.id_soal and u.jwbn_user=s.kunci and u.id_jadwal = '$id'");
$cek    =mysqli_num_rows($query);
//print_r($cek);

$hasil    = $cek;

if($j === "TOEFL"){
    $query2    = mysqli_query($conn, "SELECT * FROM `tb_konversi_sec1` WHERE ttl_bnr = '$hasil'");
    $cek2 = mysqli_fetch_array($query2);
    //print_r($cek2);
    $s1 = $cek2['konversi'];
}
else{
    $query2    = mysqli_query($conn, "SELECT * FROM `tb_konversi_toep_sec1` WHERE ttl_bnr = '$hasil'");
    $cek2 = mysqli_fetch_array($query2);
    //print_r($cek2);
    $s1 = $cek2['konversi'];
}
?>
<h4><?= $s1; ?></h4>
        </div>
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
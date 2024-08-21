<?php
error_reporting(E_ALL);
session_start();
//echo session_id();

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

$idj = $_GET['idj'];
$jenis = $_GET['jenis'];
$t1 = $_GET['tipe1'];
$t1b = $_GET['tipe1b'];
$t2 = $_GET['tipe2'];
$t3 = $_GET['tipe3'];

$_SESSION['tglujian'] = $_GET['tgl'];
//$tglujian = $_GET['tgl'];
$tglujian = date('F j, Y H:i:s', strtotime($_SESSION['tglujian'])); 

//$hasil = query("select j.*, d.jenis_test, d.id_user FROM tb_jadwal j, tb_pendaftaran d WHERE j.id_daftar = d.id_daftar and j.id_jadwal = '$idj'");

//print_r($hasil);

?>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Start Ujian</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

</head>
<body>
<?php
    include('menubar.php');
?>
<div class="card shadow mb-4">
    
    
        <div class="card-body" style="background-color: #E0FFFF;">
        <div class="text-center">
            <h1 class="h4 text-gray-900 mb-4">
            Start Exam
            </h1>
        </div>
        <div class="text-center">
        <?php //foreach ($hasil as $row) : ?>
             <a href="ujian_listening.php?idj=<?= $idj; ?>&jenis=<?= $jenis; ?>&tipe=<?= $t1; ?>&tglujian=<?= $tglujian; ?>"><button type="button" class="btn btn-primary" id="ujian-listening">Section 1<br>LISTENING COMPREHENSION</button></a>&nbsp;&nbsp;
            
             <a href="ujian_structure.php?idj=<?= $idj; ?>&jenis=<?= $jenis; ?>&tipe=<?= $t2; ?>&tglujian=<?= $tglujian; ?>"><button type="button" class="btn btn-primary">Section 2<br>STRUCTURE AND WRITTEN EXPRESSION</button></a>&nbsp;&nbsp;
            
             <a href="ujian_reading.php?idj=<?= $idj; ?>&jenis=<?= $jenis; ?>&tipe=<?= $t3; ?>&tglujian=<?= $tglujian; ?>"><button type="button" class="btn btn-primary">Section 3<br>READING COMPREHENSION</button></a>
            
        <?php //endforeach; ?>
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
</body>
</html>
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

$id = $_GET["idj"];
$j = $_GET["jenis"];

$peserta = query("SELECT p.*, j.*, u.nm_user, t.* FROM `tb_pendaftaran` p, tb_jadwal j, tb_peserta u, tb_ujian_sec1 t WHERE p.id_daftar = j.id_daftar and p.id_user = u.id_user and j.id_jadwal=t.id_jadwal and j.id_jadwal = '$id' GROUP BY j.id_jadwal");

?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Certificate</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

    <style>
       @media print {
        /* Mengatur layout kertas dan margin */
        @page {
            size: A4;
            margin: 0;
            orientation: portrait;
        }

        /* Menghilangkan tombol saat mencetak */
        button {
            display: none;

        }
    }
    </style>

</head>
<body>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        
    </div>
    <?php foreach ($peserta as $row) : ?>
    <div class="card-body">
        <div class="text-center">           
            <h1 class="h4 text-gray-900 mb-4">CERTIFICATE OF ACHIEVEMENT</h1>
            <p><i>This is to certify that</i></p>
            <h2><?= strtoupper($row['nm_user']); ?></h2>
            <p><i>achieved the following scores on the</i></p>
            <h3><?= $row['jenis_test']; ?></h3>
    <?php endforeach; ?>
            <p>
                <table align="center" border="1">
                    <tr align="left">
                        <td width="300px">Listening Comprehension</td>
                        <td width="100" align="center">
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
                            <?= $s1; ?>
                        </td>
                    </tr>
                    <tr align="left">
                        <td>Structure & Written Expression</td>
                        <td align="center">
                            <?php        
                            // cocokan kunci jawaban dengan database
                            $query2    =mysqli_query($conn, "SELECT u.*, s.* FROM `tb_ujian_sec2` u, tb_section2 s WHERE u.id_soal=s.id_soal and u.jwbn_user=s.kunci and u.id_jadwal = '$id'");
                            $cek_s2    =mysqli_num_rows($query2);
                            //print_r($cek_s2);

                            $hasil2    = $cek_s2;
                            if($j === "TOEFL"){
                                $query_s2    = mysqli_query($conn, "SELECT * FROM `tb_konversi_sec2` WHERE ttl_bnr = '$hasil2'");
                                $cek2_s2 = mysqli_fetch_array($query_s2);
                                //print_r($cek2);
                                $s2 = $cek2_s2['konversi'];
                            }
                            else{
                                $query_s2    = mysqli_query($conn, "SELECT * FROM `tb_konversi_toep_sec2` WHERE ttl_bnr = '$hasil2'");
                                $cek2_s2 = mysqli_fetch_array($query_s2);
                                //print_r($cek2);
                                $s2 = $cek2_s2['konversi'];
                            }
                            ?>
                            <?= $s2; ?>
                        </td>
                    </tr>
                    <tr align="left">
                        <td>Reading Comprehension</td>
                        <td align="center">
                            <?php        
                            // cocokan kunci jawaban dengan database
                            $query3    =mysqli_query($conn, "SELECT u.*, s.* FROM `tb_ujian` u, tb_section3 s WHERE u.id_soal=s.id_soal and u.jwbn_user=s.kunci and u.id_jadwal = '$id'");
                            $cek_s3    =mysqli_num_rows($query3);
                            //print_r($cek_s3);

                            $hasil3    = $cek_s3;
                            if($j === "TOEFL"){
                                $query_s3    = mysqli_query($conn, "SELECT * FROM `tb_konversi_sec3` WHERE ttl_bnr = '$hasil3'");
                                $cek2_s3 = mysqli_fetch_array($query_s3);
                                //print_r($cek23);
                                $s3 = $cek2_s3['konversi'];
                            }
                            else{
                                $query_s3    = mysqli_query($conn, "SELECT * FROM `tb_konversi_toep_sec3` WHERE ttl_bnr = '$hasil3'");
                                $cek2_s3 = mysqli_fetch_array($query_s3);
                                //print_r($cek23);
                                $s3 = $cek2_s3['konversi'];
                            }
                            ?>
                            <?= $s3; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td><center>
                            <?php
                                $score = $s1+$s2+$s3;
                                $score2 = $score * 10;
                                $score3 = round($score2/3);
                                //echo $s3;
                                echo $score3;
                            ?>
                            </center>
                        </td>
                    </tr>
                </table>
                
            </p>
        </div>
    
        <div class="text-center">
            <button class="" onclick="cetak()">Cetak Sertifikat</button>
        </div>
    </div>
</div>

<script>
    function cetak() {
    window.print();
}
</script>

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
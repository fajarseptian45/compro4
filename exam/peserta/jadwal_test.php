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


$hasil = query("SELECT p.*, j.* FROM `tb_pendaftaran` p, tb_jadwal j WHERE p.id_daftar = j.id_daftar and p.id_user = '".$_SESSION["iduser"]."'");

/* $cek = mysqli_query($conn, '$hasil');
print_r($cek); */

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
<?php
    include('menubar.php');
?>
<div class="card shadow mb-4">
    
    <div class="card-body">
        <div class="text-center">
            <h1 class="h4 text-gray-900 mb-4">Jadwal Test</h1>
        </div>
        <div class="text-center">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Hari, Tanggal</th>
                        <th>Waktu</th>
                        <th>Lokasi</th>
                        <th>Link Zoom</th>
                        <th>Link Ujian</th>
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
                        <td><a href=""><?= $row["link_zoom"]; ?></a></td>
                        <td>
                        <?php
                            date_default_timezone_set("Asia/Jakarta");
                            $tgl = date('d F Y');
                            $wkt = date('H:i:s');                            
                            $wkt2 = date('H:i:s', strtotime($row['wkt_ujian']));
                            $tgl2 = date('d F Y', strtotime($row["tgl_ujian"]));

                            $ujian = mysqli_query($conn, "SELECT s1.`id_jadwal` as 'j1', s2.`id_jadwal` as 'j2', s3.`id_jadwal` as 'j3' FROM `tb_ujian_sec1` s1, `tb_ujian_sec2` s2, `tb_ujian` s3 WHERE s1.id_jadwal = '".$row['id_jadwal']."' and s2.id_jadwal = '".$row['id_jadwal']."' and s3.id_jadwal = '".$row['id_jadwal']."'");
                            $cekujian = mysqli_fetch_array($ujian);
                            $x = isset($cekujian['j1']) ? $cekujian['j1'] : '';
                            $y = isset($cekujian['j2']) ? $cekujian['j2'] : '';
                            $z = isset($cekujian['j3']) ? $cekujian['j3'] : '';
                            //$y = $cekujian['id_jadwal'];
                            if( ($x === $row['id_jadwal']) && ($y === $row['id_jadwal']) && ($z === $row['id_jadwal']) ){
                            echo "
                                        Anda sudah Ujian!
                                    ";
                            }
                            else {


                            if($tgl === $tgl2 && $wkt >= $wkt2)
                            { 
                            ?>
                                <a href="section_test.php?token=<?= $_SESSION['token']; ?>&idj=<?= $row["id_jadwal"]; ?>&jenis=<?= $row["jenis_test"]; ?>&tipe1=<?= $row["soal_sec1"]; ?>&tipe1b=<?= $row["soal_sec1b"]; ?>&tipe2=<?= $row["soal_sec2"]; ?>&tipe3=<?= $row["soal_sec3"]; ?>&tgl=<?= $tgl2.' '.$wkt; ?>"><?= $row["jenis_test"]; ?></a>
                            <?php
                            }
                            else{
                        ?>
                                <?= $row["jenis_test"]; ?>
                        <?php
                            }
                        }
                        ?>
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
</body>
</html>
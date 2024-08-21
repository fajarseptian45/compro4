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

//$chk = $_POST['checked'];
//$tgl = date('Y-m-d');


if(isset($_POST['submit'])) {
    for($i=0; $i<count($_POST['id']); $i++) {
        $id_d = $_POST['id'][$i];
        $tgluji = $_POST['tglujian'][$i];
        $wktuji = $_POST['wktujian'][$i];
        $zoom = $_POST['zoom'][$i];
        $s1 = $_POST['tipesoal'][$i];
        $s2 = $_POST['tipesoal2'][$i];
        $s3 = $_POST['tipesoal3'][$i];
        $tipe = $_POST['lokasi'][$i];

        $sql = mysqli_query($conn, "INSERT INTO `tb_jadwal`(`id_daftar`, `tgl_ujian`, `link_zoom`, `tipe_ujian`, wkt_ujian, soal_sec1, soal_sec2, soal_sec3) 
        VALUES('$id_d', '$tgluji', '$zoom', '$tipe', '$wktuji', '$s1', '$s2', '$s3')");

        print_r($sql);

        $query2 = "update tb_pendaftaran set status = 'Dijadwalkan' where id_daftar = '$id_d'";

        mysqli_query($conn, $query2);
    }

    if($sql) {
        echo "<script>alert('".count($chk)." data pendaftaran berhasil di jadwalkan!'); window.location='list_konfirm.php';</script>";
    }
    else {
        echo "<script>alert('Penjadwalan pendaftar Gagal!');</script>";
    }
}
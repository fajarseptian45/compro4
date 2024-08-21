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

$chk = $_POST['checked'];
//$tgl = date('Y-m-d');

if(isset($_POST['submit'])) {
    for($i=0; $i<count($_POST['id']); $i++) {
        $id = $_POST['id'][$i];
        $jenis = $_POST['jenis'][$i];
        $sql = mysqli_query($conn, "UPDATE tb_pendaftaran SET jenis_test = '$jenis' WHERE id_daftar = '$id'");
    }
    if($sql) {
        echo "<script>alert('Data pendaftaran berhasil di update!'); window.location='list_konfirm.php';</script>";
    }
    else {
        echo "<script>alert('Hapus data Gagal!');</script>";
    }
}
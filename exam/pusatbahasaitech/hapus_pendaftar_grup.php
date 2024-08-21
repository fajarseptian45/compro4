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
if(!isset($chk)){
    echo "<script>alert('Tidak ada data yang dipilih!'); window.location='list_konfirm.php';</script>";
}
else {
    foreach($chk as $id) {
        $sql = mysqli_query($conn, "DELETE FROM tb_pendaftaran WHERE id_daftar = '$id'") or die(mysqli_error($conn));
    }

    if($sql) {
        echo "<script>alert('".count($chk)." data pendaftaran berhasil dihapus!'); window.location='list_konfirm.php';</script>";
    }
    else {
        echo "<script>alert('Hapus data Gagal!');</script>";
    }
}

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

$tgl = date('Y-m-d');

$chk = $_POST['checked'];
    if(!isset($chk)){
        echo "<script>alert('Tidak ada data yang dipilih!'); window.location='list_peserta.php';</script>";
    }
    else {
        foreach($chk as $id) {
            $daftar = mysqli_query($conn, "INSERT INTO tb_pendaftaran(id_user, tgl_daftar) VALUES ('$id', '$tgl')") or die(mysqli_error($conn));
        //}
        }
        if($daftar) {
            echo "<script>alert('Data peserta berhasil di daftarkan!'); window.location='list_peserta.php';</script>";
        }
        else {
            echo "<script>alert('Pendaftaran Peserta Gagal!');</script>";
        }

    }
//}

<?php
error_reporting(E_ALL);
session_start();

if( $_SESSION['role'] === "peserta" ) {
    header("location: ../peserta/home.php");
    exit;
}


require '../functions.php';

$id = $_GET["id"];

if(hapus_soal2($id) > 0){
	echo "
            <script>
                alert('Data Berhasil Dihapus!');
                document.location.href = 'soal2.php';
            </script>
         ";
     } else {
         echo "
            <script>
                alert('Data Gagal Dihapus!');
                document.location.href = 'soal2.php';
            </script>
         ";
     }


?>
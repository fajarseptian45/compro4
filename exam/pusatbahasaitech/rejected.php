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



require '../functions.php';

$id = $_GET["id"];

if(ubah_status($id) > 0){
	echo "
            <script>
                alert('Data Berhasil di Rejected!');
                document.location.href = 'list_konfirm.php';
            </script>
         ";
    } else {
        echo "
        <script>
            alert('Data Gagal di Rejected!');
            document.location.href = 'list_konfirm.php';
        </script>
     ";
    }


?>
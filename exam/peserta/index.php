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
 
?>
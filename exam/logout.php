<?php
error_reporting(E_ALL);
session_start();
$_SESSION = [];
session_unset();
session_destroy();

header("location: login.php");
exit;

?>
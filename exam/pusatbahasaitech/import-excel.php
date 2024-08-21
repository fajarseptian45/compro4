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
require '../vendor/autoload.php';
// Include librari PhpSpreadsheet
use vendor\phpoffice\phpspreadsheet\Spreadsheet;
use vendor\phpoffice\phpspreadsheet\Reader\Xlsx;


if(isset($_POST['import'])) {
//function importPeserta() {
	$namaFile = $_FILES['file']['name'];
	$ukuranFile = $_FILES['file']['size'];
	$error = $_FILES['file']['error'];
	$tmpName = $_FILES['file']['tmp_name'];

	// cek file yang di uplo4d
	$ekstensiGambarValid = ['xlsx'];
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));
	if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
		?>
			<div class="alert alert-success" role="alert">
			File yang diupload bukan file excel!
			</div>
		<?php
		return false;
	}

	// jika ukuran terlalu besar
	if( $ukuranFile > 50000000 ) {
		?>
			<div class="alert alert-success" role="alert">
			Ukuran file excel terlalu besar!
			</div>
		<?php
		return false;	
	}

	// lolos pengecekan gambar siap di upload
	// generate mana baru untuk gambar yang di upload
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiGambar;
	move_uploaded_file($tmpName, 'file-upload/' . $namaFileBaru);
	//return $namaFileBaru;

    $obj = PHPExcel_IOFactory::load('file-upload/'.$namaFileBaru);
    $all_data = $obj->getActiveSheet()->toArray(null, true, true);

    echo $all_data[2]['A'];


}

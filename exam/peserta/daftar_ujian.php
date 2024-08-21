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

//koneksi db
require '../functions.php';


if(isset($_POST["submit"])){
    //cek arraynya ada apa ga?  
    
    //cek data masuk atau engga
     if( daftar_ujian($_POST) > 0 ) {
        ?>
        <div class="alert alert-success" role="alert">
           Data berhasil di Simpan!
       </div>
   <?php
    } else {
       ?>
        <div class="alert alert-success" role="alert">
           Data gagal di di Simpan!
       </div>
        <?php
    }

}

?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Ujian</title>
	
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
</head>
<body>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Pusat Bahasa</h6>
    </div>
    <div class="card-body">
    <div class="text-center">
	    <h1 class="h4 text-gray-900 mb-4">Daftar Test / Pelatihan</h1>
	</div>
	<hr>
	<form class="user" method="post" enctype="multipart/form-data">
	    <div class="form-group" align="center">
	        Pelatihan yang tersedia:<br>
            <input type="radio" name="jepel" value="ITP">&nbsp;&nbsp;ITP &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" name="jepel" value="TOEP">&nbsp;&nbsp;TOEP &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" name="jepel" value="TOEFL">&nbsp;&nbsp;TOEFL 
	    </div>
	    <div class="form-group row">
	        <div class="col-sm-6 mb-3 mb-sm-0">
			    <label for="exampleInputPassword1">Upload Bukti Transfer</label><br>
			    <input type="file" name="gambar" class="Tanggalntrol">
			</div>
			<div class="col-sm-6">
				<label for="exampleInputPassword1">Tanggal Transfer</label><br>
	            <input type="date" class="form-control form-control-user" id="tgltrans" name="tgltrans" placeholder="Tanggal Transfer" required>
	        </div>
	    </div>
	    <div class="form-group row">
	        <div class="col-sm-6 mb-3 mb-sm-0">
	            <input type="text" class="form-control form-control-user" id="bank" name="bank" placeholder="Bank Pengirim" required>
	        </div>
	        <div class="col-sm-6">
	            <input type="text" class="form-control form-control-user" id="pemilik" name="pemilik" placeholder="Nama Pemilik Rekening" required>
	        </div>
	    </div>
	    <button type="submit" class="btn btn-primary btn-user btn-block" name="submit">Daftar!</button>
	</form>

</div>
</div>

</body>
</html>

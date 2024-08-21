<?php 
error_reporting(E_ALL);
//koneksi db
require 'functions.php';

if(isset($_POST["submit"])){
    //cek arraynya ada apa ga?  
    
    //cek data masuk atau engga
     if( registrasi($_POST) > 0 ) {
         echo "
            <script>
                alert('Data Berhasil Disimpan!');
                document.location.href = 'registrasi.php';
            </script>
         ";
     } else {
         echo "
            <script>
                alert('Data Gagal Disimpan!');
                document.location.href = 'registrasi.php';
            </script>
         ";
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
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
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
	    <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
	</div>
	<form class="user" method="post">
	    <div class="form-group row">
	        <div class="col-sm-6 mb-3 mb-sm-0">
	            <input type="email" class="form-control form-control-user" id="email" name="email" placeholder="e-mail" required>
	        </div>
	        <div class="col-sm-6">
	            <input type="password" class="form-control form-control-user" id="pswd" name="pswd" placeholder="Password" required>
	        </div>
	    </div>
	    <div class="form-group">
	        <input type="text" class="form-control form-control-user" id="nm" name="nm" placeholder="Nama Lengkap" required>
	    </div>
	    <div class="form-group row">
	        <div class="col-sm-6 mb-3 mb-sm-0">
	            <input type="text" class="form-control form-control-user"
	                id="tmptlhr" name="tmptlhr" placeholder="Tempat Lahir" required>
	        </div>
	        <div class="col-sm-6">
	            <input type="date" class="form-control form-control-user"
	                id="tgllhr" name="tgllhr" placeholder="Tanggal Lahir" required>
	        </div>
	    </div>
	    <div class="form-group row">
	        <div class="col-sm-6 mb-3 mb-sm-0">
	            <input type="text" class="form-control form-control-user"
	                id="krj" name="krj" placeholder="Pekerjaan" required>
	        </div>
	        <div class="col-sm-6">
	            <input type="text" class="form-control form-control-user"
	                id="hp" name="hp" placeholder="No.Hp/WA Aktif (awali dengan +62 diikuti nomor hp. cont.: +62813xxx)" required>
	        </div>
	    </div>
	    <div class="form-group row">
	        <div class="col-sm-6 mb-3 mb-sm-0">
	            <input type="number" class="form-control form-control-user" id="nik" name="nik" placeholder="NIK" required>
	        </div>
	        <div class="col-sm-6">
	            <input type="radio" name="jekel" value="Laki-laki">&nbsp;&nbsp;Laki-Laki&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	            <input type="radio" name="jekel" value="Perempuan">&nbsp;&nbsp;Perempuan
	        </div>
	    </div>

	    <div class="form-group">
	        <textarea class="form-control form-control-user" id="alamat" name="alamat" placeholder="Alamat" required></textarea>
	    </div>
	    <button type="submit" class="btn btn-primary btn-user btn-block" name="submit">Register Account</button>
	    <hr>
	</form>
	<hr>
	<div class="text-center">
	    <a class="small" href="login.php">Already have an account? Login!</a>
	</div>
</div>
</div>

</body>

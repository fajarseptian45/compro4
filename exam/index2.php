<?php
session_start();

if( !isset($_SESSION["login"]) ) {
    header("location: login.php");
    exit;
}

//koneksi db
require 'functions.php';
$id = $_SESSION["ido"];
//$idb = $_GET['id_balita'];

$balita = query("SELECT * FROM tb_balita WHERE id_ortu = $id");

// [0] untuk mengambil index array nya
$ortu = query("SELECT * FROM tb_ortu WHERE id_ortu = $id")[0];
//var_dump($ortu);

if(isset($_POST["submit"])){
    //cek arraynya ada apa ga?

    
    //cek data masuk atau engga
     if( ubah_ortu($_POST) > 0 ) {
         echo "
            <script>
                alert('Data Berhasil Diperbaharui!');
                document.location.href = 'index.php';
            </script>
         ";
     } else {
         echo "
            <script>
                alert('Data Gagal Diperbaharui!');
                document.location.href = 'index.php';
            </script>
         ";
     }
}

elseif(isset($_POST["simpan"])){
    //cek arraynya ada apa ga?

    
    //cek data masuk atau engga
     if( tambah_imun($_POST) > 0 ) {
         echo "
            <script>
                alert('Data Berhasil Diperbaharui!');
                document.location.href = 'index.php';
            </script>
         ";
     } else {
         echo "
            <script>
                alert('Data Gagal Diperbaharui!');
                document.location.href = 'index.php';
            </script>
         ";
     }

}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Data Orang Tua</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- modal -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <nav class="navbar bg-info">
  <div class="container-fluid">
    <span class="navbar-text">
      <p>
        <h3>Hallo Ibu <?= $_SESSION["nama"]; ?>, silahkan lakukan perubahan data berikut!</h3>Klik <a href="signout.php">Logout</a> untuk mengakhiri sesi Anda</p>
    </span>
  </div>
</nav>
</div>
<div class="container">
<hr>
<p>
<h2>Data Orang Tua</h2>
</p>
<hr>
</div>
<div class="container">
<form method="post">
  <div class="form-group row">
    <label for="nokk" class="col-sm-2 col-form-label">Nomor KK</label>
    <div class="col-sm-10">
      <input type="number" class="form-control" id="nokk" name="nokk" placeholder="Nomor KK" value="<?= $ortu["no_kk"]; ?>">
  	</div>
  </div>
  <div class="form-group row">
    <label for="nikayah" class="col-sm-2 col-form-label">NIK Ayah</label>
    <div class="col-sm-10">
      <input type="number" class="form-control" id="nikayah" name="nikayah" placeholder="NIK Ayah" value="<?= $ortu["nik_ayah"]; ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="nmayah" class="col-sm-2 col-form-label">Nama Ayah</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="nmayah" name="nmayah" placeholder="Nama Ayah" value="<?= $ortu["nm_ayah"]; ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="nikibu" class="col-sm-2 col-form-label">NIK Ibu</label>
    <div class="col-sm-10">
      <input type="number" class="form-control" id="nikibu" name="nikibu" placeholder="NIK Ibu" value="<?= $ortu["nik_ibu"]; ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="namaibu" class="col-sm-2 col-form-label">Nama Ibu</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="namaibu" name="namaibu" placeholder="Nama Ibu" value="<?= $ortu["nm_ibu"]; ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" value="<?= $ortu["alamat"]; ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="rt" class="col-sm-2 col-form-label">RT</label>
    <div class="col-sm-10">
    	<select name="rt" class="form-control">
    		<option value="<?= $ortu["rt"]; ?>"><?= $ortu["rt"]; ?></option>
    		<option value="006">006</option>
    		<option value="007">007</option>
    		<option value="008">008</option>
    	</select>
    </div>
  </div>
  <div class="form-group row">
    <label for="nohp" class="col-sm-2 col-form-label">Nomor HP Orang Tua</label>
    <div class="col-sm-10">
      <input type="number" class="form-control" id="nohp" name="nohp" placeholder="Nomor HP Orang Tua" value="<?= $ortu["no_hp"]; ?>">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-primary" name="submit" id="submit">Update Data Orang Tua</button>
    </div>
  </div>
</form>
</div>

<div class="container">
  <hr>
	<h2>Data Anak</h2>
  <hr>
	<table class="table table-striped table-hover">
  		<tr>
  			<td>NIK Anak</td>
  			<td>Nama Anak</td>
  			<td>Anak Ke</td>
  			<td>Tgl Lahir</td>
  			<td>BB Lahir</td>
  			<td>TB Lahir</td>
        <td>Action</td>
  		</tr>    
        <?php foreach ($balita as $row) : ?>
  		<tr>
  			<td><?= $row["nik_anak"]; ?></td>
  			<td><?= $row["nm_anak"]; ?></td>
  			<td><?= $row["anak_ke"]; ?></td>
  			<td><?= $row["tgl_lahir"]; ?></td>
  			<td><?= $row["bb_lahir"]; ?></td>
  			<td><?= $row["tb_lahir"]; ?></td>
  			<td>
          <button type="button" class="btn btn-warning"><a href="balita.php?id=<?= $row['id_balita']; ?>">Update</a></button>&nbsp;&nbsp;

          <button type="button" class="btn btn-warning"><a href="imunisasi.php?id=<?= $row['id_balita']; ?>">Imunisasi</a></button> 

  			</td>
  		</tr>                         
        <?php endforeach; ?>
	</table>
</div>
<footer><center>Copyright Posyandu Orchid 2022</center></footer>
</body>
</html>
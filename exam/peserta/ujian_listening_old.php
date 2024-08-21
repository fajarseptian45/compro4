<!DOCTYPE html>
<?php 
//if( !isset($_SESSION["login"]) ) {
  //  header("location: login.php");
    //exit;
//}

//koneksi db
require 'functions.php';
session_start();
login_validate();
login_check();

$tgl=date('Y-m-d');
$tipe = $_GET['tipe'];
$jenis = $_GET['jenis'];
$idj = $_GET['idj'];

$ujian = query("SELECT `id_ujian`, `id_jadwal`, `id_soal`, `jwbn_user`, `tgl_ujian` FROM `tb_ujian_sec1` WHERE id_jadwal = '$idj';");


$batas = 1;
$halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
$halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;	

$prev = $halaman - 1;
$next = $halaman + 1;

$data = mysqli_query($conn, "SELECT s.*, j.jenis, a.ket, a.audio, t.tipe FROM `tb_section1` s, 	tb_jenis j, tb_audio a, tb_tipe t WHERE s.id_jenis = j.id_jenis and s.id_audio = a.id_audio and s.id_tipe = t.id_tipe and j.jenis = '$jenis' and t.tipe='$tipe'");

$jumlah_data = mysqli_num_rows($data);
$total_halaman = ceil($jumlah_data / $batas);

//$soal = query("SELECT s.*, j.jenis, a.ket, a.audio FROM `tb_section1` s, tb_jenis j, tb_audio a WHERE s.id_jenis = j.id_jenis and s.id_audio = a.id_audio limit $halaman_awal, $batas");

$soal = query("SELECT s.*, j.jenis, t.tipe, a.ket, a.audio FROM `tb_section1` s, tb_jenis j, tb_tipe t, tb_audio a WHERE s.id_jenis = j.id_jenis and s.id_tipe = t.id_tipe and s.id_audio = a.id_audio and j.jenis = '$jenis' and t.tipe='$tipe' limit $halaman_awal, $batas");

$nomor = $halaman_awal+1;


if(isset($_POST['submit'])){
$cek    = "select id_soal from tb_ujian_sec1 where id_jadwal = '$idj' and id_soal = '".$_POST['ids']."'";
//die(print_r($cek));
$cek    = mysqli_query($conn, $cek);
$cek    = mysqli_fetch_array($cek);

if($cek)
{
  $idt = $cek['id_soal'];
  $simpan =  "UPDATE tb_ujian_sec1 SET jwbn_user = '".$_POST['jwbn']."' where id_soal = '$idt' and id_jadwal = '$idj'";
}
else
{
    $simpan = "INSERT INTO `tb_ujian_sec1`(`id_jadwal`, `id_soal`, `jwbn_user`, `tgl_ujian`) 
              VALUES('$idj', '".$_POST['ids']."', '".$_POST['jwbn']."', '$tgl')";
          
    //die($simpan);
    
} 
    $sukses = mysqli_query($conn, $simpan) or die();
    echo "
            <script>
                //alert('Data Berhasil Disimpan!');
                document.location.href='?idj=$idj&jenis=$jenis&tipe=$tipe&halaman=$next';
            </script>
         ";    
}

echo "
            <script>
                //alert('Data Berhasil Disimpan!');
                //document.location.href='?idj=$idj&jenis=$jenis&tipe=$tipe&halaman=$next';
            </script>
         ";
//exit;

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

<script type = "text/javascript" >
function preventBack(){window.history.forward();}
setTimeout("preventBack()", 0);
window.onunload=function(){null};
</script>

 <style>
    #time{
      color:#e99;
      font-size: 200%;
      font-weight: bold;
    }
  </style>

<script type="text/javascript">
    function start_timer(){
      var timer = document.getElementById("time").innerHTML;
      var arr = timer.split(":");
      var hour = arr[0];
      var min = arr[1];
      var sec = arr[2];
      if(sec == 0) {
        if(min == 0) {
          if(hour == 0) {
            //alert("Waktu Habis");
            setInterval( () => {
				<?php echo "window.location.href='?idj=$idj&jenis=$jenis&tipe=$tipe&halaman=$next'"; ?>
				}, 1000);
            //reload();
            //window.location.reload();
            return;
          }
          hour--;
          min = 60;
          if(hour < 10) hour = "0" + hour;
        }
        min--;
        if(min < 10) min = "0" + min;
        sec = 59;
      }
      else sec--;
      if (sec < 10) sec == "0" + sec;

      document.getElementById("time").innerHTML = hour + ":" + min + ":" + sec;
      setTimeout(start_timer, 1000);
    }
    
	function nonaktifkan(){
	   	window.onkeydown = function (e)
		{
	  		return false;
		}
	}

  </script>
</head>

<body onload="start_timer();">
 
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
      <div class="box">
        <span id="time">
          <img src="img/headersoal.png" width="100%" height="250px">
          00:00:05
        </span> 
      </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
        	<form method="post">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <tbody>
                <?php 
                if(empty($soal)) {
                    echo "
                          <script>
                              alert('Soal sudah Habis!');
                              document.location.href='jadwal_test.php';
                              exit;
                          </script>";
                } else {
                  ?>
                  <?php foreach ($soal as $row) : ?>
                    <tr>
                        <td colspan="2">
                        	<label><b>Soal No.<?php echo $nomor++; ?></b></label>
                          <input type="hidden" name="ids" value="<?= $row["id_soal"]; ?>">
                        </td>
                    </tr>
                    <tr>
                      <td>
                            <img src="img/audio.gif">
                            <audio autoplay>
                              <source src="audio/<?= $row["audio"]; ?>" type="audio/mpeg">
                            </audio>
                        <br><br>
                          <input type="radio" name="jwbn" value="A">&nbsp;A&nbsp;
                          <?= $row["jwbn1"]; ?><br>
                          <input type="radio" name="jwbn" value="B">&nbsp;B&nbsp; 
                          <?= $row["jwbn2"]; ?><br>
                          <input type="radio" name="jwbn" value="C">&nbsp;C&nbsp; 
                          <?= $row["jwbn3"]; ?><br>
                          <input type="radio" name="jwbn" value="D">&nbsp;D&nbsp; 
                          <?= $row["jwbn4"]; ?><br><br>
                          <button type="submit" class="btn btn-primary" name="submit">Jawab</button>
                      </td>          
                    </tr>       
                </tbody>
                <?php 
                endforeach;  
                } 
                ?>
            </table>
            </form>
            <nav>
              <ul class="pagination justify-content-center">
                <li class="page-item">
                  <a class="page-link" <?php if($halaman > 1){ echo "href='?idj=$idj&jenis=$jenis&tipe=$tipe&halaman=$prev'"; } ?>>Prev</a>
                </li>
                <?php 
                for($x=1;$x<=$total_halaman;$x++){
                  ?> 
                <li class="page-item"><a class="page-link" href="?idj=<?= $idj; ?>&jenis=<?= $jenis; ?>&tipe=<?= $tipe; ?>&halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
                <?php
                }
                ?>				
                <li class="page-item">
                  <a  class="page-link" <?php if($halaman < $total_halaman) { echo "href='?idj=$idj&jenis=$jenis&tipe=$tipe&halaman=$next'"; } ?>>Next</a>
                </li>
              </ul>
            </nav>


             
        </div>
    </div>

</div>
<div>
	Soal yang sudah terjawab:
	<table border="1">
	<tr>
        <td bgcolor="yellow">
        	<?php foreach ($ujian as $row) : ?>
        	<?= $row["id_soal"]; ?>
        	<?php endforeach; ?>
        </td>
    </tr>
    
    </table>
</div>

<script>
document.addEventListener("contextmenu", function(e){
    e.preventDefault();
}, false);
</script>

</body>
</html>
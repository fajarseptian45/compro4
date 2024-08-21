<?php 
error_reporting(E_ALL);

/* if( !isset($_SESSION["login"]) ) {
    header("location: login.php");
    exit;
} */

//koneksi db
require '../functions.php';
session_start();
login_validate();
login_check();

$tgl=date('Y-m-d');
$tipe = $_GET['tipe'];
$jenis = $_GET['jenis'];
$idj = $_GET['idj'];

/*
$ujian = mysqli_query($conn, "SELECT `id_jadwal` FROM `tb_ujian_sec2` WHERE id_jadwal = '$idj'");
$cekujian = mysqli_fetch_array($ujian);
$y = isset($cekujian['id_jadwal']) ? $cekujian['id_jadwal'] : '';
//$y = $cekujian['id_jadwal'];
if( $y === $idj){
  ?>
         <div class="alert alert-success" role="alert">
         Anda sudah ujian untuk section ini!
        </div>
        <?php
        header("location: jadwal_test.php");
} */

$batas = 1;
$halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
$halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;	

$prev = $halaman - 1;
$next = $halaman + 1;

$data = mysqli_query($conn,"SELECT s.*, j.jenis, t.tipe FROM `tb_section2` s, tb_jenis j, tb_tipe t WHERE s.id_jenis = j.id_jenis and s.id_tipe = t.id_tipe and j.jenis = '$jenis' and t.tipe='$tipe'");

$jumlah_data = mysqli_num_rows($data);
$total_halaman = ceil($jumlah_data / $batas);

$soal = query("SELECT s.*, j.jenis, t.tipe FROM `tb_section2` s, tb_jenis j, tb_tipe t WHERE s.id_jenis = j.id_jenis and s.id_tipe = t.id_tipe and j.jenis = '$jenis' and t.tipe='$tipe' limit $halaman_awal, $batas");

$nomor = $halaman_awal+1;


if(isset($_POST['submit']))
{
    $cek    = "select id_soal from tb_ujian_sec2 where id_jadwal = '$idj' and id_soal = '".$_POST['ids']."'";
    //die(print_r($cek));
    $cek    = mysqli_query($conn, $cek);
    $cek    = mysqli_fetch_array($cek);

    if($cek)
    {
      $idt = $cek['id_soal'];
      $simpan =  "UPDATE tb_ujian_sec2 SET jwbn_user = '".$_POST['jwbn']."' where id_soal = '$idt' and id_jadwal = '$idj'";
    }
    else
    {
        $simpan = "INSERT INTO `tb_ujian_sec2`(`id_jadwal`, `id_soal`, `jwbn_user`, `tgl_ujian`) 
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
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
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
  // Mendapatkan waktu sekarang
  let now = new Date("Apr 25, 2023 23:55:00");

  let countDownDate = new Date(now.getTime() + (1 * 60 * 60 * 1000));
  //var countDownDate = new Date(selisih).getTime();

  // Update the count down every 1 second
  var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();
    
  // Find the distance between now and the count down date
  var distance = countDownDate - now;
    
  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
  // Output the result in an element with id="demo"
  document.getElementById("time").innerHTML = hours + "h "
  + minutes + "m " + seconds + "s ";
    
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("time").innerHTML = "EXPIRED";
  }
}, 1000);
}


	function nonaktifkan(){
	   	window.onkeydown = function (e)
		{
	  		return false;
		}
	}

  </script>
</head>
<!-- <body onload="nonaktifkan();">-->
<body onload="start_timer();"> 
 <!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
    <?php
      if( $jenis === "TOEFL" ){
      ?>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <tr>
            <td>
              <img src="img/logo lembaga bahasa.png" width="150" height="150">
            </td>
            <td>
            <center><h3>SECTION 2</h3></center>
            <p>
              This section is designed to measure your ability to recognize language that is appropriate for standard written English. There are two types of questions in this section, with special directions for each type.
            </p>
            </td>
          </tr>
          <tr>
            <td colspan="2">
            <center><h3>Structure</h3></center>
              <p align="justify">
                  Directions:<br> These questions are incomplete sentences. Beneath each sentence you will see four words or phrases, marked (A), (B), (C), and (D). Choose the one word or phrase that best completes the sentence. Then, on your answer sheet, find the number of the question and fill in the space that corresponds to the letter of the answer you have chosen.
                  </p>
                  <pre>
                  Look at the following examples.
                  Example I
                  The president __ the election by a landslide.
                      (A) won
                      (B) he won
                      (C) yesterday
                      (D) fortunately

                  The sentence should read, "The president won the election by a landslide." Therefore, you should choose answer (A).

                  Example II
                  When __ the conference?
                      (A) the doctor attended
                      (B) did the doctor attend
                      (C) the doctor will attend
                      (D) the doctor's attendance

                  The sentence should read, "When did the doctor attend the conference?" Therefore, you should choose answer (B).
                  </pre>
                  <center><h3>Written Expression</h3></center>        

                  <p align="justify">
                  Directions:<br> 
                  In these questions, each sentence has four underlined words or phrases. The four underlined parts of the sentence are marked (A), (B), (C), and (D). Identify the one underlined word or phrase that must be changed in order for the sentence to be correct. Then, on your answer sheet. Find the number of the question and fill in the space that corresponds to the letter of the answer you have chosen.
                  </p>
                  </td>
            </tr>
        </table>
        <?php
      }
    else{
      ?>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <tr>
            <td width="15%">
              <img src="../img/logo lembaga bahasa.png" width="150" height="150">
            </td>
            <td>
            <center><h3>SECTION 2</h3></center>
            </td>
          </tr>
          <tr>
            <td colspan="2">
            <center><h3>Structure</h3></center>
              <p align="justify">
               Questions 1-18 are incomplete sentences. Below each sentence you will see 4 words or phrases marked A, B, C and D. Choose the 1 word or phrase that best completes the sentence.
              </p>
            
              <center><h3>Written Expression</h3></center>        
                <p align="justify">
                  Directions:<br> 
                  In questions 19–25, each sentence has 4 highlighted words or phrases. The 4 highlighted parts of the sentence are marked A, B, C and D. Identify the 1 highlighted word or phrase that must be changed in order for the sentence to be correct.
                </p>
              </td>
            </tr>
        </table>
        <?php  
    }
    ?>


    </div>
    <div class="card-body">
        <div class="table-responsive">
        	<form method="post">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <tbody>
                <?php 
                if(empty($soal)) {
                  ?>
                  <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Well done!</h4>
                    <p>Ujian Section ini telah selesai Anda kerjakan. Silahkan kerjakan Section lainnya jika masih ada.</p>
                    <hr>
                    <p class="mb-0"><a href="jadwal_test.php?token=<?= $_SESSION['token']; ?>">Klik disini untuk kembali ke Jadwal</a></p>
                  </div>

                <?php
                } else {
                  ?>
                  <?php foreach ($soal as $row) : ?>
                    <tr>
                        <td>
                        <span id="time">
                          <?php
                          if($jenis === "TOEFL"){
                            echo "00:00:38";
                          }
                          else{
                            echo "00:00:40";
                          }
                          ?>
                        </span> 
                        </td>
                    </tr>
                    <tr>					    
                        <td>
                        <label><b>Soal No.<?php echo $nomor++; ?></b></label>
                          <input type="hidden" name="ids" value="<?= $row["id_soal"]; ?>">
                          <br>
                          <?= $row["soal"]; ?><br><br>
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
            
        </div>
    </div>

</div>
<footer>
  <?php
  include("../footer.php");
  ?>
</footer>
<script>
document.addEventListener("contextmenu", function(e){
    e.preventDefault();
}, false);
</script>

</body>
</html>
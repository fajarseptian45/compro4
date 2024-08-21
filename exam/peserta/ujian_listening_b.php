<?php 
error_reporting(E_ALL);

/* if( !isset($_SESSION["login"]) ) {
    header("location: login.php");
    exit;
}  */

//koneksi db
require '../functions.php';
session_start();
login_validate();
login_check();

$tgl=date('Y-m-d');
$tipe = $_GET['tipe'];
$jenis = $_GET['jenis'];
$idj = $_GET['idj'];
$tglujian = $_GET['tglujian'];

/* $ujian = mysqli_query($conn, "SELECT `id_jadwal` FROM `tb_ujian_sec1_b` WHERE id_jadwal = '$idj'");
$cekujian = mysqli_fetch_array($ujian);
$y = isset($cekujian['id_jadwal']) ? $cekujian['id_jadwal'] : '';
//$y = $cekujian['id_jadwal'];
if( $y === $idj){
  echo "
            <script>
                alert('Anda sudah ujian untuk section ini!');
                document.location.href = 'jadwal_test.php';
                exit;
            </script>
         ";
} */

$batas = 1;
$halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
$halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;	

$prev = $halaman - 1;
$next = $halaman + 1;

//$data = mysqli_query($conn,"SELECT s.*, j.jenis, d.desk FROM `tb_section3` s, 	tb_jenis j, tb_section3_des d WHERE s.id_jenis = j.id_jenis and s.id_desk = d.id_desk");

$data = mysqli_query($conn, "SELECT s.*, j.jenis, a.ket, a.audio as 'soal', b.audio as 'conversation', t.tipe FROM `tb_section1_b` s, 	tb_jenis j, tb_audio a, tb_audio_b b, tb_tipe t WHERE s.id_jenis = j.id_jenis and s.id_audio = a.id_audio and b.id_conversation = s.id_conversation and s.id_tipe = t.id_tipe and j.jenis = '$jenis' and t.tipe='$tipe'");


$jumlah_data = mysqli_num_rows($data);
$total_halaman = ceil($jumlah_data / $batas);

$soal = query("SELECT s.*, j.jenis, a.ket, a.audio as 'soal', b.audio as 'conversation', t.tipe FROM `tb_section1_b` s, 	tb_jenis j, tb_audio a, tb_audio_b b, tb_tipe t WHERE s.id_jenis = j.id_jenis and s.id_audio = a.id_audio and b.id_conversation = s.id_conversation and s.id_tipe = t.id_tipe and j.jenis = '$jenis' and t.tipe='$tipe' limit $halaman_awal, $batas");

$nomor = $halaman_awal+1;


if(isset($_POST['submit'])){

$cek    = "select id_soal from tb_ujian_sec1_b where id_jadwal = '$idj' and id_soal = '".$_POST['ids']."'";

//die(print_r($cek));
$cek    = mysqli_query($conn, $cek);
$cek    = mysqli_fetch_array($cek);

if($cek)
{
  $idt = $cek['id_soal'];
  $simpan =  "UPDATE tb_ujian_sec1_b SET jwbn_user = '".$_POST['jwbn']."' where id_soal = '$idt' and id_jadwal = '$idj'";
}
else
{
    $simpan = "INSERT INTO `tb_ujian_sec1_b`(`id_jadwal`, `id_soal`, `jwbn_user`, `tgl_ujian`) 
              VALUES('$idj', '".$_POST['ids']."', '".$_POST['jwbn']."', '$tgl')";
          
    //die($simpan);
    
} 
    $sukses = mysqli_query($conn, $simpan) or die();
    echo "
            <script>
                //alert('Data Berhasil Disimpan!');
                document.location.href='?idj=$idj&jenis=$jenis&tipe=$tipe&tglujian=$tglujian&halaman=$next';
            </script>
         ";    
}

echo "
            <script>
                //alert('Data Berhasil Disimpan!');
                //document.location.href='?idj=$idj&jenis=$jenis&tipe=$tipe&tglujian=$tglujian&halaman=$next';
            </script>
         ";
//exit;

?>  

<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Listening Test Part B</title>
	
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
  //function timer dengan jquery 
  function start_timer(){
    // Mendapatkan waktu sekarang
    //let now = new Date("Apr 26, 2023 10:40:00");
    let wkt = new URLSearchParams(window.location.search).get("tglujian");
    let now = new Date(wkt);

    let countDownDate = new Date(now.getTime() + (1 * 60 * 60 * 1000));
    //let countDownDate = $.session.set("tanggal", today, { expires: 60 }); // 60 menit

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
<body onload="start_timer();">
<div class="card-body">
  
</div>
<div class="card shadow mb-4">
  
    <div class="card-header py-3">
      <?php
      if( $jenis === "TOEFL" ){
      ?>
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <tr>
              <td>
              <img src="../img/logo lembaga bahasa.png" width="150" height="150">
              </td>
              <td>
              <center><h3>SECTION 1</h3></center>
              <p align="justify">
                In this section of the test, you will have an opportunity to demonstrate your ability to understand conversations and talks in English. There are three parts to this section, with special directions for each part. Answer all the questions on the basis of what is stated or implied by the speakers you hear. Do not take notes or write in your test book at any time. Do not turn the pages until you are told to do so.
              </p>
              </td>
            </tr>
            <tr>
              <td colspan="2">
              <center><h3>PART B</h3></center>
                <p align="justify">
                Directions:<br>
                In this part of the test, you will hear longer conversations. After each conversation, you will hear several questions. The conversations and questions will not be repeated. After you hear a question, read the four possible answers in your test book and choose the best answer. Then, on your answer sheet, find the number of the question and fill in the space that corresponds to the letter of the answer you have chosen.<br>
                Remember, you are not allowed to take notes or write in your test book.
              </td>
            </tr>
          </table>
    
    <?php
      }
    else{
      ?>
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" border="0">
            <tr>
              <td>
              <img src="../img/logo lembaga bahasa.png" width="150" height="150">
              </td>
              <td>
              <center><h3>SECTION 1</h3></center>
                <p align="justify">
                  In the Listening Comprehension section of the test, you will have an opportunity to demonstrate your ability to understand spoken English. There are 3 parts to this section with special directions for each part. Answer all the questions on the basis of what is stated or implied by the speakers in this test.
                </p>
              </td>
            </tr>
            <tr>
              <td colspan="2">
              <p align="justify">
                  In the Listening Comprehension section of the test, you will have an opportunity to demonstrate your ability to understand spoken English. There are 3 parts to this section with special directions for each part. Answer all the questions on the basis of what is stated or implied by the speakers in this test.
                </p>
              <center><h4>Part B (17-30)</h4></center>
              Directions:<br>
              <p>
                In Part B you will hear short conversations between 2 people. After each conversation, you will hear a question about what was said. You will hear each conversation and question only 1 time. 
                After you hear a conversation and the question about it, read the 4 possible answers on the screen and select the best answer by clicking on it.
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
                        	<label><b>Soal No.<?php echo $nomor++; ?></b></label>
                        </td>
                        <td>
                        <span id="time">
                          <?php
                          if($jenis === "TOEFL"){
                            echo "00:01:00";
                          }
                          else{
                            echo "00:01:00";
                          }
                          ?>
                        </span> 
                        </td>
                    </tr>
                    <tr>
                    	<td width="50%">
                        	<input type="hidden" name="ids" value="<?= $row["id_soal"]; ?>">
                          <img src="../img/audio.gif">
                              <audio id="audio1" src="../audio/<?= $row["conversation"]; ?>" type="audio/mpeg" autoplay></audio>
                              <audio id="audio2" src="../audio/<?= $row["soal"]; ?>" type="audio/mpeg"></audio>
                            <script>
                                var audioIndex = 0;
                                var audioList = document.getElementsByTagName("audio");

                                function playNextAudio() {
                                audioList[audioIndex].pause();
                                audioIndex = (audioIndex + 1) % audioList.length;
                                audioList[audioIndex].play();
                                }

                                // panggil fungsi playNextAudio setiap kali audio saat ini selesai dimainkan
                                audioList[audioIndex].addEventListener("ended", playNextAudio);
                            </script>
                            
                        <br><br>
					    </td>
					    <td width="50%">
                            
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
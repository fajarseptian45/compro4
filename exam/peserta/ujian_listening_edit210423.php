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

$ujian = mysqli_query($conn, "SELECT a.`id_jadwal` as 'idja', b.id_jadwal as 'idjb' FROM tb_ujian_sec1 a, `tb_ujian_sec1_b` b WHERE a.id_jadwal = '$idj'");
$cekujian = mysqli_fetch_array($ujian);
$y = isset($cekujian['idja']) ? $cekujian['idja'] : '';
//$y = $cekujian['id_jadwal'];
if( $y === $idj){
   echo "
            <script>
                alert('Anda sudah ujian untuk section ini!');
                document.location.href = 'jadwal_test.php';
                exit;
            </script>
         "; 
         /* ?>
         <div class="alert alert-success" role="alert">
         Anda sudah ujian untuk section ini!
        </div>
        <?php
        header("location: jadwal_test.php"); */
}

$batas = 1;
$halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
$halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;	

$prev = $halaman - 1;
$next = $halaman + 1;

//$data = mysqli_query($conn,"SELECT s.*, j.jenis, d.desk FROM `tb_section3` s, 	tb_jenis j, tb_section3_des d WHERE s.id_jenis = j.id_jenis and s.id_desk = d.id_desk");

$data = mysqli_query($conn, "SELECT s.*, j.jenis, a.ket, a.audio, t.tipe FROM `tb_section1` s, 	tb_jenis j, tb_audio a, tb_tipe t WHERE s.id_jenis = j.id_jenis and s.id_audio = a.id_audio and s.id_tipe = t.id_tipe and j.jenis = '$jenis' and t.tipe='$tipe'");


$jumlah_data = mysqli_num_rows($data);
$total_halaman = ceil($jumlah_data / $batas);

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
	<title>Listening Test</title>
	
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
                <center><h3>PART A</h3></center>
                <p align="justify">
                Directions: <br>
                In Part A you will hear short conversations between two people. After each conversation, you will hear a question about the conversation. The conversations and questions will not be repeated. After you hear a question, read the four possible answers in your test book and choose the best answer. Then, on your answer sheet, find the number of the question and fill in the space that corresponds to the letter of the answer you have chosen.
                <pre>
                Listen to an example. 
                On the recording, you will hear:
                (Man) 	: That exam was just awful.
                (Woman) 	: Oh, it could have been worse.
                (Narrator) 	: What does the woman mean?
                In your test book, you will read: 	(A) The exam was really awful.
                                                    (B) It was the worst exam she had ever seen.
                                                    (C) It couldn't have been more difficult.
                                                    (D) It wasn't that hard.
                You learn from the conversation that the man thought the exam was very difficult and that the woman disagreed with the man. 
                The best answer to the question, “What does the woman mean?" is (D), "It wasn't that hard.” Therefore, the correct choice is (D).
                </pre>
                </p>
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
              <img src="img/logo lembaga bahasa.png" width="150" height="150">
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
              <center><h4>Part A (Number 1-16)</h4></center>
              Directions:<br>
              <p>
                each question in Part A, you will hear a short sentence. The sentence will be spoken just one time. The sentences you hear will not be written out for you. After you hear each sentence, read the 4 choices on the screen and decide which 1 is closest in meaning to the sentence you heard. Then select the best answer by clicking on it.
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
                    <p class="mb-0"><a href="ujian_listening_b.php?token=<?= $_SESSION['token']; ?>&idj=<?= $idj; ?>&jenis=<?= $jenis ?>&tipe=<?= $tipe ?>">Klik disini untuk melanjutkan Part B!</a></p>
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
                            <audio autoplay>
                              <source src="../audio/<?= $row["audio"]; ?>" type="audio/mpeg">
                            </audio>
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
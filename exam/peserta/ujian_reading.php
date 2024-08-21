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
$tglujian = $_GET['tglujian'];


/* $ujian = mysqli_query($conn, "SELECT `id_jadwal`, tgl_ujian FROM `tb_ujian` WHERE id_jadwal = '$idj' and tgl_ujian = '$tgl'");
$cekujian = mysqli_fetch_array($ujian);
$y = isset($cekujian['id_jadwal']) ? $cekujian['id_jadwal'] : '';
$z = isset($cekujian['tgl_ujian']) ? $cekujian['tgl_ujian'] : '';
//$y = $cekujian['id_jadwal'];
if( ($y === $idj) && ($z === $tgl) ){
  echo "
      <script>
        alert('Anda sudah mengikuti ujian!');
        document.location.href = 'jadwal_test.php';
      </script>";
}  */

$batas = 1;
$halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
$halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;	

$prev = $halaman - 1;
$next = $halaman + 1;

//$data = mysqli_query($conn,"SELECT s.*, j.jenis, d.desk FROM `tb_section3` s, 	tb_jenis j, tb_section3_des d WHERE s.id_jenis = j.id_jenis and s.id_desk = d.id_desk");

$data = mysqli_query($conn,"SELECT s.*, j.jenis, d.desk, t.tipe FROM `tb_section3` s, tb_jenis j, tb_section3_des d, tb_tipe t WHERE s.id_jenis = j.id_jenis and s.id_desk = d.id_desk and s.id_tipe = t.id_tipe and j.jenis = '$jenis' and t.tipe='$tipe'");

$jumlah_data = mysqli_num_rows($data);
$total_halaman = ceil($jumlah_data / $batas);

$soal = query("SELECT s.*, j.jenis, d.desk, t.tipe FROM `tb_section3` s, tb_jenis j, tb_section3_des d, tb_tipe t WHERE s.id_jenis = j.id_jenis and s.id_desk = d.id_desk and s.id_tipe = t.id_tipe and j.jenis = '$jenis' and t.tipe='$tipe' limit $halaman_awal, $batas");

$nomor = $halaman_awal+1;


if(isset($_POST['submit'])){
$cek    = "select id_soal from tb_ujian where id_jadwal = '$idj' and id_soal = '".$_POST['ids']."'";

//die(print_r($cek));
$cek    = mysqli_query($conn, $cek);
$cek    = mysqli_fetch_array($cek);

if($cek)
{
  $idt = $cek['id_soal'];
  $simpan =  "UPDATE tb_ujian SET jwbn_user = '".$_POST['jwbn']."' where id_soal = '$idt' and id_jadwal = '$idj'";
}
else
{
    $simpan = "INSERT INTO `tb_ujian`(`id_jadwal`, `id_soal`, `jwbn_user`, `tgl_ujian`) 
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
	<title>Reading Test</title>
	
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
      color:red;
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

    let countDownDate = new Date(now.getTime() + (1 * 60 * 55 * 1000));
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
    document.getElementById("time").innerHTML = "Waktu Ujian: " + "0" + + hours + " : "
    + minutes + " : " + seconds;
      
    // If the count down is over, write some text 
    if (distance < 0) {
      clearInterval(x);
      //document.getElementById("time").innerHTML = "EXPIRED";
      alert('Waktu Habis!');
      document.location.href='jadwal_test.php';
      exit;
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

<div class="card shadow mb-4">
    <div class="card-header py-3">
    <?php
      if( $jenis === "TOEFL" ){
      ?>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <tr>
              <td>
              <img src="../img/logo lembaga bahasa.png" width="150" height="120">
              </td>
              <td>
              <center><h3>SECTION 3</h3></center>  
              <p align="justify">
              This section is designed to measure your ability to read and understand short passages similar in topic and style to those that students are likely to encounter in universities and colleges. This section contains reading passages and questions about the passages.
              </p>
              </td>
            </tr>
            <tr>
              <td colspan="2">
              <p align="justify">
              Directions: <br>In this section you will read several passages. Each one is followed by a number of questions about it. You are to choose the one best answer, (A), (B), (C), or (0), to each question. Answer all questions about the information in a passage on the basis of what is stated or implied in that passage.
              </p>
              <pre>
              <b>Read the following passage:</b>
                  John Quincy Adams, who served as the sixth president of the United States from 1825 to 
                  1829, is today recognized for his masterful statesmanship and diplomacy. He dedicated his 
                  life to public service, both in the presidency and in the various other political offices that 
                  he held. Throughout his political career, he demonstrated his unswerving belief in freedom 
          Line 5  of speech, the antislavery cause, and the right of Americans to be free from European and 
                  Asian domination.

              <b>Example I</b>
              To what did John Quincy Adams devote his life?
                  (A) Improving his personal life
                  (B) Serving the public
                  (C) Increasing his fortune
                  (D) Working on his private business

              According to the passage, John Quincy Adams "dedicated his life to public service." Therefore, you should choose answer (B).

              <b>Example II</b>
              In line 4, the word "unswerving" is closest in meaning to
                  (A) moveable
                  (B) insignificant
                  (C) unchanging
                  (D) diplomatic

              The passage states that John Quincy Adams demonstrated his unswerving belief "throughout his career." This implies that the belief did not change. 
              Therefore, you should choose answer (C). The sentence should read, "When did the doctor attend the conference?" Therefore, you should choose answer (B).
              </pre>
              </td>
            </tr>
        </table>
    <?php
      }
    else{
      ?>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <tr>
              <td width="10%">
              <img src="../img/logo lembaga bahasa.png" width="150" height="120">
              </td>
              <td >
              <center><h3>SECTION 3</h3></center>  
              </td>
            </tr>
            <tr>
              <td colspan="2">
              <center><h4>Part 1 (1-17)</h4></center>
              <p align="justify">
                Directions: <br>
                Each sentence has a highlighted word or phrase. Below each sentence are 4 other words or phrases, marked A, B, C or D. Choose the 1 word or phrase that best keeps the meaning of the original sentence if it is substituted for the underlined word or phrase.
            </p>
            <center><h4>Part 2 (18-40)</h4></center>
              <p align="justify">
                Directions: <br>
                In this section you will read several passages. Each 1 is followed by several questions. You are able to choose the 1 best answer, A, B, C or D, to each question. Answer all questions about the information in a passage based on what is stated or implied in that passage.
            </p>
              </td>
            </tr>
        </table>
        <?php  
    }
    ?>
       
    </div>
    <div class="card-body">
    <center><span id="time"></span></center>
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
                        <td colspan="2">
                        	<label><b>Soal No.<?php echo $nomor++; ?></b></label>                          
                        </td>
                        
                    </tr>
                    <tr>
                    	<td width="60%">
                        	<input type="hidden" name="ids" value="<?= $row["id_soal"]; ?>">
					    	<p><?= $row["desk"]; ?></p>
					    </td>
					    <td width="40%">
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
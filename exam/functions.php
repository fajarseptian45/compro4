<?php 
error_reporting(E_ALL);

// koneksidb
$conn = mysqli_connect("localhost", "itechac1_lembagabahasa", "t@ny@bus4nt1", "itechac1_ujol");
//$conn = mysqli_connect("localhost", "root", "", "dbujol");
// script cek koneksi
if (!$conn) {
    die("Koneksi Tidak Berhasil: " . mysqli_connect_error());
}

function query($query) {
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while ( $row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}

	return $rows;
}

function tambah_soal_sec1($data){
	global $conn;
	//htmlspecialchars berfungsi untuk menghindari pemasukan data yang mengandung HTML
	$idj = htmlspecialchars($data["idj"]);
	$tipe = htmlspecialchars($data["tipe"]);
	$ida = htmlspecialchars($data["ida"]);
	$j1 = htmlspecialchars($data["jwb1"]);
	$j2 = htmlspecialchars($data["jwb2"]);
	$j3 = htmlspecialchars($data["jwb3"]);
	$j4 = htmlspecialchars($data["jwb4"]);
	$k = htmlspecialchars($data["kunci"]);

	$query = 	"INSERT INTO `tb_section1`(`id_jenis`, `id_audio`, `jwbn1`, `jwbn2`, `jwbn3`, `jwbn4`, `status`, `kunci`, id_tipe) 
				VALUES('$idj', '$ida', '$j1', '$j2', '$j3', '$j4', 'ON','$k', '$tipe')";

    mysqli_query($conn, $query);
    //print_r($query);

    return mysqli_affected_rows($conn);
}

function tambah_soal_sec1_b($data){
	global $conn;
	//htmlspecialchars berfungsi untuk menghindari pemasukan data yang mengandung HTML
	$idj = htmlspecialchars($data["idj"]);
	$tipe = htmlspecialchars($data["tipe"]);
	$ida = htmlspecialchars($data["ida"]);
	$idc = htmlspecialchars($data["idc"]);
	$j1 = htmlspecialchars($data["jwb1"]);
	$j2 = htmlspecialchars($data["jwb2"]);
	$j3 = htmlspecialchars($data["jwb3"]);
	$j4 = htmlspecialchars($data["jwb4"]);
	$k = htmlspecialchars($data["kunci"]);

	$query = 	"INSERT INTO `tb_section1_b`(`id_jenis`, `id_audio`, id_conversation, `jwbn1`, `jwbn2`, `jwbn3`, `jwbn4`, `status`, `kunci`, id_tipe) 
				VALUES('$idj', '$ida', '$idc', '$j1', '$j2', '$j3', '$j4', 'ON','$k', '$tipe')";

    mysqli_query($conn, $query);
    //print_r($query);

    return mysqli_affected_rows($conn);
}

function tambah_soal_sec2($data){
	global $conn;
	//htmlspecialchars berfungsi untuk menghindari pemasukan data yang mengandung HTML
	$idj = htmlspecialchars($data["idj"]);
	$tipe = htmlspecialchars($data["tipe"]);
	$soal = addslashes($data["soal"]);
	$j1 = htmlspecialchars($data["jwb1"]);
	$j2 = htmlspecialchars($data["jwb2"]);
	$j3 = htmlspecialchars($data["jwb3"]);
	$j4 = htmlspecialchars($data["jwb4"]);
	$k =  htmlspecialchars($data["kunci"]);


	$query = 	"INSERT INTO `tb_section2`(`id_jenis`, `soal`, `jwbn1`, `jwbn2`, `jwbn3`, `jwbn4`, `status`, kunci, id_tipe) 
				VALUES('$idj', '$soal', '$j1', '$j2', '$j3', '$j4', 'ON', '$k','$tipe')";

    mysqli_query($conn, $query);
    //print_r($query);

    return mysqli_affected_rows($conn);
}

function tambah_soal_sec3($data){
	global $conn;
	//htmlspecialchars berfungsi untuk menghindari pemasukan data yang mengandung HTML
	$idj = htmlspecialchars($data["idj"]);
	$tipe = htmlspecialchars($data["tipe"]);
	$iddes = htmlspecialchars($data["iddes"]);
	$soal = addslashes($data["soal"]);
	$j1 = htmlspecialchars($data["jwb1"]);
	$j2 = htmlspecialchars($data["jwb2"]);
	$j3 = htmlspecialchars($data["jwb3"]);
	$j4 = htmlspecialchars($data["jwb4"]);
	$k = htmlspecialchars($data["kunci"]);

	$query = 	"INSERT INTO `tb_section3`(`id_jenis`, `id_desk`, `soal`, `jwbn1`, `jwbn2`, `jwbn3`, `jwbn4`, `status`, kunci, id_tipe) 
				VALUES('$idj', '$iddes', '$soal', '$j1', '$j2', '$j3', '$j4', 'ON', '$k', '$tipe')";

    mysqli_query($conn, $query);
    //print_r($query);

    return mysqli_affected_rows($conn);
}

function tambah_desk($data){
	global $conn;
	//htmlspecialchars berfungsi untuk menghindari pemasukan data yang mengandung HTML
	$d = addslashes($data["desk"]);

	$query = 	"INSERT INTO tb_section3_des(desk) 
				VALUES('$d')";

    mysqli_query($conn, $query);
    print_r($query);

    return mysqli_affected_rows($conn);
}

function registrasi($data){
	global $conn;
	//htmlspecialchars berfungsi untuk menghindari pemasukan data yang mengandung HTML
	$e = htmlspecialchars($data["email"]);
	$p = mysqli_real_escape_string($conn, $data["pswd"]);
	$n = htmlspecialchars($data["nm"]);
	$tl = htmlspecialchars($data["tmptlhr"]);
	$tg = htmlspecialchars($data["tgllhr"]);
	$k = htmlspecialchars($data["krj"]);
	$h = htmlspecialchars($data["hp"]);
	$nik = htmlspecialchars($data["nik"]);
	$j = htmlspecialchars($data["jekel"]);
	$a = htmlspecialchars($data["alamat"]);

	//cek username ganda
	$result = mysqli_query($conn, "SELECT email FROM tb_peserta WHERE email = '$e'");
	if ( mysqli_fetch_assoc($result)) {
		?>
			<div class="alert alert-success" role="alert">
			Username sudah terdaftar, silahkan gunakan username yang lain!
			</div>
		<?php
		return false;
	}

		//enkripsi password
	$p = password_hash($p, PASSWORD_DEFAULT);
	//var_dump($password); die;

	$query = 	"INSERT INTO `tb_peserta`(`email`, `password`, `role`, `nm_user`, `tgl_lhr`, `tmpt_lhr`, `jekel`, `pekerjaan`, `hp`, `nik`, `alamat`)  
				VALUES('$e', '$p', 'peserta', '$n', '$tg', '$tl', '$j', '$k', '$h', '$nik', '$a')";

    mysqli_query($conn, $query);
    //print_r($query);

    return mysqli_affected_rows($conn);
}

function jawab_soal($data){
	global $conn;
	//htmlspecialchars berfungsi untuk menghindari pemasukan data yang mengandung HTML
	//$idu = htmlspecialchars($data["iduser"]);
	$ids = htmlspecialchars($data["ids"]);
	$j = htmlspecialchars($data["jwbn"]);
	$tgl=date('Y-m-d');
	
	$query = 	"INSERT INTO `tb_ujian`(id_user, id_soal, jwbn_user, tgl_ujian) 
				VALUES('1', '$ids', '$j', '$tgl')";

    mysqli_query($conn, $query);
    //print_r($query);

    return mysqli_affected_rows($conn);
}


function login_validate() {
	$timeout = 5;
	$_SESSION["expires_by"] = time() + $timeout;
}


function login_check() {
	$exp_time = $_SESSION["expires_by"];
	if (time() < $exp_time) {
		login_validate();
	 	return true;
	} else {
	 	unset($_SESSION["expires_by"]);
		return false;
	}
}

function upload_audio($data){
	global $conn;
	//htmlspecialchars berfungsi untuk menghindari pemasukan data yang mengandung HTML
	$ket = htmlspecialchars($data["ket"]);
	
	// upload gambar
	$gambar = upload();
	if( !$gambar ) {
		return false;
	}


	$query = 	"INSERT INTO `tb_audio`(ket, audio) 
				VALUES('$ket', '$gambar')";

    mysqli_query($conn, $query);
    //print_r($query);

    return mysqli_affected_rows($conn);
}


function upload() {

	$namaFile = $_FILES['audio']['name'];
	$ukuranFile = $_FILES['audio']['size'];
	$error = $_FILES['audio']['error'];
	$tmpName = $_FILES['audio']['tmp_name'];

	// cek apakah tidak ada file yg diupload
	if( $error === 4 ) {
		?>
			<div class="alert alert-success" role="alert">
				Audio Belum Dipilih!
			</div>
		<?php 
		return false;
	}

	// cek file yang di uplo4d
	$ekstensiGambarValid = ['mp3'];
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));
	if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
		?>
			<div class="alert alert-success" role="alert">
				File yang diupload bukan Mp3!
			</div>
		<?php 
		return false;
	}

	// jika ukuran terlalu besar
	if( $ukuranFile > 50000000 ) {
		?>
			<div class="alert alert-success" role="alert">
				Ukuran file audio terlalu besar!
			</div>
		<?php 
		return false;	
	}

	// lolos pengecekan gambar siap di upload
	// generate mana baru untuk gambar yang di upload
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiGambar;
	move_uploaded_file($tmpName, '../audio/' . $namaFileBaru);
	return $namaFileBaru;

}

function upload_audio_b($data){
	global $conn;
	//htmlspecialchars berfungsi untuk menghindari pemasukan data yang mengandung HTML
	$ket = htmlspecialchars($data["ket"]);
	
	// upload gambar
	$gambar = upload_conv();
	if( !$gambar ) {
		return false;
	}


	$query = 	"INSERT INTO `tb_audio_b`(ket, audio) 
				VALUES('$ket', '$gambar')";

    mysqli_query($conn, $query);
    //print_r($query);

    return mysqli_affected_rows($conn);
}


function upload_conv() {

	$namaFile = $_FILES['audio']['name'];
	$ukuranFile = $_FILES['audio']['size'];
	$error = $_FILES['audio']['error'];
	$tmpName = $_FILES['audio']['tmp_name'];

	// cek apakah tidak ada file yg diupload
	if( $error === 4 ) {
		?>
			<div class="alert alert-success" role="alert">
			Audio belum dipilih!
			</div>
		<?php
		return false;
	}

	// cek file yang di uplo4d
	$ekstensiGambarValid = ['mp3'];
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));
	if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
		?>
			<div class="alert alert-success" role="alert">
			File yang diupload bukan Mp3!
			</div>
		<?php
		return false;
	}

	// jika ukuran terlalu besar
	if( $ukuranFile > 50000000 ) {
		?>
			<div class="alert alert-success" role="alert">
			Ukuran file audio terlalu besar!
			</div>
		<?php
		return false;	
	}

	// lolos pengecekan gambar siap di upload
	// generate mana baru untuk gambar yang di upload
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiGambar;
	move_uploaded_file($tmpName, '../audio/' . $namaFileBaru);
	return $namaFileBaru;

}


function daftar_ujian($data){
	global $conn;
	//htmlspecialchars berfungsi untuk menghindari pemasukan data yang mengandung HTML
	$jenis = htmlspecialchars($data["jepel"]);
	$tgltrans = htmlspecialchars($data["tgltrans"]);
	$bank = htmlspecialchars($data["bank"]);
	$pemilik = htmlspecialchars($data["pemilik"]);
	$idu = $_SESSION["iduser"];	
	$tgld = date('Y-m-d');

	// upload gambar
	$gambar = upload_bukti();
	if( !$gambar ) {
		return false;
	}


	$query = 	"INSERT INTO `tb_pendaftaran`(`jenis_test`, `bukti_transfer`, `tgl_transfer`, `nm_bank`, `nm_pemilik_rek`, `tgl_daftar`, `id_user`) 
				VALUES('$jenis', '$gambar', '$tgltrans', '$bank', '$pemilik', '$tgld', '$idu')";

    mysqli_query($conn, $query);
    //print_r($query);

    return mysqli_affected_rows($conn);
}

function upload_bukti() {

	$namaFile = $_FILES['gambar']['name'];
	$ukuranFile = $_FILES['gambar']['size'];
	$error = $_FILES['gambar']['error'];
	$tmpName = $_FILES['gambar']['tmp_name'];

	// cek apakah tidak ada file yg diupload
	if( $error === 4 ) {
		?>
			<div class="alert alert-success" role="alert">
			Gambar belum dipilih!
			</div>
		<?php
		return false;
	}

	// cek file yang di uplo4d
	$ekstensiGambarValid = ['jpg','jpeg','png','pdf'];
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));
	if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
		?>
			<div class="alert alert-success" role="alert">
			File yang dipilih bukan Image!
			</div>
		<?php
		return false;
	}

	// jika ukuran terlalu besar
	if( $ukuranFile > 3000000 ) {
		?>
			<div class="alert alert-success" role="alert">
			Ukuran file gambar terlalu besar!
			</div>
		<?php
		return false;	
	}

	// lolos pengecekan gambar siap di upload
	// generate mana baru untuk gambar yang di upload
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiGambar;
	move_uploaded_file($tmpName, '../img/' . $namaFileBaru);
	return $namaFileBaru;

}


function ubah_status($data){
	global $conn;
	$id = $_GET['id'];
	
	$query = "DELETE FROM tb_pendaftaran WHERE id_daftar = $id";

    mysqli_query($conn, $query);
    //print_r($query);

    return mysqli_affected_rows($conn);

}

function penjadwalan_ujian($data){
	global $conn;
	//htmlspecialchars berfungsi untuk menghindari pemasukan data yang mengandung HTML
	//$idu = htmlspecialchars($data["iduser"]);
	$idp = htmlspecialchars($data["idp"]);
	$tglujian = htmlspecialchars($data["tglujian"]);
	$zoom = htmlspecialchars($data["zoom"]);
	$lokasi = htmlspecialchars($data["lokasi"]);
	$wktujian = htmlspecialchars($data["wktujian"]);
	$soal1 = htmlspecialchars($data["tipesoal"]);
	$soal2 = htmlspecialchars($data["tipesoal2"]);
	$soal3 = htmlspecialchars($data["tipesoal3"]);
	
	$query = 	"INSERT INTO `tb_jadwal`(`id_daftar`, `tgl_ujian`, `link_zoom`, `tipe_ujian`, wkt_ujian, soal_sec1, soal_sec2, soal_sec3) 
				VALUES('$idp', '$tglujian', '$zoom', '$lokasi', '$wktujian', '$soal1', '$soal2', '$soal3')";

    mysqli_query($conn, $query);
    //print_r($query);

	$query2 = "update tb_pendaftaran set status = 'Dijadwalkan' where id_daftar = '$idp'";

	mysqli_query($conn, $query2);

    return mysqli_affected_rows($conn);
}

function hapus_soal1($id){
	global $conn;
	mysqli_query($conn, "DELETE FROM tb_section1 where id_soal = $id");

	return mysqli_affected_rows($conn);
}

function hapus_soal1_b($id){
	global $conn;
	mysqli_query($conn, "DELETE FROM tb_section1_b where id_soal = $id");

	return mysqli_affected_rows($conn);
}


function hapus_soal2($id){
	global $conn;
	mysqli_query($conn, "DELETE FROM tb_section2 where id_soal = $id");

	return mysqli_affected_rows($conn);
}

function hapus_soal3($id){
	global $conn;
	mysqli_query($conn, "DELETE FROM tb_section3 where id_soal = $id");

	return mysqli_affected_rows($conn);
}

function hapus_desk($id){
	global $conn;
	mysqli_query($conn, "DELETE FROM tb_section3_des where id_desk = $id");

	return mysqli_affected_rows($conn);
}

function hapus_audio($id){
	global $conn;
	mysqli_query($conn, "DELETE FROM tb_audio where id_audio = $id");
	
	return mysqli_affected_rows($conn);
}

function hapus_audio_b($id){
	global $conn;
	mysqli_query($conn, "DELETE FROM tb_audio_b where id_conversation = $id");
	
	return mysqli_affected_rows($conn);
}

function hapus_peserta($id){
	global $conn;
	mysqli_query($conn, "DELETE FROM tb_peserta where id_user = $id");
	
	return mysqli_affected_rows($conn);
}


function ubah_profile($data){
	global $conn;
	$idu = $data["idu"];
	$e = htmlspecialchars($data["email"]);
	//$p = mysqli_real_escape_string($conn, $data["pswd"]);
	$n = htmlspecialchars($data["nm"]);
	$tl = htmlspecialchars($data["tmptlhr"]);
	$tg = htmlspecialchars($data["tgllhr"]);
	$k = htmlspecialchars($data["krj"]);
	$h = htmlspecialchars($data["hp"]);
	$nik = htmlspecialchars($data["nik"]);
	$j = htmlspecialchars($data["jekel"]);
	$a = htmlspecialchars($data["alamat"]);

    $query = "UPDATE `tb_peserta` SET `email`='$e',`nm_user`='$n',`tgl_lhr`='$tg',`tmpt_lhr`='$tl',`jekel`='$j',`pekerjaan`='$k',`hp`='$h',`nik`='$nik',`alamat`='$a' WHERE `id_user` = '$idu'";

    mysqli_query($conn, $query);
    //print_r($query);

    return mysqli_affected_rows($conn);
}

function ubah_soal_sec3($data){
	global $conn;
	$id = $data["ids"];
	$idj = htmlspecialchars($data["idj"]);
	$tipe = htmlspecialchars($data["tipe"]);
	$iddes = htmlspecialchars($data["iddes"]);
	$soal = addslashes($data["soal"]);
	$j1 = htmlspecialchars($data["jwb1"]);
	$j2 = htmlspecialchars($data["jwb2"]);
	$j3 = htmlspecialchars($data["jwb3"]);
	$j4 = htmlspecialchars($data["jwb4"]);
	$k = htmlspecialchars($data["kunci"]);

    $query = 	"UPDATE `tb_section3` 
				SET `id_jenis`='$idj',
					`id_desk`='$iddes',
					`soal`='$soal',
					`jwbn1`='$j1',
					`jwbn2`='$j2',
					`jwbn3`='$j3',
					`jwbn4`='$j4',
					`kunci`='$k',
					`id_tipe`='$tipe' 
				WHERE id_soal = '$id'
    		  ";

    mysqli_query($conn, $query);
    //print_r($query);

    return mysqli_affected_rows($conn);
}

function ubah_soal_sec2($data){
	global $conn;
	$id = $data["ids"];
	$idj = htmlspecialchars($data["idj"]);
	$tipe = htmlspecialchars($data["tipe"]);
	$soal = addslashes($data["soal"]);
	$j1 = htmlspecialchars($data["jwb1"]);
	$j2 = htmlspecialchars($data["jwb2"]);
	$j3 = htmlspecialchars($data["jwb3"]);
	$j4 = htmlspecialchars($data["jwb4"]);
	$k =  htmlspecialchars($data["kunci"]);

    $query = 	"UPDATE `tb_section2` 
				SET `id_jenis`='$idj',
					`soal`='$soal',
					`jwbn1`='$j1',
					`jwbn2`='$j2',
					`jwbn3`='$j3',
					`jwbn4`='$j4',
					`kunci`='$k',
					`id_tipe`='$tipe' 
				WHERE id_soal = '$id'
    		  ";

    mysqli_query($conn, $query);
    //print_r($query);

    return mysqli_affected_rows($conn);
}

function ubah_password($data){
	global $conn;
	$idu = $_SESSION["iduser"];
	$p2 = mysqli_real_escape_string($conn, $data["ps2"]);
	$p3 = mysqli_real_escape_string($conn, $data["ps3"]);	
	
	//cek kesamaan password
	if( $p2 !== $p3 ){
		echo 	"<script>
					alert('Confirm Password is not match!')
				</script>";
		return false;
	}

		//enkripsi password
	$p = password_hash($p2, PASSWORD_DEFAULT);
	//var_dump($password); die;

	$query = 	"UPDATE tb_peserta SET
					`password`= '$p'
					WHERE id_user = $idu";

	mysqli_query($conn, $query);
	//print_r($query);

	return mysqli_affected_rows($conn);

}

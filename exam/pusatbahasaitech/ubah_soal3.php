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

$id = $_GET['ids'];

$soal3 = query("SELECT s.*, j.jenis, d.desk, t.* FROM `tb_section3` s, tb_jenis j, tb_section3_des d, tb_tipe t WHERE s.id_jenis = j.id_jenis and s.id_desk = d.id_desk and s.id_tipe = t.id_tipe and s.id_soal = $id")[0];
//var_dump($anggota);

$jenis = query("SELECT * FROM `tb_jenis`");

$des = query("SELECT * FROM `tb_section3_des`");

$tipe = query("SELECT * FROM `tb_tipe`");

if(isset($_POST["submit"])){
    //cek arraynya ada apa ga?  
    
    //cek data masuk atau engga
     if( ubah_soal_sec3($_POST) > 0 ) {
         echo "
            <script>
                alert('Data Berhasil Diubah!');
                document.location.href = 'soal3.php';
            </script>
         ";
     } else {
         echo "
            <script>
                alert('Data Gagal Diubah!');
                document.location.href = 'soal3.php';
            </script>
         ";
     }

}
?>

<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Ubah Section 3</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

    <!-- untuk trix editor -->
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>

</head>
<body id="page-top">
<!-- Page Wrapper -->
<div id="wrapper">

<!-- side bar -->
<?php
include('sidebar.php');
?>
<!-- end of side bar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php
                    include('top_nav.php');
                ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Content Row -->
                    <div class="container-fluid">
                    <div class="row">
                    <!-- Content Wrapper -->
                    <div id="content-wrapper" class="d-flex flex-column">
                        <!-- Main Content -->
                        <div id="content">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Ubah Soal Section 3 (READING COMPREHENSION)</h6>
                        </div>
                    </div>
                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                    <form method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Jenis Soal</label>
                        <select class="form-control" name="idj">
                            <option value="<?= $soal3['id_jenis']; ?>"><?= $soal3["jenis"]; ?></option>
                            <?php foreach ($jenis as $rows) : ?>                
                            <option value="<?= $rows['id_jenis']; ?>"> <?= $rows['jenis']; ?></option>                                                    
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tipe Soal</label>
                        <select class="form-control" name="tipe" required>
                            <option value="<?= $soal3['id_tipe']; ?>"><?= $soal3["tipe"]; ?></option>
                            <?php foreach ($tipe as $rows) : ?>                
                            <option value="<?= $rows['id_tipe']; ?>"> <?= $rows['tipe']; ?></option>                                                    
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Deskripsi</label>
                        <select class="form-control" name="iddes">
                            <option value="<?= $soal3['id_desk']; ?>"><?= $soal3["desk"]; ?></option>
                            <?php foreach ($des as $rows) : ?>                
                            <option value="<?= $rows['id_desk']; ?>"> <?= $rows['desk']; ?> </option>                                                    
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Soal</label>
                        <input id="soal" type="hidden" name="soal">
                    <trix-editor input="soal"><?= $soal3["soal"]; ?></trix-editor>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Pilihan Jawaban (pilih salah satu jawaban yang benar sebagai kunci jawabannya)</label><br>
                        <input type="radio" name="kunci" value="A">&nbsp;&nbsp;A.
                        <input type="text" name="jwb1" class="form-control" value="<?= $soal3['jwbn1']; ?>"><br>
                        <input type="radio" name="kunci" value="B">&nbsp;&nbsp;B.
                        <input type="text" name="jwb2" class="form-control" value="<?= $soal3['jwbn2']; ?>"><br>
                        <input type="radio" name="kunci" value="C">&nbsp;&nbsp;C.
                        <input type="text" name="jwb3" class="form-control" value="<?= $soal3['jwbn3']; ?>"><br>
                        <input type="radio" name="kunci" value="D">&nbsp;&nbsp;D.
                        <input type="text" name="jwb4" class="form-control" value="<?= $soal3['jwbn4']; ?>">
                    </div>
                    <input id="ids" type="hidden" name="ids" value="<?= $soal3["id_soal"]; ?>">
                    <button type="submit" class="btn btn-primary" name="submit">Update</button>
                    </form>
                </div>
            <!-- End of Main Content -->
            <?php
                include('../footer.php');
            ?>
            <!-- Footer -->
            
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>



    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/datatables-demo.js"></script>

</body>
</html>
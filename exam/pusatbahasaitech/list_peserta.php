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

$peserta = query("SELECT `id_user`, `email`, `password`, `role`, `nm_user`, `tgl_lhr`, `tmpt_lhr`, `jekel`, `pekerjaan`, `hp`, `nik`, `alamat` FROM `tb_peserta` where role = 'peserta'");

?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Daftar Peserta Grup</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../vendor/DataTables/datatables.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="../vendor/DataTables/buttons-2.3.6/css/buttons.dataTables.min.css">

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
                        
                        <!-- Begin Page Content -->
                    
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">DATA PESERTA</h6>
                            <div class="box mt-2">
                                <button class="btn btn-warning" onclick="daftar()">Daftarkan Peserta Ujian</button>
                                <button class="btn btn-danger" onclick="hapus()">Hapus Data Peserta</button>
                            </div>
                        </div>
                        <form method="post" name="proses">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" width="100%" cellspacing="0" id="peserta">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" name="select_all" id="select_all" value=""></th>
                                            <th>No.</th>
                                            <th>Nama Peserta</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Pekerjaan</th>
                                            <th>Alamat</th>
                                            <th>E-mail</th>
                                            <th>No.HP</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th>No.</th>
                                            <th>Nama Peserta</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Pekerjaan</th>
                                            <th>Alamat</th>
                                            <th>E-mail</th>
                                            <th>No.HP</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php 
                                    $nomor = 1; 
                                        foreach ($peserta as $row) : 
                                    ?>
                                        <tr>
                                            <td><input type="checkbox" name="checked[]" class="check" value="<?= $row["id_user"]; ?>"></td>
                                            <td><?php echo $nomor++; ?></td>
                                            <td><?= $row["nm_user"]; ?></td>
                                            <td><?= $row["jekel"]; ?></td>
                                            <td><?= $row["tgl_lhr"]; ?></td>
                                            <td><?= $row["pekerjaan"]; ?></td>
                                            <td><?= $row["alamat"]; ?></td>
                                            <td><a href="mailto:<?= $row["email"]; ?>"><?= $row["email"]; ?></a></td>
                                            <td><a href="whatsapp://send?text=Hello&phone=<?= $row["hp"]; ?>"><?= $row["hp"]; ?></a></td>
                                            <td><a href="hapus_peserta.php?id=<?= $row['id_user']; ?>" onclick="return confirm('Apakah Anda Yakin Akan Menghapus Data ini?');"  class="btn btn-danger btn-circle btn-sm">
                                        <i class="fas fa-trash"></i></a></td>
                                        </tr>       
                                        <?php
                                        endforeach;
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        </form>
                    </div>
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
    <script src="../vendor/datatables/datatables.min.js"></script>
   <!--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script> -->
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/buttons-2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="../vendor/datatables/pdfmake-0.1.36/pdfmake.min.js"></script>
    <script src="../vendor/datatables/buttons-2.3.6/js/buttons.html5.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script> 
    <script src="../vendor/datatables/buttons-2.3.6/js/buttons.print.min.js"></script> 
    
    <!-- Page level custom scripts -->
    <script src="../js/demo/datatables-demo.js"></script>

    <script>
    $(document).ready( function () {
        $('#peserta').DataTable({
            dom: 'Bfrtip',
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
            columnDefs: [
                {
                    "orderable": false,
                    "targets": [0, 8]
                }
            ],
            "order": [0, "asc"]
        });
    });

  
$(document).ready(function() {
    $('#select_all').on('click', function() {
        if(this.checked) {
            $('.check').each(function() {
                this.checked = true;
            })
        }
        else {
            $('.check').each(function() {
                this.checked = false;
            })
        }
    });

    $('.check').on('click', function() {
        if($('.check:checked').length == $('.check').length) {
            $('#select_all').prop('checked', true)
        }
        else {
            $('#select_all').prop('checked', false)
        }
    }) 
})

function daftar() {
    document.proses.action = 'daftar_grup.php';
    document.proses.submit();
}

function hapus() {
    var conf = confirm('Yakin akan menghapus data terpilih?');
    if(conf) {
        document.proses.action = 'hapus_peserta_grup.php';
        document.proses.submit();
    }
    
}
</script>

</body>
</html>
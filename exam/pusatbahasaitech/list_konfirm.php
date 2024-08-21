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

$pendaftar = query("SELECT p.*, u.nm_user, u.hp, u.email FROM `tb_pendaftaran` p, tb_peserta u WHERE p.id_user = u.id_user");

$soal1 = query("SELECT distinct(j.jenis), t.tipe FROM `tb_section1` s, tb_jenis j, tb_tipe t WHERE j.id_jenis = s.id_jenis and t.id_tipe = s.id_tipe");

$soal1b = query("SELECT distinct(j.jenis), t.tipe FROM `tb_section1_b` s, tb_jenis j, tb_tipe t WHERE j.id_jenis = s.id_jenis and t.id_tipe = s.id_tipe");

$soal2 = query("SELECT distinct(j.jenis), t.tipe FROM `tb_section2` s, tb_jenis j, tb_tipe t WHERE j.id_jenis = s.id_jenis and t.id_tipe = s.id_tipe");

$soal3 = query("SELECT distinct(j.jenis), t.tipe FROM `tb_section3` s, tb_jenis j, tb_tipe t WHERE j.id_jenis = s.id_jenis and t.id_tipe = s.id_tipe");

if(isset($_POST["submit"])){
    //cek arraynya ada apa ga?  
    
    //cek data masuk atau engga
     if( penjadwalan_ujian($_POST) > 0 ) {
         echo "
            <script>
                alert('Data Berhasil Disimpan!');
                document.location.href = 'list_konfirm.php';
            </script>
         ";
     } else {
         echo "
            <script>
                alert('Data Gagal Disimpan!');
                document.location.href = 'list_konfirm.php';
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

    <title>Pendaftaran Ujian</title>

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
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">DATA PENDAFTAR TEST</h6>
                            <div class="box mt-2">
                                <button class="btn btn-warning" onclick="update_pendaftar()">Update Pendaftar Masal</button>
                                <button class="btn btn-danger" onclick="hapus_pendaftar()">Hapus Pendaftar Masal</button>
                                <button class="btn btn-success" onclick="jadwalkan()">Jadwalkan Pendaftar Masal</button>
                            </div>
                        </div>
                        <form method="post" name="proses">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" width="100%" cellspacing="0" id="pendaftaran">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" name="select_all" id="select_all" value=""></th>
                                            <th>No.</th>
                                            <th>Tgl Daftar</th>
                                            <th>Nama Peserta</th>
                                            <th>E-mail</th>
                                            <th>No.HP</th>
                                            <th>Jenis Tes</th>
                                            <th>Bukti Transfer</th>
                                            <th>Tgl Transfer</th>
                                            <th>Nama Bank</th>
                                            <th>Nama Pemilik Rek</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th>No.</th>
                                            <th>Tgl Daftar</th>
                                            <th>Nama Peserta</th>
                                            <th>E-mail</th>
                                            <th>No.HP</th>
                                            <th>Jenis Tes</th>
                                            <th>Bukti Transfer</th>
                                            <th>Tgl Transfer</th>
                                            <th>Nama Bank</th>
                                            <th>Nama Pemilik Rek</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                      <?php
                                        $nomor = 1; 
                                        foreach ($pendaftar as $row) : 
                                      ?>
                                        <tr>
                                            <td><input type="checkbox" name="checked[]" class="check" value="<?= $row["id_daftar"]; ?>"></td>
                                            <td><?php echo $nomor++; ?></td>
                                            <td><?= $row["tgl_daftar"]; ?></td>
                                            <td><?= $row["nm_user"]; ?></td>
                                            <td><a href="mailto:<?= $row['email']; ?>"><?= $row["email"]; ?></a></td>
                                            <td><a href="whatsapp://send?text=Hello&phone=<?= $row['hp']; ?>"><?= $row["hp"]; ?></a></td>
                                            <td><?= $row["jenis_test"]; ?></td>
                                            <td><img src="../img/<?= $row['bukti_transfer']; ?>" width="50" height="50"></td>
                                            <td><?= $row["tgl_transfer"]; ?></td>
                                            <td><?= $row["nm_bank"]; ?></td>
                                            <td><?= $row["nm_pemilik_rek"]; ?></td>
                                            <td>
                                                <?php
                                                if( !$row["status"] ) {
                                                ?>
                                                <a href="rejected.php?id=<?= $row['id_daftar']; ?>"><button type="button" class="btn btn-primary">Rejected</button></a> | <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="<?= $row['id_daftar']; ?>">Jadwalkan</button>
                                                <?php   
                                                }
                                                else {
                                                    
                                                    echo $row["status"]; 

                                                }
                                                ?>
                                            </td>                                            
                                       </tr>     
                                       </tbody>
                                    <?php endforeach; ?>
                                </table>  
                                              </form>
                    <!-- awal modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Penjadwalan Ujian</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form method="post">
                                <input type="hidden" class="form-control" id="idp" name="idp" value="<?= $row['id_daftar']; ?>">
                                <div class="form-group">
                                
                              </div>
                              <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Tanggal Ujian</label>
                                <input type="date" class="form-control" id="tglujian" name="tglujian" required>
                              </div>
                              <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Waktu Ujian</label>
                                <input type="time" class="form-control" id="wktujian" name="wktujian" required>
                              </div>
                              <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Soal Section 1</label><br>
                                <select name="tipesoal" class="form-control" >
                                <option value="">Pilih Soal Section 1</option>
                                <?php foreach ($soal1 as $rows) : ?>
                                  <option value="<?= $rows['tipe']; ?>"> <?= $rows['jenis']; ?> - <?= $rows['tipe']; ?> </option>                                                    
                                  <?php endforeach; ?>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Soal Section 2</label><br>
                                <select name="tipesoal2" class="form-control" >
                                <option value="">Pilih Soal Section 2</option>
                                <?php foreach ($soal2 as $rows) : ?>                
                                  <option value="<?= $rows['tipe']; ?>"> <?= $rows['jenis']; ?> - <?= $rows['tipe']; ?> </option>                                                    
                                  <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Soal Section 3</label><br>
                                <select name="tipesoal3" class="form-control" >
                                <option value="">Pilih Soal Section 3</option>
                                <?php foreach ($soal3 as $rows) : ?>                
                                  <option value="<?= $rows['tipe']; ?>"> <?= $rows['jenis']; ?> - <?= $rows['tipe']; ?> </option>                                                    
                                  <?php endforeach; ?>
                                </select>
                            </div>
                              <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Link Zoom</label>
                                <textarea class="form-control" id="zoom" name="zoom" required></textarea>
                              </div>
                              <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Pelaksanaan</label><br>
                                <select name="lokasi" class="form-control" >
                                    <option value="Offline">Offline</option>
                                    <option value="Online">Online</option>
                                </select>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="submit" class="btn btn-primary">Save</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- akhir modal -->

                                    
                            </div>
                        </div>
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
    <script src="../vendor/datatables/pdfmake-0.1.36/pdfmake.min.js"></script>
    <script src="../vendor/datatables/buttons-2.3.6/js/buttons.html5.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script> 
    <script src="../vendor/datatables/buttons-2.3.6/js/buttons.print.min.js"></script> 
    
    <!-- Page level custom scripts -->
    <script src="../js/demo/datatables-demo.js"></script>

    <script>
    $(document).ready( function () {
        $('#pendaftaran').DataTable({
            dom: 'Bfrtip',
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
            columnDefs: [
                {
                    "orderable": false,
                    "targets": [0, 12]
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

function update_pendaftar() {
    document.proses.action = 'edit_daftar_grup.php';
    document.proses.submit();
  }

  function jadwalkan() {
    document.proses.action = 'jadwalkan_grup.php';
    document.proses.submit();
  }

  function hapus_pendaftar() {
      var conf = confirm('Yakin akan menghapus data terpilih?');
      if(conf) {
          document.proses.action = 'hapus_pendaftar_grup.php';
          document.proses.submit();
      }
      
  }
    </script>


<script type="text/javascript">
$('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-title').text('Penjadwalan Ujian')
  modal.find('.modal-body input').val(recipient)
})
</script>

</body>
</html>
<?php 
error_reporting(E_ALL);

if( !isset($_SESSION["login"]) ) {
    header("location: ../login.php");
    exit;
}  

if( $_SESSION['role'] === "peserta" ) {
    header("location: ../peserta/home.php");
    exit;
}

?>
  <!-- Page Heading -->
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Peserta</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php
                                                    $query = mysqli_query($conn, "select count(*) as 'ttlpeserta' from tb_peserta");
                                                    $cek = mysqli_fetch_array($query);
                                                    echo $cek['ttlpeserta']." "."Peserta";
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Total Jadwal</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php
                                                    $queryj = mysqli_query($conn, "select count(*) as 'ttljadwal' from tb_jadwal");
                                                    $cek = mysqli_fetch_array($queryj);
                                                    echo $cek['ttljadwal']." "."Jadwal";
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Sertifikat
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                    <?php
                                                    $queryc = mysqli_query($conn, "SELECT p.*, j.*, u1.id_jadwal, u2.id_jadwal, u3.id_jadwal, o.nm_user FROM `tb_pendaftaran` p, tb_jadwal j, tb_ujian u1, tb_ujian_sec1 u2, tb_ujian_sec2 u3, tb_peserta o WHERE p.id_daftar = j.id_daftar and j.id_jadwal=u1.id_jadwal and j.id_jadwal=u2.id_jadwal and j.id_jadwal=u3.id_jadwal and p.id_user=o.id_user group by j.id_jadwal");
                                                    $cekc = mysqli_num_rows($queryc);
                                                    echo $cekc." "."Sertifikat";
                                                ?>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Jenis Test</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php
                                                $queryjenis = mysqli_query($conn, "SELECT COUNT(*) as 'ttljenis' FROM `tb_jenis`");
                                                $cek = mysqli_fetch_array($queryjenis);
                                                echo $cek['ttljenis']." "."Jenis";
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->

                    <div class="row">
                            <!-- Illustrations -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Information Pendaftaran</h6>
                                </div>
                                <div class="card-body">
                                    Pada dashboard admin, terdapat 3 menu utama yaitu:
                                    <ul>
                                        <li>Master Data</li>
                                        <li>Master Soal</li>
                                        <li>Reports</li>
                                    </ul>
                                    <p>
                                        Urutan melakukan pendaftaran masal (grup), dapat dilakukan sebagai berikut:
                                        <ol>
                                            <li>Masuk ke menu Master Data, kemudian pilih menu Pendaftaran Grup</li>
                                            <li>Download format excel, isi file excel hasil download dengan data peserta yang akan didaftarkan. gunakan format pengisian data sesuai contoh yang ada. save dan tutup file excel</li>
                                            <li>Masih dimenu yang sama, upload file excel dengan cara choose file, pilih file yang tadi sudah diisi (file excel)</li>
                                            <li>klik preview, kemudian cek data yang akan diupload. selanjutnya klik Import</li>
                                            <li>Lanjutkan untuk melakukan pendaftaran, klik menu Master Data kemudian pilih menu Peserta. Checklist data peserta yang tadi sudah di upload, kemudian klik Daftarkan Peserta Ujian</li>
                                            <li>Pilih menu Master Data, kemudian pilih menu Pendaftaran. di menu ini checklist data peserta yang akan didaftarkan, kemudian klik Update Pendaftar Masal. Lakukan Update Jenis Tes untuk semua Peserta, selanjutnya klik Update Data Pendaftar</li>
                                            <li>Checklist kembali data yang sudah diupdate tadi, kemudian klik Jadwalkan Pendaftar Masal. isi Tanggal Ujian, Waktu Ujian, Tipe Soal, Link Zoom, dan Pelaksanaan untuk semua peserta, setelah itu klik Jadwalkan Masal</li>
                                            <li>Pendaftaran masal peserta sudah selesai, peserta sudah bisa login dan melakukan ujian sesuai jadwal yang telah ditentukan</li>
                                        </ol>
                                    </p>
                                </div>
                            </div>

                            <!-- Approach -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Information Input Soal</h6>
                                </div>
                                <div class="card-body">
                                <ol>
                                    <li>Untuk input soal dapat dilakukan satu persatu atau di import (khusus untuk soal Structure and Written Expression (Section 2)).</li>
                                    <li>untuk input soal Listening, input terlebih dahulu Audio melalui menu Master Soal, Audio. setelah Upload audio dilakukan, input soal Listening melalui menu Master Soal, Section 1</li>
                                    <li>Untuk input soal Reading & conversation, input terlebih dahulu Textnya melalui menu Master Soal, Reading Text. Setelah input Reading text, bisa lanjut input soal reading di menu Master Soal, Section 3 </li>
                                    <li>Untuk upload soal section 2, dapat dilakukan dengan download terlebih dahulu file excelnya kemudian isi data soal sesuai ketentuan di dalam file excel tersebut, kemudian lakukan upload</li>
                                </ol>
                                </div>
                            </div>

                            <!-- Approach -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Information Sertifikat</h6>
                                </div>
                                <div class="card-body">
                                <ol>
                                    Sertifikat dapat di cetak melalui menu Reports, Sertificate
                                </ol>
                                </div>
                            </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

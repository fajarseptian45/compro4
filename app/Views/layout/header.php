<?php

use App\Models\Konfigurasi_model;
use App\Models\Menu_model;

$konfigurasi  = new Konfigurasi_model;
$menu         = new Menu_model();
$site         = $konfigurasi->listing();
$menu_berita  = $menu->berita();
$menu_profil  = $menu->profil();
$menu_layanan  = $menu->layanan();
$menu_akademik  = $menu->akademik();

?>
<!-- ======= Top Bar ======= -->
<div id="topbar" class="d-flex align-items-center fixed-top">
  <div class="container d-flex align-items-center justify-content-center justify-content-md-between">
    <div class="align-items-center d-none d-md-flex">
      <i class="fas fa-phone-alt"></i><?php echo telepon(); ?>
      &nbsp;
      <i class="fas fa-mobile-alt"></i><?php echo $site['hp'] ?>
      &nbsp;
      <i class="fas fa-envelope"></i><?php echo $site['email']; ?>


      <!-- <a href="http://ecampus.i-tech.ac.id" class="appointment-btn scrollto">
        Sistem Informasi <span class="d-none d-md-inline">eCampus</span>
      </a> -->

    </div>


    <div class="align-items-center d-flex">
      <i class="fas fa-graduation-cap"></i> <?php echo tagline(); ?>

    </div>
  </div>
</div>

<!-- ======= Header ======= -->
<header id="header" class="fixed-top">
  <div class="container d-flex align-items-center">
    <a href="<?php echo base_url() ?>" class="logo me-auto"><img src="<?php echo base_url('assets/upload/image/' . $site['logo']) ?>" alt="<?php echo $site['namaweb'] ?>"></a>
    <!-- Uncomment below if you prefer to use an image logo -->
    <!-- <h1 class="logo me-auto"><a href="index.html">Medicio</a></h1> -->

    <nav id="navbar" class="navbar order-last order-lg-0">
      <ul>
        <li><a class="nav-link scrollto " href="<?php echo base_url() ?>">Home</a></li>
        <li class="dropdown"><a href="#"><span>Profil</span> <i class="bi bi-chevron-down"></i></a>
          <ul>
            <?php foreach ($menu_profil as $menu_profil) { ?>
              <li><a href="<?php echo base_url('berita/profil/' . $menu_profil['slug_berita']) ?>"><?php echo $menu_profil['judul_berita'] ?></a></li>
            <?php } ?>
          </ul>
        </li>

        <li class="dropdown"><a href="<?php echo base_url('berita') ?>"><span>Informasi</span> <i class="bi bi-chevron-down"></i></a>
          <ul>
            <?php foreach ($menu_berita as $menu_berita) { ?>
              <li><a href="<?php echo base_url('berita/kategori/' . $menu_berita['slug_kategori']) ?>"><?php echo $menu_berita['nama_kategori'] ?></a></li>
            <?php } ?>
          </ul>
        </li>
        <li class="dropdown"><a href="#"><span>Akademik</span> <i class="bi bi-chevron-down"></i></a>
          <ul>
            <?php foreach ($menu_akademik as $menu_akademik) { ?>
              <li><a href="<?php echo base_url('berita/layanan/' . $menu_akademik['slug_berita']) ?>"><?php echo $menu_akademik['judul_berita'] ?></a></li>
            <?php } ?>
            <li><a href="<?php echo base_url('staff') ?>">Dosen dan Pengajar Profesional</a></li>
          </ul>
        </li>

        <li><a class="nav-link scrollto" href="<?php echo base_url('download') ?>">Download</a></li>

        <li class="dropdown"><a href="#"><span>Galeri &amp; Video</span> <i class="bi bi-chevron-down"></i></a>
          <ul>
            <li><a href="<?php echo base_url('galeri') ?>">Galeri Gambar</a></li>
            <li><a href="<?php echo base_url('video') ?>">Galeri Video</a></li>
          </ul>
        </li>
        <li class="dropdown"><a href="#"><span>Layanan Online</span> <i class="bi bi-chevron-down"></i></a>
          <ul>
            <li><a href="https://pmb.i-tech.ac.id" target="_blank">Pendaftaran Online</a></li>
            <li><a href="https://ecampus.i-tech.ac.id/tech/ecampus.jsp" target="_blank">LMS Ecampus</a></li>
            <li><a href="https://simjamu.i-tech.ac.id/" target="_blank">SPMI</a></li>
            <li><a href="https://exam.i-tech.ac.id/" target="_blank">Pusat Bahasa</a></li>
            <li><a href="https://alumni.i-tech.ac.id/tech/alumni.zul" target="_blank">Tracer Study</a></li>
            <li><a href="https://perpus.i-tech.ac.id/" target="_blank">E-Library</a></li>
            <li><a href="https://e-resources.perpusnas.go.id/" target="_blank">Koleksi Digital E-Resources</a></li>
            <li><a href="https://jitech.i-tech.ac.id/" target="_blank">Jurnal JiTech</a></li>
            <li><a href="https://maklumatika.i-tech.ac.id/" target="_blank">Jurnal Maklumatika</a></li>
          </ul>
        </li>
        <li><a class="nav-link scrollto" href="<?php echo base_url('kontak') ?>">Kontak</a></li>
        <li><a class="nav-link scrollto" href="https://pmb.i-tech.ac.id" target="_blank">Pendaftaran</a></li>
      </ul>
      <i class="bi bi-list mobile-nav-toggle"></i>
    </nav><!-- .navbar -->

    <!-- <a href="https://pmb.i-tech.ac.id" class="appointment-btn scrollto" target="_blank">Pendaftaran</a> -->

    <!-- <a href="<?php //echo base_url('login') 
                  ?>" class="appointment-btn scrollto">
      Login <span class="d-none d-md-inline">Admin</span>
    </a> -->

  </div>
</header><!-- End Header -->
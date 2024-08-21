<!-- ======= Contact Section ======= -->
<section id="contact" class="contact">
  <div class="container">
    <div class="row mt-5 justify-content-center">
      <div class="section-title col-md-12 text-center">
        <h2>Berita Terbaru</h2>
      </div>
      <?php foreach ($berita2 as $berita2) { ?>
        <div class="col-md-4">
          <div class="card" style="margin-bottom: 20px;">
            <img src="<?php echo base_url('assets/upload/image/' . $berita2['gambar']) ?>">
            <div class="card-body">
              <a href="<?php echo base_url('berita/read/' . $berita2['slug_berita']) ?>">
                <h3><?php echo $berita2['judul_berita'] ?></h3>
              </a>
              <p class="card-text">
                <?php echo $berita2['ringkasan'] ?>
              </p>

            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</section><!-- End Contact Section -->
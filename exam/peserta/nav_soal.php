<nav>
<ul class="pagination justify-content-center">
  <li class="page-item">
    <a class="page-link" <?php if($halaman > 1){ echo "href='?idj=$idj&jenis=$jenis&tipe=$tipe&halaman=$prev'"; } ?>>Prev</a>
  </li>
  <?php 
  for($x=1;$x<=$total_halaman;$x++){
    ?> 
  <li class="page-item"><a class="page-link" href="?idj=<?= $idj; ?>&jenis=<?= $jenis; ?>&tipe=<?= $tipe; ?>&halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
  <?php
  }
  ?>				
  <li class="page-item">
    <a  class="page-link" <?php if($halaman < $total_halaman) { echo "href='?idj=$idj&jenis=$jenis&tipe=$tipe&halaman=$next'"; } ?>>Next</a>
  </li>
</ul>
</nav>

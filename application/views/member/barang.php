<?php
function rupiah($angka)
{
  return number_format($angka, 0, '.', '.');
}
?>
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
  </div>
  <hr class="mb-4">

  <!-- Basic Card Example -->
  <?php foreach($kategori as $k) : ?>
  <h1 class="h4 mb-0 text-gray-800 mb-4"><?= $k['nama'] ?></h1>
  <div class="row">
  <?php foreach($barang as $b) : 
    if($b['kategori'] === $k['nama']) :
    ?>
    <div class="col-md-3">
      <div class="card shadow mb-4 rounded">
        <img class="rounded" src="<?= base_url('assets/img/') ?><?= $b['nama'] ?>.png" alt="" width="100%">
        <div class="card-body">
          <h6 class="text-dark"><?= $b['nama'] ?></h6>
          <h6 class="font-weight-bold text-primary">Rp <?= rupiah($b['harga']) ?></h6>
        </div>
      </div>
    </div>
    <?php 
    endif;
    endforeach; ?>
  </div>
  <?php endforeach; ?>
  <!-- Content Row -->

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
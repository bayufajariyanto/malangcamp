<?php
function rupiah($angka)
{
  return number_format($angka, 0, '.', '.');
}
?>
<!-- Begin Page Content -->
<div class="container">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <!-- <h1 class="h3 mb-0 text-gray-800">Dashboard</h1> -->
    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
  </div>

  <!-- Content Row -->
  <?= $this->session->flashdata('message'); ?>
  <div class="row">

      <div class="col-lg-3">
        <h1 class="my-4">Kategori</h1>
        <div class="list-group">
          <a href="<?= base_url('member/barang') ?>" class="list-group-item text-decoration-none list-group-item-action active">Semua Barang</a>
          <?php foreach($kategori as $k): ?>
          <a href="<?= base_url('member/kategori/') ?><?= $k['nama'] ?>" class="list-group-item text-decoration-none list-group-item-action"><?= $k['nama'] ?></a>
          <?php endforeach; ?>
        </div>

      </div>
      <!-- /.col-lg-3 -->

      <div class="col-lg-9">
        <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
              <img class="d-block img-fluid rounded" src="<?= base_url('assets/img/promo') ?>.png" alt="First slide">
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid rounded" src="<?= base_url('assets/img/promo') ?>.png" alt="Second slide">
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid rounded" src="<?= base_url('assets/img/promo') ?>.png" alt="Third slide">
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
        
        <div class="row">
          <?php
          $display = '';
          $index=0;
          $keranjang[] = null;
          foreach ($topkeranjang as $t) {
            $keranjang[$index] = (int)$t['id_barang'];
            // var_dump($keranjang[$index]);
            $index++;
          }
          $index = 0;
          foreach ($barang as $b) :
              foreach ($topkeranjang as $t) {
                // $keranjang[$index] = (int)$t['id_barang'];
                if((int)$b['id'] == $keranjang[$index]){
                  // var_dump($keranjang[$index]);
                  $display = 'd-none';
                }else{
                  $display = '';
                }
                $index++;
              }
            // var_dump($keranjang[1]);
          ?>
          <div class="col-lg-4 col-md-6 mb-4 <?= $display ?>">
            <div class="card h-100">
              <a href="<?= base_url('member/barangid/') ?><?= $b['id'] ?>"><img class="card-img-top" src="<?= base_url('assets/img/') ?><?= $b['nama'] ?>.png" alt=""></a>
              <div class="card-body">
                <h5 class="card-title">
                  <a href="<?= base_url('member/barangid/') ?><?= $b['id'] ?>" class="text-decoration-none"><?= $b['nama'] ?></a>
                </h5>
                <h5 class="font-weight-bold">Rp <?= rupiah($b['harga']) ?><small> / hari</small></h5>
                <p class="card-text"><?= $b['kategori'] ?></p>
              </div>
            </div>
          </div>
          <?php 
          $index = 0;
          endforeach; ?>
        </div>
        <!-- /.row -->

      </div>
      <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
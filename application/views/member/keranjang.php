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

  <div class="row">

  
  <!-- /.col-lg-3 -->
  <div class="col-lg-8 my-4">
    <!-- /.card -->

    <div class="card card-outline-secondary my-4">
        <div class="card-body">
            <?php 
            $total = 0;
            foreach($keranjang as $k) : 
            $total = $total + ($k['harga']*$k['jumlah']); ?>
          <div class="row">
            <div class="col-md-4">
                <img src="<?= base_url('assets/img/') ?><?= $k['nama_barang'] ?>.png" alt="barang" class="img-thumbnail">
            </div>
            <div class="col-md-7">
              <h4 class="text-grey-900 font-weight-bold"><?= $k['nama_barang'] ?></h4>
              <p class="card-text font-weight-bold text-info">Rp <?= rupiah($k['harga']) ?></p>
              <div class="row">
              <div class="col-md-2">
              <input type="text" class="form-control" size="2" id="barang<?= $k['id'] ?>" value="<?= $k['jumlah'] ?>">
              </div>
              </div>
              <!-- <small class="text-muted">Posted by Anonymous on 3/1/17</small> -->
            </div>
            <div class="col-md-1">
              <a  href="<?= base_url('member/hapus_keranjang/') ?><?= $k['id'] ?>" class="btn"><i class="fas fa-trash-alt"></i></a>
            </div>
          </div>
            <div class="my-3"></div>
            <?php endforeach; ?>
        <!-- <hr>
        <a href="#" class="btn btn-success">Leave a Review</a> -->
      </div>
    </div>
    <!-- /.card -->

  </div>
  <!-- /.col-lg-9 -->

  <div class="col-lg-4 my-4">
    <div class="card my-4">
      <div class="card-header">
          Ringkasan Pesanan
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col">
            <div>Total Harga</div>
          </div>
          <div class="col">
            <div class="ml-auto text-right text-primary font-weight-bold">Rp <?= rupiah($total) ?></div>
          </div>
        </div>
        <button class="btn btn-primary btn-block my-3 text-center">Pesan <?= jumlahKeranjang(count($topkeranjang),'(',')')?></button>
        <hr>
        <small class="text-muted">** Masa berlaku pemesanan hanya 1 jam</small>
      </div>
    </div>
  </div>
  </div>

</div>
<!-- /.container-fluid -->

</div>
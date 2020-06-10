<?php
function rupiah($angka)
{
  return number_format($angka, 0, '.', '.');
}
?>
<!-- Begin Page Content -->
<div class="container">

  <!-- Page Heading -->
  <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4"> -->
    <!-- <h1 class="h3 mb-0 text-gray-800">Dashboard</h1> -->
    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
  <!-- </div> -->

  <!-- Content Row -->

  <form action="<?= base_url('member/percobaan') ?>" method="post">
  <div class="row">

  <!-- /.col-lg-3 -->
  <div class="col-lg-8 my-3">
    <!-- /.card -->

    <div class="card card-outline-secondary my-3">
      <div class="card-body">
        <?php 
        $total = 0;
        foreach($keranjang as $k) : 
        $total = $total + ($k['harga']*$k['jumlah']); ?>
        <div class="row">
          <div class="col-md-4">
              <img src="<?= base_url('assets/img/') ?><?= $k['nama'] ?>.png" alt="barang" class="img-thumbnail">
          </div>
          <div class="col-md-7 mt-2">
            <h4 class="text-grey-900"><input type="text" name="id[]" class="d-none" value="<?= $k['id'] ?>" id="nama"><?= $k['nama'] ?></h4>
            <p class="card-text font-weight-bold text-info">Rp <?= rupiah($k['harga']) ?></p>
            <div class="row">
            <div class="col-2">
            <input type="text" class="form-control text-center" size="2" name="jumlah[]" id="barang<?= $k['id'] ?>" value="<?= $k['jumlah'] ?>">
            </div>
            </div>
            <!-- <small class="text-muted">Posted by Anonymous on 3/1/17</small> -->
          </div>
          <div class="col-1">
            <a  href="<?= base_url('member/hapus_keranjang/') ?><?= $k['id'] ?>" class="btn"><i class="fas fa-trash-alt"></i></a>
          </div>
        </div>
        <div class="my-3"></div>
        <?php endforeach; ?>
        <!-- <a href="#" class="btn btn-success">Leave a Review</a> -->
      </div>
    </div>
    <!-- /.card -->

  </div>
  <!-- /.col-lg-9 -->

  <div class="col-lg-4 my-3">
    <div class="card my-3">
      <div class="card-header">
          Ringkasan Pesanan
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col mt-1">
            Durasi sewa (hari)
          </div>
          <div class="col">
            <input type="text" class="form-control text-center" size="2" name="hari" value="1">
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col">
            <div>Total Harga</div>
          </div>
          <div class="col">
            <div class="ml-auto text-right text-primary font-weight-bold">Rp <?= rupiah($total) ?></div>
          </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block my-3 text-center">Pesan <?= jumlahKeranjang(count($topkeranjang),'(',')')?></button>
        <hr>
        <small class="text-muted">** Masa berlaku pemesanan hanya 1 jam</small>
      </div>
    </div>
  </div>
</div>
  </form>

</div>
<!-- /.container-fluid -->

</div>
<?php
function rupiah($angka)
{
  return number_format($angka, 0, '.', '.');
}
?>
<!-- Begin Page Content -->
<div class="container">

  <!-- Content Row -->
  <?= $this->session->flashdata('message'); ?>

  <form action="<?= base_url('member/tambahpesan/') ?><?= $pesan['id'] ?>" method="post">
  <div class="row">

  <!-- /.col-lg-3 -->
  <div class="col-lg-8 my-3">
    <!-- /.card -->

    <div class="card card-outline-secondary my-3">
      <div class="card-body">
        <?php 
        $total = 0;
        // foreach($pesan as $p) : 
        $total = $total + ($pesan['harga']*$jumlah); ?>
        <div class="row">
          <div class="col-md-4">
              <img src="<?= base_url('assets/img/') ?><?= $pesan['nama'] ?>.png" alt="barang" class="img-thumbnail">
          </div>
          <div class="col-md-8 mt-2">
            <h4 class="text-grey-900"><input type="text" name="id" class="d-none" value="<?= $pesan['id'] ?>" id="nama"><?= $pesan['nama'] ?></h4>
            <p class="card-text font-weight-bold text-info">Rp <?= rupiah($pesan['harga']) ?></p>
            <div class="row">
            <div class="col-2">
            <input type="text" class="form-control text-center" size="2" name="jumlah" id="barang<?= $pesan['id'] ?>" value="<?= $jumlah ?>">
            </div>
            </div>
            
          </div>
        </div>
        <div class="my-3"></div>
        <?php 
      // endforeach; ?>
      
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
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
  <div class="row my-4">
  <div class="col-lg-3">
      <h1><?= $select ?></h1>
  </div>
  <div class="col-lg-9">
    <?= $this->session->flashdata('message'); ?>
  </div>
  </div>
  <div class="row">
    <div class="col-lg-3">
      <div class="list-group">
        <a href="<?= base_url('member/barang') ?>" class="list-group-item text-decoration-none list-group-item-action">Semua Barang</a>
        <?php foreach($kategori as $k): 
          
          switch($select){
            case $k['nama']: 
              $aktif = 'active';
            break;
            default:
              $aktif = '';
          }
          
          ?>
        <a href="<?= base_url('member/kategori/') ?><?= $k['nama'] ?>" class="list-group-item text-decoration-none <?= $aktif ?> list-group-item-action"><?= $k['nama'] ?></a>
        <?php endforeach; ?>
      </div>
    </div>
    <!-- /.col-lg-3 -->

    <div class="col-lg-9">

      <div class="row">
        <?php 
        $display = null;
        foreach ($barang as $b) :
        ?>
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="card h-100">
            <a href="<?= base_url('member/barangid/') ?><?= $b['id'] ?>"><img class="card-img-top" src="<?= base_url('assets/img/') ?><?= $b['nama'] ?>.png" alt="gambar barang"></a>
            <div class="card-body">
              <h5 class="card-title">
                <a href="<?= base_url('member/barangid/') ?><?= $b['id'] ?>" class="text-decoration-none"><?= $b['nama'] ?></a>
              </h5>
              <h5 class="font-weight-bold">Rp <?= rupiah($b['harga']) ?><small> / hari</small></h5>
              <p class="card-text"><?= $b['kategori'] ?></p>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
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
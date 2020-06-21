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
  </div>

  <!-- Content Row -->
  <?= $this->session->flashdata('message'); ?>
  <div class="row">
    <div class="mx-auto">
      <div class="card card-outline-secondary my-4 p-5">
        <div class="card-body container-fluid text-center">
          <img src="<?= base_url('assets/img/') ?>empty_order.svg" alt="empty order" width="300" class="img-fluid mx-auto d-block my-5">
          <h3 class="font-weight-bold">Kamu belum pesan</h3>
          <p>Peralatan trekking masih banyak. Yuk, pesan!</p>
          <a href="<?= base_url('member/') ?>" class="btn btn-success my-5">Cari Barangmu</a>
        </div>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

</div>
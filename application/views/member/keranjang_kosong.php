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
  <!-- <div class="col-lg-8 my-4"> -->
    <!-- /.card -->

    <div class="card card-outline-secondary mx-auto my-4">
        <div class="card-body container-fluid">
        <div class="row my-3">
        <!-- <div class="col-md-3"></div>
        <div class="col-md-6">
        <div class="text-center"> -->
        <div class="col text-center">
            <img src="<?= base_url('assets/img/') ?>empty_cart.svg" alt="empty cart" width="300" class="img-fluid mx-auto d-block my-5">
            <h3 class="font-weight-bold">Wah, Keranjangmu kosong</h3>
            <p>Daripada dianggurin, mending barang-barang keperulanmu. <br>Yuk, cek sekarang!</p>
            <a href="<?= base_url('member/') ?>" class="btn btn-success my-5">Cari Barangmu</a>
        </div>
        <!-- </div>

        </div>
        <div class="col-md-3"></div> -->
        </div>
        <!-- <hr>
        <a href="#" class="btn btn-success">Leave a Review</a> -->
      </div>
    </div>
    <!-- /.card -->

  <!-- </div> -->
  <!-- /.col-lg-9 -->


</div>

</div>
<!-- /.container-fluid -->

</div>
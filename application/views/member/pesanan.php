<?php
function rupiah($angka)
{
  return number_format($angka, 0, '.', '.');
}
// if($transaksi['konfirmasi'] == 1){
//     $konfirmasi = 'Sudah dibayar';
// }else{
//     $konfirmasi = 'Belum dibayar';
// }

// if($transaksi['selesai'] == 1){
//     $selesai = 'Selesai';
// }else{
//     $selesai = 'Belum Selesai';
// }
?>

<!-- Begin Page Content -->
<div class="container">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>

  </div>
  <!-- Button trigger modal -->
  <div class="card">
    <div class="card-body">
      <br>
      <div class="row">
        <div class="col-3">
          <p class="list-inline-item">Kode Transaksi</p>
        </div>
        <div class="col-8">
          <div class="list-inline-item">
            <h5 class="card-title">XXX-XXXXXXXXXXXXX</h5>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-3">
          <p class="list-inline-item">Nama</p>
        </div>
        <div class="col-8">
          <div class="list-inline-item">
            <p class="card-text">Nama User</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-3">
          <p class="list-inline-item">Tanggal Order</p>
        </div>
        <div class="col-8">
          <div class="list-inline-item">
            <p class="card-text">Ini data data data data data data</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-3">
          <p class="list-inline-item">Status Pembayaran</p>
        </div>
        <div class="col-8">
          <div class="list-inline-item">
            <p class="card-text">Belum Bayar</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-3">
          <p class="list-inline-item">Status Transaksi</p>
        </div>
        <div class="col-8">
          <div class="list-inline-item">
            <p class="card-text">Ini data data data data data data</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-3">
          <p class="list-inline-item">Total</p>
        </div>
        <div class="col-8">
          <div class="list-inline-item">
            <h5 class="card-title">Rp x.xxx</h5><!-- Jumlah semua sub total -->
          </div>
        </div>
      </div>
      <!-- <div class="row">
        <p class="col-sm-2">Tanggal Order</p>
        <div class="col-sm-10">
          <p class="card-text">Ini data</p>
        </div>
      </div>
      <div class="row">
        <p class="col-sm-2">Tanggal Pembayaran</p>
        <div class="col-sm-10">
          <p class="card-text">Ini data</p>
        </div>
      </div>
      <div class="row">
        <p class="col-sm-2">Status Pembayaran</p>
        <div class="col-sm-10">
          <p class="card-text">Ini data</p>
        </div>
      </div>
      <div class="row">
        <p class="col-sm-2">Status Transaksi</p>
        <div class="col-sm-10">
          <p class="card-text">Ini data</p>
        </div>
      </div> -->
      <br>
      <div class="row">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Nama Barang</th>
                <th>Qty</th>
                <th>Harga</th>
                <th>Sub Total</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Nama Barang</th>
                <th>Qty</th>
                <th>Harga</th>
                <th>Sub Total</th>
              </tr>
            </tfoot>
            <tbody>
              <?php
                // if ($transaksi['status'] == 1) {
                //   $status = 'Lunas';
                // } else {
                //   $status = 'Belum Lunas';
                // }
              ?>
              <tr>
                <td>Ini data</td>
                <td>Ini data</td>
                <td>Rp x.xxx</td>
                <td>Rp x.xxx</td><!-- qty*harga -->
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <br>
      <!-- <div class="text-center"> -->
        <a href="<?= base_url() ?>member/transaksi" class="btn btn-sm btn-secondary">Kembali</a>
      <!-- </div> -->
    </div>
  </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
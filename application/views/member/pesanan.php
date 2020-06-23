<?php
function rupiah($angka)
{
  return number_format($angka, 0, '.', '.');
}
if($baris['konfirmasi'] == 1){
    $konfirmasi = 'Sudah dibayar';
}else{
    $konfirmasi = 'Belum dibayar';
}

if($baris['selesai'] == 1){
    $selesai = 'Selesai';
}else{
    $selesai = 'Belum Selesai';
}
?>

<!-- Begin Page Content -->
<div class="container">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>

  </div>
  <!-- Button trigger modal -->
  <div class="card">
    <div class="card-body container-fluid">
      <br>
      <div class="row">
        <div class="col-4">
          <p class="list-inline-item">Kode Transaksi</p>
        </div>
        <div class="col-7">
          <div class="list-inline-item">
            <h5 class="card-title"><?= $baris['kode_transaksi'] ?></h5>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-4">
          <p class="list-inline-item">Nama</p>
        </div>
        <div class="col-7">
          <div class="list-inline-item">
            <p class="card-text"><?= $user['nama'] ?></p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-4">
          <p class="list-inline-item">Tanggal Order</p>
        </div>
        <div class="col-7">
          <div class="list-inline-item">
            <p class="card-text"><?= date('d M Y | H:i:s', $baris['tanggal_order']) ?></p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-4">
          <p class="list-inline-item">Durasi Sewa</p>
        </div>
        <div class="col-7">
          <div class="list-inline-item">
            <p class="card-text"><?= $durasi ?> hari</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-4">
          <p class="list-inline-item">Status Pembayaran</p>
        </div>
        <div class="col-7">
          <div class="list-inline-item">
            <p class="card-text"><?= $konfirmasi ?></p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-4">
          <p class="list-inline-item">Status Transaksi</p>
        </div>
        <div class="col-7">
          <div class="list-inline-item">
            <p class="card-text"><?= $selesai ?></p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-4">
          <p class="list-inline-item">Total</p>
        </div>
        <div class="col-7">
          <div class="list-inline-item">
            <h5 class="card-title">Rp <?= rupiah($total) ?></h5><!-- Jumlah semua sub total -->
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
      <div class="row mx-1">
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
                foreach($pesanan as $p) :
              ?>
              <tr>
                <td><?= $p['nama'] ?></td>
                <td><?= $p['jumlah_barang'] ?></td>
                <td>Rp <?= rupiah($p['harga']) ?></td>
                <td>Rp <?= rupiah($p['harga']*$p['jumlah_barang']) ?></td><!-- qty*harga -->
              </tr>
              <?php
              endforeach;
              ?>
            </tbody>
          </table>
        </div>
      </div>
      <br>
      <!-- <div class="text-left"> -->
        <a href="<?= base_url() ?>member/transaksi" class="btn btn-sm btn-secondary">Kembali</a>
      <!-- </div> -->
    </div>
  </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?php
function rupiah($angka)
{
  return number_format($angka, 0, '.', '.');
}
if ($peminjaman['selesai'] == 0) {
  $status = 'Berjalan';
} else if ($peminjaman['selesai'] == 1) {
  $status = 'Selesai';
}
$sehari = 60*60*24;
$batas = '';
// var_dump
if($peminjaman['batas_kembali']< time()){
  $hariTerlambat = (int)ceil((time()-$peminjaman['batas_kembali'])/$sehari);
  $batas = '<strong class="text-danger">(Terlambat '.$hariTerlambat.' hari)</strong>';
  $denda = ($peminjaman['total']*$hariTerlambat);
  // $total = $denda+$peminjaman['total'];
  // var_dump();die;
}else{
  $batas = '(Belum Terlambat)';
  $denda = 0;
}
?>
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Detail <?= $title ?></h1>
  </div>
  <!-- Button trigger modal -->
  <?= $this->session->flashdata('message'); ?>

  <div class="card w-100">
    <div class="card-body">
      <br>
      <div class="row">
        <p class="col-sm-2">Kode Transaksi</p>
        <div class="col-sm">
          <h5 class="card-title"><?= $peminjaman['kode_transaksi'] ?></h5>
        </div>
      </div>
      <div class="row">
        <p class="col-sm-2">Nama Member</p>
        <div class="col-sm">
          <h5 class="card-title"><?= $nama['nama'] ?></h5>
        </div>
      </div>
      <hr>
      <div class="row">
        <p class="col-sm-2">Nama Barang</p>
        <div class="col-sm">
          <p class="card-text"><?= $barang['nama'] ?> (<?= $barang['kategori'] ?>)</p>
        </div>
      </div>
      <div class="row">
        <p class="col-sm-2">Jumlah Barang</p>
        <div class="col-sm">
          <p class="card-text"><?= $peminjaman['jumlah_barang'] ?></p>
        </div>
      </div>
      <div class="row">
        <p class="col-sm-2">Tanggal Order</p>
        <div class="col-sm">
          <p class="card-text"><?= date('d F Y | H:i', $peminjaman['tanggal_order']) ?></p>
        </div>
      </div>
      <div class="row">
        <p class="col-sm-2">Tanggal Sewa</p>
        <div class="col-sm">
          <p class="card-text"><?= date('d F Y | H:i', $peminjaman['tanggal_sewa']) ?></p>
        </div>
      </div>
      <div class="row">
        <p class="col-sm-2">Total Pembayaran</p>
        <div class="col-sm">
          <p class="card-text">Rp <?= rupiah($peminjaman['total']) ?></p>
        </div>
      </div>
      <div class="row">
        <p class="col-sm-2">Tanggal Pembayaran</p>
        <div class="col-sm">
          <p class="card-text"><?= date('d F Y | H:i', $peminjaman['tanggal_bayar']) ?></p>
        </div>
      </div>
      <div class="row">
        <p class="col-sm-2">Batas Pengembalian</p>
        <div class="col-sm">
          <p class="card-text"><?= date('d F Y | H:i', $peminjaman['batas_kembali']) ?> <?= $batas ?></p>
        </div>
      </div>
      <div class="row">
        <p class="col-sm-2">Denda</p>
        <div class="col-sm">
          <p class="card-text">Rp <?= rupiah($denda) ?></p>
        </div>
      </div>
      <div class="row">
        <p class="col-sm-2">Status Transaksi</p>
        <div class="col-sm">
          <p class="card-text"><?= $status ?></p>
        </div>
      </div>
      <br><br>
      <div class="text-center">
        <a href="<?= base_url('admin/peminjaman') ?>" class="d-sm-inline-block btn btn-sm btn-secondary shadow-sm">Kembali</a>
        <a href="<?= base_url() ?>admin/peminjaman_selesai/<?= $peminjaman['id'] ?>" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">Selesai</a>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
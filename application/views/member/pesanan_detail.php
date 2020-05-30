<?php 
function rupiah($angka)
{
  return number_format($angka, 0, '.', '.');
}

if($pesanan['tanggal_bayar']>1){
    $tbayar = date('d F Y | H:i:s', $pesanan['tanggal_bayar']);
}else{
    $tbayar = '-';
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
    </div>
    <!-- Button trigger modal -->
    
    <div class="card">
        <div class="card-body">
            <br>
            <div class="row">
                <p class="col-sm-2">Kode Transaksi</p>
                <div class="col-sm-10">
                    <h5 class="card-title"><?= $pesanan['kode_transaksi'] ?></h5>
                </div>
            </div>
            <div class="row">
                <p class="col-sm-2">Nama Member</p>
                <div class="col-sm-10">
                    <h5 class="card-title"><?= $nama['nama'] ?></h5>
                </div>
            </div>
            <hr>
            <div class="row">
                <p class="col-sm-2">Nama Barang</p>
                <div class="col-sm-10">
                    <p class="card-text"><?= $barang['nama'] ?></p>
                </div>
            </div>
            <div class="row">
                <p class="col-sm-2">Jumlah Barang</p>
                <div class="col-sm-10">
                    <p class="card-text"><?= $pesanan['jumlah_barang'] ?></p>
                </div>
            </div>
            <div class="row">
                <p class="col-sm-2">Tanggal Order</p>
                <div class="col-sm-10">
                    <p class="card-text"><?= date('d F Y | H:i:s', $pesanan['tanggal_order']) ?></p>
                </div>
            </div>
            <div class="row">
                <p class="col-sm-2">Tanggal Sewa</p>
                <div class="col-sm-10">
                    <p class="card-text"><?= date('d F Y | H:i:s', $pesanan['tanggal_sewa']) ?></p>
                </div>
            </div>
            <div class="row">
                <p class="col-sm-2">Batas Pengembalian</p>
                <div class="col-sm-10">
                    <p class="card-text"><?= date('d F Y | H:i:s', $pesanan['batas_kembali']) ?></p>
                </div>
            </div>
            <div class="row">
                <p class="col-sm-2">Tanggal Bayar</p>
                <div class="col-sm-10">
                    <p class="card-text"><?= $tbayar; ?></p>
                </div>
            </div>
            <br>
            <div class="row">
                <p class="col-sm-2">Total</p>
                <div class="col-sm-10">
                    <p class="card-text"><small class="text-muted">Rp <?= rupiah($pesanan['total']) ?> <strong>(<?= $lunas ?>)</strong></small></p>
                </div>
            </div>
            <br>
            <div class="text-center">
                <a href="<?= base_url() ?>member/pesanan" class="btn btn-sm btn-secondary">Kembali</a>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
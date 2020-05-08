<?php 
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
    <!-- Modal -->
    <div class="modal fade mt-5" id="konfirmasi" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <?php

                ?>
                <form method="post" action="<?= base_url('admin/pesanan_konfirmasi'); ?>">
                    <div class="modal-body">
                        <p>Apakah member sudah membayar lunas?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Konfirmasi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade mt-5" id="batal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <?php

                ?>
                <form method="post" action="<?= base_url('admin/batal_pesanan'); ?>">
                    <div class="modal-body">
                        <p>Apakah anda yakin membatalkan pesanan?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-danger">Batalkan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
                <p class="col-sm-2">Nama</p>
                <div class="col-sm-10">
                    <p class="card-text"><?= $nama['nama'] ?></p>
                </div>
            </div>
            <div class="row">
                <p class="col-sm-2">Barang</p>
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
                    <p class="card-text"><small class="text-muted">Rp. <?= $pesanan['total'] ?> <strong>(<?= $lunas ?>)</strong></small></p>
                </div>
            </div>
            <br><br>
            <div class="text-center">
                <a href="<?= base_url() ?>admin/pesanan" class="btn btn-sm btn-secondary">Kembali</a>
                <a href="<?= base_url('admin/pesanan_konfirmasi/'.$pesanan['id']) ?>" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">Konfirmasi</a>
                <a href="<?= base_url() ?>admin/pesanan_batal/<?= $pesanan['id'] ?>" class="d-sm-inline-block btn btn-sm btn-danger shadow-sm tombol-batal">Batalkan</a>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
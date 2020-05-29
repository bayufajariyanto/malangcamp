<?php
function rupiah($angka)
{
  return number_format($angka, 0, '.', '.');
}
if($transaksi['konfirmasi'] == 1){
    $konfirmasi = 'Sudah dibayar';
}else{
    $konfirmasi = 'Belum dibayar';
}

if($transaksi['selesai'] == 1){
    $selesai = 'Selesai';
}else{
    $selesai = 'Belum Selesai';
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
                    <h5 class="card-title"><?= $transaksi['kode_transaksi'] ?></h5>
                </div>
            </div>
            <div class="row">
                <p class="col-sm-2">Nama</p>
                <div class="col-sm-10">
                    <p class="card-text"><?= $nama['nama'] ?></p>
                </div>
            </div>
            <div class="row">
                <p class="col-sm-2">Tanggal Order</p>
                <div class="col-sm-10">
                    <p class="card-text"><?= date('d F Y | H:i:s', $transaksi['tanggal_order']) ?></p>
                </div>
            </div>
            <div class="row">
                <p class="col-sm-2">Tanggal Pembayaran</p>
                <div class="col-sm-10">
                    <p class="card-text"><?= date('d F Y | H:i:s', $transaksi['tanggal_bayar']) ?></p>
                </div>
            </div>
            <div class="row">
                <p class="col-sm-2">Status Pembayaran</p>
                <div class="col-sm-10">
                    <p class="card-text"><?= $konfirmasi ?></p>
                </div>
            </div>
            <div class="row">
                <p class="col-sm-2">Status Transaksi</p>
                <div class="col-sm-10">
                    <p class="card-text"><?= $selesai ?></p>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nama Barang</th>
                                <th>Tanggal Sewa</th>
                                <th>Tanggal Akhir Sewa</th>
                                <th>Tanggal Pengembalian</th>
                                <th>Total</th>
                                <th>Denda</th>
                                <th>Total Bayar</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Nama Barang</th>
                                <th>Tanggal Sewa</th>
                                <th>Tanggal Akhir Sewa</th>
                                <th>Tanggal Pengembalian</th>
                                <th>Total</th>
                                <th>Denda</th>
                                <th>Total Bayar</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                              if ($transaksi['status'] == 1) {
                                $status = 'Lunas';
                              } else {
                                $status = 'Belum Lunas';
                              }
                            ?>
                            <tr>
                                <td><?= $barang['nama'] ?></td>
                                <td><?= date('d F Y | H:i:s', $transaksi['tanggal_sewa']) ?></td>
                                <td><?= date('d F Y | H:i:s', $transaksi['batas_kembali']) ?></td>
                                <td><?= date('d F Y | H:i:s', $transaksi['tanggal_kembali']) ?></td>
                                <td>Rp <?= rupiah($transaksi['total']) ?></td>
                                <td>Rp <?= rupiah($transaksi['denda']) ?></td>
                                <td>Rp <?= rupiah($transaksi['total']+$transaksi['denda']) ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <br>
            <!-- <div class="text-center"> -->
                <a href="<?= base_url() ?>admin/transaksi" class="btn btn-sm btn-secondary">Kembali</a>
            <!-- </div> -->
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<!-- Ini beneran baru -->
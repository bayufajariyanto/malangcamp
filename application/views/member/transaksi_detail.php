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
                    <p class="card-text"><?= date('d F Y | H:i', $transaksi['tanggal_order']) ?></p>
                </div>
            </div>
            <div class="row">
                <p class="col-sm-2">Tanggal Pembayaran</p>
                <div class="col-sm-10">
                    <p class="card-text"><?= date('d F Y | H:i', $transaksi['tanggal_bayar']) ?></p>
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
                                <td><?= date('d F Y | H:i', $transaksi['tanggal_sewa']) ?></td>
                                <td><?= date('d F Y | H:i', $transaksi['batas_kembali']) ?></td>
                                <td><?= date('d F Y | H:i', $transaksi['tanggal_kembali']) ?></td>
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
                <a href="<?= base_url() ?>member/transaksi" class="btn btn-sm btn-secondary">Kembali</a>
            <!-- </div> -->
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<!-- Ini beneran baru -->
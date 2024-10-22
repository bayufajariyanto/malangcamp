<?php
function rupiah($angka)
{
  return number_format($angka, 0, '.', '.');
}
if($baris['selesai'] == 0 && $baris['konfirmasi'] == 1){
  $status = 'Berjalan';
}else if($baris['selesai'] == 1) {
  $status = 'Selesai';
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
                <p class="card-text"><?= $member['nama'] ?></p>
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
            <p class="list-inline-item">Tanggal Sewa</p>
            </div>
            <div class="col-7">
            <div class="list-inline-item">
                <p class="card-text"><?= date('d M Y | H:i:s', $baris['tanggal_sewa']) ?></p>
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
            <p class="list-inline-item text-wrap text-truncate" style="max-width: auto;">Batas Pengembalian</p>
            </div>
            <div class="col-7">
            <div class="list-inline-item">
                <p class="card-text"><?= date('d M Y | H:i:s', $baris['batas_kembali']) ?></p>
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
            <p class="list-inline-item">Tanggal Pengembalian</p>
            </div>
            <div class="col-7">
            <div class="list-inline-item">
                <p class="card-text"><?= date('d M Y | H:i:s', $baris['tanggal_kembali']) ?> <?= $batas ?></p>
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
                <p class="card-text"><?= $status ?></p>
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
            <p class="list-inline-item">Denda</p>
            </div>
            <div class="col-7">
            <div class="list-inline-item">
                <p class="card-text">Rp <?= rupiah($denda) ?></p>
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
            <p class="list-inline-item">Total</p>
            </div>
            <div class="col-7">
            <div class="list-inline-item">
                <h5 class="card-title"><small>Rp</small> <?= rupiah($total) ?></h5><!-- Jumlah semua sub total -->
            </div>
            </div>
        </div>
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
                    <th>Kondisi</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>Nama Barang</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>Sub Total</th>
                    <th>Kondisi</th>
                </tr>
                </tfoot>
                <tbody>
                <?php
                    foreach($transaksi as $t) :
                        switch ($t['kondisi_barang']) {
                            case 1:
                                $kondisi = 'Baik';
                                break;
                            case 2:
                                $kondisi = 'Rusak';
                                break;
                            case 3:
                                $kondisi = 'Hilang';
                                break;                            
                            default:
                                $kondisi = 'Tidak terdeteksi';
                                break;
                        }
                ?>
                <tr>
                    <td><?= $t['nama'] ?></td>
                    <td><?= $t['jumlah_barang'] ?></td>
                    <td>Rp <?= rupiah($t['harga']) ?></td>
                    <td>Rp <?= rupiah($t['harga']*$t['jumlah_barang']) ?></td>
                    <td><?= $kondisi ?></td>
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
            <a href="<?= base_url() ?>admin/transaksi" class="btn btn-sm btn-secondary">Kembali</a>
        <!-- </div> -->
    </div>
  </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
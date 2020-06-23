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
    <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
  </div>

  <!-- Content Row -->


  <!-- DataTales Example -->
  <div class="card shadow-sm mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Data Riwayat <?= $title ?></h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Kode Transaksi</th>
              <th>Username</th>
              <th>Tanggal Order</th>
              <th>Tanggal Kembali</th>
              <th>Total</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Kode Transaksi</th>
              <th>Username</th>
              <th>Tanggal Order</th>
              <th>Tanggal Kembali</th>
              <th>Total</th>
              <th>Aksi</th>
            </tr>
          </tfoot>
          <tbody>
            <?php foreach ($transaksi as $p) :
              if ($p['status'] == 1) {
                $status = 'Lunas';
              } else {
                $status = 'Belum Lunas';
              }
            ?>
              <tr>
                <td><?= $p['kode_transaksi'] ?></td>
                <td><?= $p['username'] ?></td>
                <td><?= date('d F Y', $p['tanggal_order']) ?></td>
                <td><?= date('d F Y', $p['tanggal_kembali']) ?></td>
                <td>Rp <?= rupiah($p['total']+$p['denda']) ?></td>
                <td><a href="<?= base_url('member/transaksi_detail/'.$p['kode_transaksi']) ?>" class="btn btn-primary">Detail</a></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!-- Content Row -->

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
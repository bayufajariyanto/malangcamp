<?php
function rupiah($angka)
{
  return number_format($angka, 0, '.', '.');
}
?>
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
  </div>
  <!-- Button trigger modal -->

  <?= $this->session->flashdata('message'); ?>

  <!-- Content Row -->

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Data <?= $title ?></h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Username</th>
              <th>Tanggal Sewa</th>
              <th>Tanggal Pengembalian</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Username</th>
              <th>Tanggal Sewa</th>
              <th>Tanggal Pengembalian</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </tfoot>
          <tbody>
            <?php
            foreach ($peminjaman as $p) :
            ?>
              <tr>
                <td><?= $p['username'] ?></td>
                <td><?= date('d F Y | H:i', $p['tanggal_sewa']) ?></td>
                <td><?= date('d F Y | H:i', $p['batas_kembali']) ?></td>
                <!-- <td>Rp <?= rupiah($total[$p['kode_transaksi']]) ?></td> -->
                <td><?= $batas ?></td>
                <td><a href="<?= base_url() ?>admin/peminjaman_detail/<?= $p['kode_transaksi'] ?>" class="btn btn-primary">Detail</a></td>
              </tr>
            <?php
            endforeach;
            ?>
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
<?php
function rupiah($angka)
{
  return number_format($angka, 0, '.', '.');
}

foreach($pesanan as $p):
  if($p['tanggal_order']+(60*60)<time() && $p['status'] != 1){
    redirect(base_url('member/pesanan_batal/'.$p['id']));
  }
endforeach;
?>
  <!-- Begin Page Content -->
  <div class="container">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Pesanan</h1>
      <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
    </div>

    <!-- Content Row -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Pesanan</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Tanggal Order</th>
                <th>Total</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Tanggal Order</th>
                <th>Total</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </tfoot>
            <tbody>
            <?php foreach($pesanan as $p) : ?>
              <tr>
                <td><?= date('d F Y', $p['tanggal_order']) ?></td>
                <td>Rp <?= rupiah($p['total']) ?></td>
                <td>Lunas</td>
                <td><a href="<?= base_url() ?>member/pesanan_detail/<?= $p['id'] ?>" class="btn btn-primary">Detail</a></td>
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
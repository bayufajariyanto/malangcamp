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
  <div class="row ml-1 my-3">
    <p class="my-auto">Show by</p>
    <div class="col-auto my-1">
      <label class="mr-sm-2 sr-only" for="customselect">Cari berdasarkan</label>
      <select class="custom-select mr-sm-2" id="customselect">
        <option selected value="1">Hari ini</option>
        <option value="2">3 hari terakhir</option>
        <option value="3">7 hari terakhir</option>
        <option value="4">1 bulan terakhir</option>
        <option value="5">Semua Transaksi</option>
      </select>
    </div>
  </div>

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
              <th>Aksi</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Kode Transaksi</th>
              <th>Username</th>
              <th>Tanggal Order</th>
              <th>Tanggal Kembali</th>
              <th>Aksi</th>
            </tr>
          </tfoot>
          <tbody id="konten">
            <?php
            foreach ($transaksi as $p) :
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
                <td><a href="<?= base_url('admin/transaksi_detail/' . $p['kode_transaksi']) ?>" class="btn btn-primary">Detail</a></td>
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
<script>
  var select = document.getElementById('customselect');
  var konten = document.getElementById('konten');
  select.addEventListener('change', function() {
    var int = select.value;
    // buat objek ajax
    var xhr = new XMLHttpRequest();

    // cek kesiapan ajax
    xhr.onreadystatechange = function() {
      if (xhr.readyState == 4 && xhr.status == 200) {
        konten.innerHTML = xhr.responseText;
    console.log(xhr.responseText);
      } else if (xhr.status == 500) {
        konten.innerHTML = '<?php foreach ($transaksi as $p) : if ($p['status'] == 1) {$status = 'Lunas';} else {$status = 'Belum Lunas';} ?><tr><td><?= $p['kode_transaksi'] ?></td><td><?= $p['username'] ?></td><td><?= date('d F Y', $p['tanggal_order']) ?></td><td><?= date('d F Y', $p['tanggal_kembali']) ?></td><td><a href="<?= base_url('admin/transaksi_detail/' . $p['kode_transaksi']) ?>"class="btn btn-primary">Detail</a></td></tr><?php endforeach; ?>';
      }
    }

    xhr.open('GET', 'search/' + int, true);
    // eksekusi ajax
    xhr.send();
  });
</script>
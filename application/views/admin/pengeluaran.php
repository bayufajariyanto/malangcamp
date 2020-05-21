  <hr class="mt-5 mb-5">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Pengeluaran</h1>
    <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#tambahPengeluaran"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Pengeluaran</button>
  </div>

  <div class="modal fade" id="tambahPengeluaran" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Tambah Pengeluaran</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="post" action="<?= base_url('admin/index'); ?>">
          <div class="modal-body">
            <div class="form-group">
              <label for="nama">Nama</label>
              <input type="text" class="form-control" name="nama" id="nama" value="<?= set_value('nama'); ?>" placeholder="cth: Nama Karyawan, Perawatan, dll">
              <?= form_error('nama', '<small class="text-danger pl-2">', '</small>') ?>
            </div>
            <div class="form-group">
              <label for="kategori">Kategori</label>
              <select class="form-control" id="kategori" name="kategori">
              <?php foreach($kategori_pengeluaran as $k): ?>
                <option><?= $k['nama'] ?></option>
              <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="nominal">Nominal</label>
              <input type="number" class="form-control" name="nominal" id="nominal" value="<?= set_value('nominal'); ?>" placeholder="Rp xxx">
              <?= form_error('nominal', '<small class="text-danger pl-2">', '</small>') ?>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Content Row -->
  <div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Hari ini</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">Rp <?= rupiah($pengeluaran_hari_ini) ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-calendar fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Bulan ini</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">Rp <?= rupiah($pengeluaran_mei) ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Gaji Karyawan (Bulan Ini)</div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">Rp <?= rupiah($karyawan) ?></div>
                </div>
                <!-- <div class="col">
                          <div class="progress progress-sm mr-2">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50"
                              aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div> -->
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Perawatan (Bulan Ini)</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">Rp <?= rupiah($perawatan) ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-users fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <!-- Area Chart -->
    <div class="col-xl-8 col-lg-7">
      <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Pengeluaran (Tahunan)</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
          <div class="chart-area">
            <canvas id="myAreaChartPengeluaran"></canvas>
          </div>
        </div>
      </div>
    </div>

    <!-- Pie Chart -->
    <div class="col-xl-4 col-lg-5">
      <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Kategori Pengeluaran</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
          <div class="chart-pie pt-4 pb-2">
            <canvas id="myPieChartPengeluaran"></canvas>
          </div>
          <div class="mt-4 text-center small">
            <span class="mr-2">
              <i class="fas fa-circle text-primary"></i> Gaji
            </span>
            <span class="mr-2">
              <i class="fas fa-circle text-success"></i> Perawatan
            </span>
            <span class="mr-2">
              <i class="fas fa-circle text-info"></i> Lainnya
            </span>
          </div>
        </div>
      </div>
    </div>

  </div>
  <!-- Content Row -->

  


  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Pengeluaran</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="pengeluaran" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>#</th>
              <th>Nama</th>
              <th>Tanggal</th>
              <!-- <th>Kategori</th> -->
              <th>Jumlah</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>#</th>
              <th>Nama</th>
              <th>Tanggal</th>
              <!-- <th>Kategori</th> -->
              <th>Jumlah</th>
            </tr>
          </tfoot>
          <tbody>
          <?php $no = 1; foreach($pengeluaran as $p) : ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= $p['nama'] ?></td>
              <td><?= date('d F Y | H:i', $p['tanggal']) ?></td>
              <!-- <td></td> -->
              <td>Rp <?= rupiah($p['nominal']) ?></td>
            </tr>
          <?php endforeach;?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
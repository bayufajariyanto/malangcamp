<?php
function rupiah($angka)
{
  return number_format($angka, 0, '.', '.');
}
$jumlah = 0;
$jumlah_barang = 0;
foreach($member as $m ){
  $jumlah++;
}
foreach($disewa as $d ){
  $jumlah_barang = $jumlah_barang+$d['jumlah_barang'];
}

?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Pendapatan</h1>
    <!-- <a href="#" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Tambah Data</a> -->
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
              <div class="h5 mb-0 font-weight-bold text-gray-800">Rp <?= rupiah($hari_ini) ?></div>
              <!-- <div class="h5 mb-0 font-weight-bold text-gray-800">Rp 234.000</div> -->
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
              <div class="h5 mb-0 font-weight-bold text-gray-800">Rp <?= rupiah($bulan_ini) ?></div>
              <!-- <div class="h5 mb-0 font-weight-bold text-gray-800">Rp 2.950.000</div> -->
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
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Barang Disewa (saat ini)</div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <!-- <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">12</div> -->
                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $jumlah_barang ?></div>
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
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Member Terdaftar</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah ?></div>
              <!-- <div class="h5 mb-0 font-weight-bold text-gray-800">24</div> -->
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
          <h6 class="m-0 font-weight-bold text-primary">Pendapatan (Tahunan)</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
          <div class="chart-area">
            <canvas id="myAreaChart"></canvas>
          </div>
        </div>
      </div>
    </div>

    <!-- Pie Chart -->
    <div class="col-xl-4 col-lg-5">
      <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Sumber Pendapatan (Tahunan)</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
          <div class="chart-pie pt-4 pb-2">
            <canvas id="myPieChart"></canvas>
          </div>
          <div class="mt-4 text-center small">
            <span class="mr-2">
              <i class="fas fa-circle text-primary"></i> Sewa
            </span>
            <span class="mr-2">
              <i class="fas fa-circle text-success"></i> Denda
            </span>
            <!-- <span class="mr-2">
              <i class="fas fa-circle text-info"></i> Referral
            </span> -->
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Content Row -->
    

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Pendapatan</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="pendapatan" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>#</th>
              <th>Nama</th>
              <th>Tanggal</th>
              <th>Nominal</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>#</th>
              <th>Nama</th>
              <th>Tanggal</th>
              <th>Nominal</th>
            </tr>
          </tfoot>
          <tbody>
          <?php $no=1;foreach($pesanan as $p) : ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= $p['username'] ?></td>
              <td><?= date('d F Y | H:i', $p['tanggal_bayar']) ?></td>
              <td>Rp <?= rupiah($p['total']+$p['denda']) ?></td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  

<!-- </div> -->
<!-- /.container-fluid -->

<!-- </div> -->
<!-- End of Main Content -->
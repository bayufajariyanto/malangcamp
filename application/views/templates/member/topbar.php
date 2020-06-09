<?php
function inirupiah($angka)
{
  return number_format($angka, 0, '.', '.');
}
function jumlahKeranjang($angka, $buka = '', $tutup = ''){
  if($angka<=0){
    $output = '';
  }else{
    $output = $buka.$angka.$tutup;
  }
  return $output;
}
?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

  <!-- Main Content -->
  <div id="content">

    <!-- Topbar -->
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

      <!-- Sidebar Toggle (Topbar) -->
      <!-- <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button> -->


      <!-- Sidebar - Brand -->
      <a class="navbar-brand d-flex align-items-center mr-auto text-decoration-none text-reset" href="<?= base_url('member') ?>">
          <div class="navbar-brand mx-3 text-primary">
              <i class="fas fa-mountain"></i>
              <!-- <img src="<?= base_url('assets/img/logo.svg') ?>" class="img-fluid" alt="logo"> -->
          </div>
          <div class="sidebar-brand-text">Malang Camp</div>
      </a>
      <!-- Topbar Navbar -->
      <ul class="navbar-nav ml-auto">
        <!-- Nav Item - Messages -->
        <li class="nav-item dropdown no-arrow mx-1">
          <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-shopping-cart"></i>
            <!-- Counter - Messages -->
            <span class="badge badge-danger badge-counter"><?= jumlahKeranjang(count($topkeranjang)) ?></span>
          </a>
          <!-- Dropdown - Messages -->
          <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
            <h6 class="dropdown-header">
              Keranjang <?= jumlahKeranjang(count($topkeranjang),'(',')') ?>
            </h6>
            <?php
            if(count($topkeranjang) <=0 ){
              ?>
              <p class="text-center my-3 text-gray-500">Keranjang anda kosong</p>
            <?php } ?>
            <?php
            $tmp = 1;
            // $panjang = 1;
            // var_dump(count($topkeranjang));die;
            foreach($topkeranjang as $t) : if($tmp++>3) break ?>
            <a class="dropdown-item d-flex align-items-center" href="<?= base_url('member/keranjang') ?>">
              <div class="dropdown-list-image mr-3">
                <img class="rounded-circle" src="<?= base_url('assets/img/') ?><?= $t['nama'] ?>.png" alt="barang">
                <!-- <div class="status-indicator bg-success"></div> -->
              </div>
              <div>
                <div class="d-inline-block text-truncate" style="max-width: 150px;"><?= $t['nama'] ?></div>
                <div class="small text-gray-500"><?= $t['jumlah'] ?> Barang</div>
              </div>
              <div class="ml-auto">
                <div class="text-info font-weight-bolder text-nowrap">Rp <?= inirupiah($t['harga']) ?></div>
              </div>
            </a>
            <?php endforeach; ?>
            <a class="dropdown-item text-center small text-gray-500" href="<?= base_url('member/keranjang') ?>">Lihat Keranjang</a>
          </div>
        </li>
        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-lg-inline text-gray-600 small"><?= $user['nama'] ?></span>
            <img class="img-profile rounded-circle" src="<?= base_url('assets/img/') ?>default.png">
          </a>
          <!-- Dropdown - User Information -->
          <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="<?= base_url('member/profile') ?>">
              <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
              Profile
            </a>
            <!-- <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Activity Log
                </a> -->
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
              <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
              Logout
            </a>
          </div>
        </li>

      </ul>

    </nav>
    <!-- End of Topbar -->
<?php
if($this->session->userdata('role_id') == 1){
    $session = 'admin';
}else{
    $session = 'member';
}
?>

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('admin') ?>">
        <div class="sidebar-brand-icon">
            <i class="fas fa-mountain"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Malang Camp</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <?php
          $dashboard = null;
          $member = null;
          $barang = null;
          $pesanan = null;
          $peminjaman = null;
          $transaksi = null;
          switch($select){
            case 'index': 
              $dashboard = 'active';
            break;
            case null: 
              $dashboard = 'active';
            break;
            case 'member': 
              $member = 'active';
            break;
            case 'barang': 
              $barang = 'active';
            break;
            case 'pesanan': 
              $pesanan = 'active';
            break;
            case 'peminjaman': 
              $peminjaman = 'active';
            break;
            case 'transaksi': 
              $transaksi = 'active';
            break;
            default:
              $aktif = '';
          }
          ?>
    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?= $dashboard ?>">
        <a class="nav-link" href="<?= base_url('admin') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Manajemen
    </div>

    <!-- Nav Item - Charts -->
    <li class="nav-item <?= $member ?>">
        <a class="nav-link" href="<?= base_url('admin/member') ?>">
            <i class="fas fa-fw fa-users"></i>
            <span>Member</span></a>
    </li>

    <!-- Nav Item - Charts -->
    <li class="nav-item <?= $barang ?>">
        <a class="nav-link" href="<?= base_url('admin/barang') ?>">
            <i class="fas fa-fw fa-campground"></i>
            <span>Barang</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item <?= $pesanan ?>">
        <a class="nav-link" href="<?= base_url('admin/pesanan') ?>">
            <i class="fas fa-fw fa-phone-alt"></i>
            <span>Pesanan</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item <?= $peminjaman ?>">
        <a class="nav-link" href="<?= base_url('admin/peminjaman') ?>">
            <!-- <i class="fas fa-fw fa-calendar"></i> -->
            <i class="fas fa-fw fa-truck-loading"></i>
            <span>Sedang Disewa</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item <?= $transaksi ?>">
        <a class="nav-link" href="<?= base_url('admin/transaksi') ?>">
            <i class="far fa-fw fa-calendar-check"></i>
            <span>Transaksi Selesai</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
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
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('member') ?>">
        <div class="sidebar-brand-icon">
            <i class="fas fa-mountain"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Malang Camp</div>
    </a>

    <!-- Heading -->
    <div class="sidebar-heading">
        Menu
    </div>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('member/barang') ?>">
            <i class="fas fa-fw fa-campground"></i>
            <span>Barang</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('member/pesanan') ?>">
            <i class="fas fa-fw fa-phone-alt"></i>
            <span>Pesanan</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('member/peminjaman') ?>">
            <i class="fas fa-fw fa-calendar"></i>
            <span>Proses Peminjaman</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('member/transaksi') ?>">
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
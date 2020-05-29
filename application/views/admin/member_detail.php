<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
    </div>
    <!-- Button trigger modal -->
    <?= $this->session->flashdata('message'); ?>
    <div class="card w-75">
        <div class="card-body">
            <h5 class="card-title"><?= $user['nama'] ?>&nbsp;(<?= $user['username'] ?>)</h5>
            <br>
            <div class="row">
                <p class="col-sm-2">Identitas</p>
                <div class="col-sm-10">
                    <p class="card-text"><?= $user['jenis_kitas'] ?>&nbsp;<?= $user['no_kitas'] ?></p>
                </div>
            </div>
            <div class="row">
                <p class="col-sm-2">Alamat</p>
                <div class="col-sm-10">
                    <p class="card-text"><?= $user['alamat'] ?></p>
                </div>
            </div>
            <div class="row">
                <p class="col-sm-2">Nomor Telepon</p>
                <div class="col-sm-10">
                    <p class="card-text"><?= $user['telp'] ?></p>
                </div>
            </div>
            <br>
            <div class="row">
                <p class="col-sm-2 text-muted">Tanggal Daftar</p>
                <div class="col-sm-10">
                    <p class="card-text text-muted">Member sejak <?= date('d F Y | H:i:s', $user['date_created']); ?></p>
                </div>
            </div>
            <br>
            <a href="<?= base_url() ?>admin/member" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">Kembali</a>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
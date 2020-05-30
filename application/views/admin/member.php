<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
    <button type="button" class="mt-2 d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#tambahMember"><i class="fas fa-download fa-sm text-white-50"></i> Tambah Member</button>
    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
      Launch static backdrop modal
    </button> -->
  </div>
  <!-- Button trigger modal -->
  <?= $this->session->flashdata('message'); ?>
  <!-- Modal -->
  <div class="modal fade" id="tambahMember" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Tambah Member</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="post" action="<?= base_url('admin/member'); ?>">
          <div class="modal-body">
            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" class="form-control" name="username" id="username" value="<?= set_value('username'); ?>" placeholder="Username anda...">
              <?= form_error('username', '<small class="text-danger pl-2">', '</small>') ?>
            </div>
            <div class="form-group">
              <label for="telp">No. Telepon</label>
              <input type="text" class="form-control" max="12" name="telp" id="telp" value="<?= set_value('telp'); ?>" placeholder="08xxxxxxxxxx">
              <?= form_error('telp', '<small class="text-danger pl-2">', '</small>') ?>
            </div>
            <div class="form-group">
              <label for="kitas">Kartu Identitas</label>
              <select class="form-control" id="kitas" name="kitas">
                <option>KTP</option>
                <option>KTM</option>
                <option>SIM</option>
              </select>
            </div>
            <div class="form-group">
              <label for="nama">Nama Lengkap</label>
              <input type="text" class="form-control" name="nama" id="nama" value="<?= set_value('nama'); ?>" placeholder="Nama lengkap">
              <?= form_error('nama', '<small class="text-danger pl-2">', '</small>') ?>
            </div>
            <div class="form-group">
              <label for="nokitas">Nomor Identitas</label>
              <input type="text" class="form-control" name="nokitas" id="nokitas" value="<?= set_value('nokitas'); ?>" placeholder="Nomor identitas">
              <?= form_error('nokitas', '<small class="text-danger pl-2">', '</small>') ?>
            </div>
            <div class="form-group">
              <label for="alamat">Alamat Identitas</label>
              <input type="text" class="form-control" name="alamat" id="alamat" value="<?= set_value('alamat'); ?>" placeholder="Alamat sesuai identitas">
              <?= form_error('alamat', '<small class="text-danger pl-2">', '</small>') ?>
            </div>
            <div class="form-group">
              <label for="password1">Password</label>
              <input type="password" class="form-control" name="password1" id="password1">
              <?= form_error('password1', '<small class="text-danger pl-2">', '</small>') ?>
            </div>
            <div class="form-group">
              <label for="password2">Konfirmasi Password</label>
              <input type="password" class="form-control" name="password2" id="password2">
              <?= form_error('password2', '<small class="text-danger pl-2">', '</small>') ?>
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
              <th>Nama</th>
              <th>No Telp</th>
              <th>Alamat</th>
              <th>Tanggal Daftar</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Username</th>
              <th>Nama</th>
              <th>No Telp</th>
              <th>Alamat</th>
              <th>Tanggal Daftar</th>
              <th>Aksi</th>
            </tr>
          </tfoot>
          <tbody>
            <?php
            foreach ($member as $m) :
            ?>
              <tr>
                <td><?= $m['username']; ?></td>
                <td><?= $m['nama']; ?></td>
                <td><?= $m['telp']; ?></td>
                <td><?= $m['alamat']; ?></td>
                <td><?= date('d F Y', $m['date_created']); ?></td>
                <td>
                  <a href="<?= base_url() ?>admin/member_detail/<?= $m['id'] ?>" class="badge badge-primary badge-sm">Detail</a>
                  <a href="<?= base_url() ?>admin/member_edit/<?= $m['id'] ?>" class="badge badge-success badge-sm">Edit</a>
                  <a href="<?= base_url() ?>admin/member_hapus/<?= $m['id'] ?>" class="badge badge-danger badge-sm tombol-hapus">Hapus</a>
                </td>
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
<!-- Logout Modal-->
<div class="modal fade" id="hapusmember" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Yakin Hapus Member?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Pilih "Hapus" untuk menghapus "<?= $m['nama'] ?>".</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Tutup</button>
        <a class="btn btn-primary" href="<?= base_url('admin/member_hapus/' . $m['username']); ?>">Hapus</a>
      </div>
    </div>
  </div>
</div>
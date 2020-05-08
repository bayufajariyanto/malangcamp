<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
    <button type="button" class="mt-2 d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#tambahBarang"><i class="fas fa-download fa-sm text-white-50"></i> Tambah Barang</button>
    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
      Launch static backdrop modal
    </button> -->
  </div>
  <!-- Button trigger modal -->
  <?= $this->session->flashdata('message'); ?>
  <!-- Modal -->
  <div class="modal fade" id="tambahBarang" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Tambah <?= $title ?></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="post" action="<?= base_url('admin/barang'); ?>">
          <div class="modal-body">
            <div class="form-group">
              <label for="nama">Nama</label>
              <input type="text" class="form-control" name="nama" id="nama" value="<?= set_value('nama'); ?>" placeholder="Nama Barang">
              <?= form_error('nama', '<small class="text-danger pl-2">', '</small>') ?>
            </div>
            <div class="form-group">
              <label for="kategori">Kategori</label>
              <select class="form-control" id="kategori" name="kategori">
              <?php foreach($kategori as $k): ?>
                <option><?= $k['nama']; ?></option>
              <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="stok">Stok</label>
              <input type="text" class="form-control" max="3" name="stok" id="stok" value="<?= set_value('stok'); ?>" placeholder="Jumlah barang">
              <?= form_error('stok', '<small class="text-danger pl-2">', '</small>') ?>
            </div>
            <div class="form-group">
              <label for="harga">Harga</label>
              <input type="text" class="form-control" name="harga" id="harga" value="<?= set_value('harga'); ?>" placeholder="Harga barang">
              <?= form_error('harga', '<small class="text-danger pl-2">', '</small>') ?>
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
              <th>No.</th>
              <th>Nama</th>
              <th>Kategori</th>
              <th>Stok</th>
              <th>Harga per hari</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>No.</th>
              <th>Nama</th>
              <th>Kategori</th>
              <th>Stok</th>
              <th>Harga per hari</th>
              <th>Aksi</th>
            </tr>
          </tfoot>
          <tbody>
            <?php
            $no = 0;
            foreach ($barang as $b) :
              $no++;
            ?>
              <tr>
                <td><?= $no; ?></td>
                <td><?= $b['nama']; ?></td>
                <td><?= $b['kategori']; ?></td>
                <td><?= $b['stok']; ?></td>
                <td>Rp. <?= $b['harga']; ?></td>
                <td>
                  <a href="<?= base_url() ?>admin/barang_edit/<?= $b['id'] ?>" class="badge badge-success badge-sm">Edit</a>
                  <a href="<?= base_url() ?>admin/barang_hapus/<?= $b['id'] ?>" class="badge badge-danger badge-sm tombol-hapus">Hapus</a>
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
<div class="modal fade" id="hapusbarang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <?= var_dump($b['id']) ?>
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Yakin Hapus Barang?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Pilih "Hapus" untuk menghapus "<?= $b['nama'] ?>".</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-primary" href="<?= base_url('admin/barang_hapus/' . $b['id']); ?>">Hapus</a>
      </div>
    </div>
  </div>
</div>
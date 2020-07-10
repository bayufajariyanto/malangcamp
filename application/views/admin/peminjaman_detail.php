<?php
function rupiah($angka)
{
  return number_format($angka, 0, '.', '.');
}
if($baris['selesai'] == 0 && $baris['konfirmasi'] == 1){
  $status = 'Berjalan';
}else if($baris['selesai'] == 1) {
  $status = 'Selesai';
}
?>

<!-- Begin Page Content -->
<div class="container">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>

  </div>
  <!-- Button trigger modal -->
  <div class="card">
    <div class="card-body container-fluid">
      <br>
      <div class="row">
        <div class="col-4">
          <p class="list-inline-item">Kode Transaksi</p>
        </div>
        <div class="col-7">
          <div class="list-inline-item">
            <h5 class="card-title"><?= $baris['kode_transaksi'] ?></h5>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-4">
          <p class="list-inline-item">Nama</p>
        </div>
        <div class="col-7">
          <div class="list-inline-item">
            <p class="card-text"><?= $member['nama'] ?></p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-4">
          <p class="list-inline-item">Tanggal Sewa</p>
        </div>
        <div class="col-7">
          <div class="list-inline-item">
            <p class="card-text"><?= date('d M Y | H:i:s', $baris['tanggal_sewa']) ?></p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-4">
          <p class="list-inline-item text-wrap text-truncate" style="max-width: auto;">Batas Pengembalian</p>
        </div>
        <div class="col-7">
          <div class="list-inline-item">
            <p class="card-text"><?= date('d M Y | H:i:s', $baris['batas_kembali']) ?> <?= $batas ?></p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-4">
          <p class="list-inline-item">Durasi Sewa</p>
        </div>
        <div class="col-7">
          <div class="list-inline-item">
            <p class="card-text"><?= $durasi ?> hari</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-4">
          <p class="list-inline-item">Status Pembayaran</p>
        </div>
        <div class="col-7">
          <div class="list-inline-item">
            <p class="card-text"><?= $konfirmasi ?></p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-4">
          <p class="list-inline-item">Status Transaksi</p>
        </div>
        <div class="col-7">
          <div class="list-inline-item">
            <p class="card-text"><?= $status ?></p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-4">
          <p class="list-inline-item">Denda</p>
        </div>
        <div class="col-7">
          <div class="list-inline-item">
            <p class="card-title"><small>Rp</small> <?= rupiah($denda) ?></p><!-- Jumlah semua sub total -->
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-4">
          <p class="list-inline-item">Total</p>
        </div>
        <div class="col-7">
          <div class="list-inline-item">
            <h5 class="card-title"><small>Rp</small> <?= rupiah($total) ?></h5><!-- Jumlah semua sub total -->
          </div>
        </div>
      </div>
      <br>
      <div class="row mx-1">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Nama Barang</th>
                <th>Qty</th>
                <th>Harga</th>
                <th>Sub Total</th>
                <!-- <th>Kondisi Barang</th> -->
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Nama Barang</th>
                <th>Qty</th>
                <th>Harga</th>
                <th>Sub Total</th>
                <!-- <th>Kondisi Barang</th> -->
              </tr>
            </tfoot>
            <tbody>
              <?php
              $baik = null;
              $rusak = null;
              $hilang = null;
                foreach($peminjaman as $p) :
                  // var_dump($p['kondisi_barang']);die;
                switch($p['kondisi']){
                  case 1: 
                    $baik = 'selected';
                    $rusak = '';
                    $hilang = '';
                  break;
                  case 2: 
                    $baik = '';
                    $rusak = 'selected';
                    $hilang = '';
                  break;
                  case 3: 
                    $baik = '';
                    $rusak = '';
                    $hilang = 'selected';
                  break;
                  default: $selected = '';
                }
              ?>
              <tr>
                <td><?= $p['nama'] ?></td>
                <td><?= $p['jumlah_barang'] ?></td>
                <td>Rp <?= rupiah($p['harga']) ?></td>
                <td>Rp <?= rupiah($p['jumlah_barang']*$p['harga']) ?></td><!-- qty*harga -->
                <!-- <td>
                <div class="form-group">
                  <select class="form-control" id="kondisi" name="" value="<?= $p['kondisi'] ?>">
                    <option value="1" <?= $baik ?>>Baik</option>
                    <option value="2" <?= $rusak ?>>Rusak</option>
                    <option value="3" <?= $hilang ?>>Hilang</option>
                  </select>
                </div>
                </td> -->
              </tr>
              <?php
              endforeach;
              ?>
            </tbody>
          </table>
        </div>
      </div>
      <br>
      <div class="text-center">
        <a href="<?= base_url() ?>admin/peminjaman" class="btn btn-sm btn-secondary mx-2">Kembali</a>
        <a href="<?= base_url() ?>admin/peminjaman_selesai/<?= $baris['kode_transaksi'] ?>" class="mx-2 btn btn-sm btn-primary shadow-sm">Selesai</a>
        <button type="button" class="btn btn-sm btn-info shadow-smmx-2 " data-toggle="modal" data-target="#konfirmasiPeminjaman"><img src="<?= base_url('assets/img/broken-glass') ?>.png" width="15px"/> Barang rusak/hilang</button>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<!-- Modal -->
<div class="modal fade" id="konfirmasiPeminjaman" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi Pengembalian</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="<?= base_url() ?>admin/peminjaman_selesai/<?= $baris['kode_transaksi'] ?>">
        <div class="modal-body">
          <?php 
          $i = 0;
          foreach($peminjaman as $pinjam): $i++;
          if($i>=1 && $i < count($peminjaman))
            $batas = '';
          else
            $batas = 'd-none';
          
          ?>
          <div class="form-group">
            <h5 class="font-weight-bold"><?= $pinjam['nama'] ?></h5>
          </div>
          <div class="form-group">
            <label for="kondisi<?= $i ?>">Kondisi Barang</label>
            <select class="form-control" id="kondisi<?= $i ?>" name="kondisi[]" onchange="changeFunc(<?= $i ?>);">
              <option value="1">Baik</option>
              <option value="2">Rusak</option>
              <option value="3">Hilang</option>
            </select>
          </div>
          <div class="form-group d-none" id="denda<?= $i ?>">
            <label for="inputdenda<?= $i ?>">Denda</label>
            <input type="number" class="form-control" name="denda[]" min="0" id="inputdenda<?= $i ?>" aria-describedby="denda" placeholder="Denda" value="0">
          </div>
          <hr class="<?= $batas ?> my-4">
          <?php endforeach; ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
function changeFunc(i) {
    var denda = document.getElementById("denda"+i);
    var inputdenda = document.getElementById("inputdenda"+i);
    var selectBox = document.getElementById("kondisi"+i);
    var selectedValue = selectBox.options[selectBox.selectedIndex].value;
    
    if(selectedValue == 1){
      inputdenda.value = 0;
      denda.classList.add('d-none');
    }else if(selectedValue == 2){
      denda.classList.remove('d-none');
    }else if(selectedValue == 3){
      denda.classList.remove('d-none');
    }
   }
</script>
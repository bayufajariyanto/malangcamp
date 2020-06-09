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
    <!-- <h1 class="h3 mb-0 text-gray-800">Dashboard</h1> -->
    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
  </div>

  <!-- Content Row -->

  <form action="<?= base_url('member/pesanan') ?>" method="post">
  <div class="row">

  <div class="col-lg-3 mb-5">
    <a href="<?= base_url('member/index') ?>" class="text-decoration-none text-reset"><h2 class="my-4">Malang Camp</h2></a>
    <div class="list-group">
      <a href="#" class="list-group-item text-decoration-none list-group-item-action">Category 1</a>
      <a href="#" class="list-group-item text-decoration-none list-group-item-action">Category 2</a>
      <a href="#" class="list-group-item text-decoration-none list-group-item-action">Category 3</a>
    </div>
  </div>
  <!-- /.col-lg-3 -->
  <div class="col-lg-9 my-4">

    <div class="card mb-4">
      <img class="card-img-top img-fluid" src="<?= base_url('assets/img/') ?><?= $rincian['nama'] ?>.png" alt="">
      <div class="card-body">
        <div class="my-4">
          <h3 class="card-title text-gray-800"><?= $rincian['nama'] ?></h3>
        </div>
        <div class="row my-4">
          <div class="col-sm-3">Harga</div>
          <div class="col-sm-9 text-primary font-weight-bolder">
            <h4 class="font-weight-bold">Rp <?= rupiah($rincian['harga']) ?><span id="awal" class="d-none"><?= $rincian['harga'] ?></span></h4>
          </div>
        </div>
        <div class="row my-4">
          <div class="col-sm-3">Kategori</div>
          <div class="col-sm-9"><?= $rincian['kategori'] ?></div>
        </div>
        <div class="row my-4">
          <div class="col-sm-3">Stok Tersedia</div>
          <div class="col-sm-9"><?= $rincian['stok'] ?><span id="stok" class="d-none"><?= $rincian['stok'] ?></span> barang</div>
        </div>
        <!-- <form action=""> -->
        <div class="row my-4">
          <div class="col-sm-3">Jumlah</div>
          <div class="col-sm-9">
            <div class="row">
              <button type="button" onclick="decrease()" class="btn btn-secondary" id="minus">-</button>
                <input type="text" id="jumlah" name="jumlah" onkeyup="hasil()" min="1" max="<?= $rincian['stok'] ?>" value="1" class="form-control-plaintext col-2 text-center" readonly/>
              <button type="button" onclick="increase()" class="btn btn-info" id="plus">+</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /.card -->

    <!-- <div class="card card-outline-secondary my-4">
      <div class="card-header">
        Product Reviews
      </div>
      <div class="card-body">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, similique necessitatibus neque non! Doloribus, modi sapiente laboriosam aperiam fugiat laborum. Sequi mollitia, necessitatibus quae sint natus.</p>
        <small class="text-muted">Posted by Anonymous on 3/1/17</small>
        <hr>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, similique necessitatibus neque non! Doloribus, modi sapiente laboriosam aperiam fugiat laborum. Sequi mollitia, necessitatibus quae sint natus.</p>
        <small class="text-muted">Posted by Anonymous on 3/1/17</small>
        <hr>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, similique necessitatibus neque non! Doloribus, modi sapiente laboriosam aperiam fugiat laborum. Sequi mollitia, necessitatibus quae sint natus.</p>
        <small class="text-muted">Posted by Anonymous on 3/1/17</small>
        <hr>
        <a href="#" class="btn btn-success">Leave a Review</a>
      </div>
    </div> -->
    <!-- /.card -->

  </div>
  <!-- /.col-lg-9 -->

</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<nav class="navbar fixed-bottom navbar-light bg-white overflow-auto" style="background-color: #e3f2fd;">
  <div class="container">

    <a class="navbar-brand my-n1 mb-n3" href="#"><?= $rincian['nama'] ?></a>
    <div class="row my-2">
      <div class="col-auto mt-1 mr-2">
        <p class="my-0">Total</p>
        <h5 class="my-0 font-weight-bolder text-gray-900" id="total" name="total" value="<?= $rincian['harga'] ?>">Rp <?= rupiah($rincian['harga']) ?></h5>
      </div>
      <div class="col-auto mx-n1 my-2">
        <a href="<?= base_url('member/keranjang') ?>" class="btn btn-outline-info mx-1"><i class="fas fa-cart-arrow-down"></i> Pesan</a>
        <button type="submit" class="btn btn-info mx-1" formaction="<?= base_url('member/tambahkeranjang/') ?><?= $rincian['id'] ?>"><i class="fas fa-cart-plus"></i> Tambah Ke Keranjang</button>
      </div>
    </div>

  </div>
  <!-- Akhir Container -->
</nav>
</form>

<script>
let counter = 1;
let plus = document.getElementById("plus");
let minus = document.getElementById("minus");
let jumlah = document.getElementById("jumlah");
let total = document.getElementById("total");
let awal = document.getElementById("awal");
let stok = document.getElementById("stok").innerHTML;

function increase() {
  if (counter<stok) {
    counter += 1;
    jumlah.value = counter;
    total.innerHTML = 'Rp '+rupiah(jumlah.value*awal.innerHTML);
    minus.classList.remove('btn-secondary');
    minus.classList.add('btn-info');
  }
  if(counter==stok){
    plus.classList.remove('btn-info');
    plus.classList.add('btn-secondary');
  }
}

function decrease() {
  if(counter>1){
    counter -= 1;
    jumlah.value = counter;
    total.innerHTML = 'Rp '+rupiah(jumlah.value*awal.innerHTML);
    plus.classList.remove('btn-secondary');
    plus.classList.add('btn-info');
  }
  if(counter==1){
    minus.classList.remove('btn-info');
    minus.classList.add('btn-secondary');
  }
}

function rupiah(angka){
   var reverse = angka.toString().split('').reverse().join(''),
   ribuan = reverse.match(/\d{1,3}/g);
   ribuan = ribuan.join('.').split('').reverse().join('');
   return ribuan;
 }
</script>
<?php
function rupiah($angka)
{
  return number_format($angka, 0, '.', '.');
}
?>
<!-- Begin Page Content -->
<div class="container">
  <style>
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }
    input.jumlah:read-only {
      background-color: white;
    }

    /* Firefox */
    input[type=number] {
      -moz-appearance: textfield;
    }
  </style>
  <!-- Page Heading -->
  <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4"> -->
    <!-- <h1 class="h3 mb-0 text-gray-800">Dashboard</h1> -->
    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
  <!-- </div> -->

  <!-- Content Row -->
  <?= $this->session->flashdata('message'); ?>

  <form action="<?= base_url('member/tambahpesanan') ?>" method="post">
  <div class="row" ng-app="myApp" ng-controller="myCtrl">

  <!-- /.col-lg-3 -->
  <div class="col-lg-8 my-3">
    <!-- /.card -->

    <div class="card card-outline-secondary my-3">
      <div class="card-body">
        <?php 
        // $total = 0;
        // foreach($keranjang as $k) : 
        // $total = $total + ($k['harga']*$k['jumlah']); ?>
        <div class="row mb-5" ng-repeat="n in [] | range:keranjang.length track by $index">
          <div class="col-md-4">
              <img src="<?= base_url('assets/img/') ?>{{ keranjang[$index]['nama'] }}.png" alt="barang" class="img-thumbnail">
          </div>
          <div class="col-md-7 mt-2">
            <h4 class="text-grey-900"><input type="text" name="id[]" class="d-none" value="{{ keranjang[$index]['id'] }}" id="nama">{{ keranjang[$index]['nama'] }}</h4>
            <p class="card-text stok">{{ keranjang[$index]['stok'] }} barang</p>
            <p class="card-text font-weight-bold text-info">{{ keranjang[$index]['harga'] | noFractionCurrency}}</p>
            <div class="row">
            <button type="button" ng-click="kurangi($index,$event)" class="btn minus">-</button>
            <div class="col-md-4 col-sm-4">
            <input type="number" class="form-control text-center jumlah" size="2" name="jumlah[]" value="{{ keranjang[$index]['jumlah'] }}" readonly>
            </div>
            <button type="button" ng-click="tambah($index,$event)" class="btn plus">+</button>
            </div>
            <!-- <small class="text-muted">Posted by Anonymous on 3/1/17</small> -->
          </div>
          <div class="col-1">
            <a  href="<?= base_url('member/hapus_keranjang/') ?>{{ keranjang[$index]['id'] }}" class="btn"><i class="fas fa-trash-alt"></i></a>
          </div>
        </div>
        <!-- <div class="my-3"></div> -->
        <?php
        // endforeach; ?>
        <!-- <a href="#" class="btn btn-success">Leave a Review</a> -->
      </div>
    </div>
    <!-- /.card -->

  </div>
  <!-- /.col-lg-9 -->

  <div class="col-lg-4 my-3">
    <div class="card my-3">
      <div class="card-header">
          Ringkasan Pesanan
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col mt-1">
            Durasi sewa (hari)
          </div>
          <div class="col">
            <input type="number" class="form-control text-center" size="2" name="hari" min="1" ng-model="durasi" value="{{ durasi }}">
          </div>
        </div>
        <hr>
        <div class="row" ng-repeat="n in [] | range:keranjang.length track by $index">
          <div class="col">
            <div class="text-truncate" style="max-width:170px">{{ keranjang[$index]['nama'] }}</div>
            <p>x {{ keranjang[$index]['jumlah'] }}</p>
          </div>
          <div class="col my-2">
            <!-- <div ng-repeat="n in [] | range:keranjang.length track by $index"> -->
            <div class="ml-auto text-right text-primary font-weight-bold">{{ keranjang[$index]['harga']*keranjang[$index]['jumlah'] | noFractionCurrency}}</div>
            <!-- </div> -->
          </div>
        </div>
        <hr class="mt-0">
        <div class="row mt-3">
          <div class="col">
            <div class="text-truncate" style="max-width:200px">Total Harga</div>
          </div>
          <div class="col">
            <!-- <div ng-repeat="n in [] | range:keranjang.length track by $index"> -->
            <div class="ml-auto text-right text-primary font-weight-bold">{{ total() | noFractionCurrency}}</div>
            <!-- </div> -->
          </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block my-3 text-center">Pesan <?= jumlahKeranjang(count($topkeranjang),'(',')')?></button>
        <!-- <hr> -->
        <small class="text-muted">** Masa berlaku pemesanan hanya 1 jam</small>
      </div>
    </div>
  </div>
</div>
  </form>

</div>
<!-- /.container-fluid -->

</div>
<script src="<?= base_url('assets/js/') ?>angular.js"></script>
<script src="<?= base_url('assets/js/') ?>formatrupiah.js"></script>
<script>
// angular
var app = angular.module('myApp', []);

app.controller('myCtrl', function($scope, $http) {
    // $scope.count = 1;
    // $scope.jml = [];
    // $scope.jumlah = [];

    $scope.durasi = 1;

    $scope.total = function(){
      var total = 0;
      for (var i = 0; i < $scope.keranjang.length; i++) {
        total = total+($scope.keranjang[i]['harga']*$scope.keranjang[i]['jumlah']*$scope.durasi);
      }
      return total;
    };

    $scope.getKeranjang = function(){
      $http({
        method: 'get',
        url: '<?= base_url('member/getkeranjang') ?>'
      }).then(function successCallback(response) {
        // Assign response to keranjang object
        $scope.keranjang = response.data;
      });
    }
    $scope.getKeranjang();
    // console.log($scope.getKeranjang);

    $scope.tambah = function (index,event) {
      var plus = angular.element(event.target);
      if($scope.keranjang[index]['stok']>$scope.keranjang[index]['jumlah']){
        $scope.keranjang[index]['jumlah']++;
        plus.removeClass('btn-secondary').addClass('btn-info');
      }
      if($scope.keranjang[index]['stok']==$scope.keranjang[index]['jumlah']){
        plus.removeClass('btn-info').addClass('btn-secondary');
      }
    }
    
    $scope.kurangi = function (index,event) {
      var minus = angular.element(event.target);
    	if($scope.keranjang[index]['jumlah']>1){
        $scope.keranjang[index]['jumlah']--;
        minus.removeClass('btn-secondary').addClass('btn-info');
      }
      if($scope.keranjang[index]['jumlah']==1){
        minus.removeClass('btn-info').addClass('btn-secondary');
      }
    }
});

app.filter('range', function() {
  return function(input, total) {
    total = parseInt(total);

    for (var i=0; i<total; i++) {
      input.push(i);
    }

    return input;
  };
});

app.filter('noFractionCurrency',
  [ '$filter', '$locale',
  function(filter, locale) {
    var currencyFilter = filter('currency');
    var formats = locale.NUMBER_FORMATS;
    console.log(formats);
    return function(amount) {
      var value = currencyFilter(amount);
      var sep = value.indexOf(formats.DECIMAL_SEP);
      if(amount >= 0) { 
        return value.substring(0, sep);
      }
      return value.substring(0, sep) + ')';
    };
  }
]);
app.filter('commaToDecimal', function(){
  return function(value) {
      return value ? parseFloat(value).toFixed(2).toString().replace('.', ',') : null;
  };
});
</script>
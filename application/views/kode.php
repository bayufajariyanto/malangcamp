<?php 
var_dump(time());
?>
<form action="<?= base_url('admin/kode_transaksi') ?>" method="post">
  <div class="form-group">
    <label for="kategori">Kategori</label>
    <select class="form-control" id="kategori" name="kategori">
      <option>Carrier</option>
      <option>Cooking Set</option>
      <option>Jacket</option>
      <option>Lighting</option>
      <option>Other</option>
      <option>Sandal</option>
      <option>Sepatu</option>
      <option>Tenda</option>
    </select>
  </div>
  
  <button class="btn btn-primary" type="submit">Submit</button>
</form>
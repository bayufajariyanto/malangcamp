<form action="<?= base_url('member/insertdata') ?>" method="post">
    <div class="form-group row">
      <label for="jumlah" class="col-sm-2 col-form-label">Data</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="jumlah" id="jumlah">
      </div>
    </div>
    <button type="submit" class="btn btn-info" formaction="<?= base_url('member/insertdatadalam') ?>">Dalam</button>
    <button type="submit" class="btn btn-info">Luar</button>
</form>
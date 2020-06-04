<?php 
foreach($barang as $b) : 
    if($b['kategori'] === $k['nama']) :
    ?>
        <div class="col-md-3">
        <div class="card shadow mb-4 rounded">
            <img class="rounded" src="<?= base_url('assets/img/') ?><?= $b['nama'] ?>.png" alt="" width="100%">
            <div class="card-body">
            <h6 class="text-dark"><?= $b['nama'] ?></h6>
            <h6 class="font-weight-bold text-primary">Rp <?= rupiah($b['harga']) ?></h6>
            </div>
        </div>
        </div>
    <?php 
    endif;
endforeach; ?>
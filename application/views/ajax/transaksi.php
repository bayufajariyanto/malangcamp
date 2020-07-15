<?php
foreach ($transaksi as $p) :
    if ($p['status'] == 1) {
        $status = 'Lunas';
    } else {
        $status = 'Belum Lunas';
    }
?>
    <tr>
        <td><?= $p['kode_transaksi'] ?></td>
        <td><?= $p['username'] ?></td>
        <td><?= date('d F Y', $p['tanggal_order']) ?></td>
        <td><?= date('d F Y', $p['tanggal_kembali']) ?></td>
        <td><a href="<?= base_url('admin/transaksi_detail/' . $p['kode_transaksi']) ?>" class="btn btn-primary">Detail</a></td>
    </tr>
<?php endforeach; ?>
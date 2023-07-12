<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>

<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Instansi</h3>
            <a href="<?= site_url('admin/instansi/create') ?>" class="btn btn-primary pull-right">Tambah Instansi</a>
        </div>
        <div class="box-body">
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Perusahaan</th>
                        <th>Alamat</th>
                        <th>Pembimbing Lapangan</th>
                        <th>No. Pembimbing Lapangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($instansi as $i): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $i['nama_perusahaan'] ?></td>
                            <td><?= $i['alamat'] ?></td>
                            <td><?= $i['pembimbing_lapangan'] ?></td>
                            <td><?= $i['no_pembimbing_lapangan'] ?></td>
                            <td>
                                <a href="<?= site_url('admin/instansi/edit/' . $i['id']) ?>" class="btn btn-sm btn-primary">Edit</a>
                                <a href="<?= site_url('admin/instansi/delete/' . $i['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus instansi ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>

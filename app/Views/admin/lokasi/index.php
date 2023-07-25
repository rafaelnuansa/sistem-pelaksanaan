<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>

<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Lokasi</h3>
            <a href="<?= site_url('admin/lokasi/create') ?>" class="btn btn-primary pull-right">Tambah Lokasi</a>
        </div>
        <div class="box-body">
            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <table class="table table-bordered table-striped datatable">
                <thead class="bg-primary">
                    <tr>
                        <th>No.</th>
                        <th>Nama Lokasi</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($lokasi as $i) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $i['nama_lokasi'] ?></td>
                            <td><?= $i['alamat_lokasi'] ?></td>
                            <td>
                                <a href="<?= site_url('admin/lokasi/edit/' . $i['id']) ?>" class="btn btn-sm btn-primary">Edit</a>
                                <a href="<?= site_url('admin/lokasi/delete/' . $i['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus instansi ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>
<!-- Extend the default layout -->
<?= $this->extend('layouts/default'); ?>

<!-- Set the page title -->
<?= $this->section('title') ?>Laporan Monitoring PKL<?= $this->endSection() ?>

<!-- Set the content -->
<?= $this->section('content') ?>

<div class="box">
    <div class="box-header">
        <h3 class="box-title">
            <div class="box-header">
                <a href="<?= base_url('admin/kkn/laporan') ?>" class="btn btn-primary">Kembali</a>
                <a href="<?= base_url('admin/kkn/laporan/jurnal/monitoring/' . $mahasiswa->id . '/cetak') ?>" class="btn btn-success">Cetak</a>
            </div>
        </h3>
        <div class="box-tools pull-right">


        </div>
    </div>
    <div class="box-body">

        <h3 class="box-title">Data Laporan Pelaksanaan KKN </h3>
        <p>
            NIM : <?= $mahasiswa->nim; ?><br>
            Nama : <?= $mahasiswa->nama; ?>
        </p>
        <?php if (!empty($jurnals)) : ?>
            <table class="table table-bordered datatable">
                <thead class="bg-primary">
                    <tr>
                        <th>No.</th>
                        <th>Tanggal</th>
                        <th>Catatan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($jurnals as $row) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $row['tanggal'] ?></td>
                            <td><?= $row['catatan'] ?></td>
                            <td><?= $row['status'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>Tidak ada data monitoring KKN yang tersedia.</p>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>
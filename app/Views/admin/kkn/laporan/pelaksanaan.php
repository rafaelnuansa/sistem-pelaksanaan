<!-- Extend the default layout -->
<?= $this->extend('layouts/default'); ?>

<!-- Specify the page content -->
<?= $this->section('content') ?>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <a href="<?= base_url('admin/pkl/laporan') ?>" class="btn btn-primary">Kembali</a>
                <a href="<?= base_url('admin/pkl/laporan/jurnal/pelaksanaan/' . $mahasiswa->id . '/cetak') ?>" class="btn btn-success">Cetak</a>
                <br>
                <br>
            </div>
            <div class="box-body">

                <h3 class="box-title">Data Laporan Pelaksanaan KKN </h3>
                <p>
                    NIM : <?= $mahasiswa->nim; ?><br>
                    Nama : <?= $mahasiswa->nama; ?>
                </p>
                <div class="table-responsive">
                    <table class="table table-bordered datatable">
                        <thead class="bg-primary">
                            <tr>
                                <th>No</th>
                                <th>Hari</th>
                                <th>Jam</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($jurnals as $i => $kkn) : ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td><?= $kkn['hari'] ?></td>
                                    <td><?= $kkn['jam'] ?></td>
                                    <td><?= $kkn['keterangan'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
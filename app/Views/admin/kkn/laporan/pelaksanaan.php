<!-- Extend the default layout -->
<?= $this->extend('layouts/default'); ?>

<!-- Specify the page content -->
<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Filter Data Laporan Pelaksanaan PKL</h3>
            </div>
            <div class="box-body">
                <form action="<?= route_to('admin.pkl.laporan.pelaksanaan'); ?>" method="get">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="tahun_akademik" class="control-label">Tahun Akademik</label>
                                <select class="form-control" name="tahun_akademik" id="tahun_akademik">
                                    <option value="">Semua Tahun Akademik</option>
                                    <?php
                                    $currentYear = date('Y');
                                    $startYear = $currentYear - 5;
                                    $endYear = $currentYear + 5;
                                    for ($year = $startYear; $year <= $endYear; $year++) {
                                        $academicYear = $year . '/' . ($year + 1);
                                        $selected = ($tahun_akademik == $academicYear) ? 'selected' : '';
                                        echo "<option value='$academicYear' $selected>$academicYear</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="prodi_id" class="control-label">Prodi</label>
                                <select class="form-control" name="prodi_id" id="prodi_id">
                                    <option value="">Semua Prodi</option>
                                    <?php foreach ($getProdi as $prodi) : ?>
                                        <?php $selected = ($prodi['id'] == $prodi_id) ? 'selected' : ''; ?>
                                        <option value="<?= $prodi['id'] ?>" <?= $selected ?>><?= $prodi['nama_prodi'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="status" class="control-label">Status</label>
                                <select class="form-control" name="status" id="status">
                                    <option value="">Semua Status</option>
                                    <option value="1" <?= ($status == 'Pending') ? 'selected' : '' ?>>Pending</option>
                                    <option value="0" <?= ($status == 'Selesai') ? 'selected' : '' ?>>Selesai</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Data Laporan Pelaksanaan PKL</h3>
                <a href="<?= route_to('admin.pkl.laporan.jurnal.pelaksanaan_cetak') ?>?tahun_akademik=<?= $tahun_akademik ?>&prodi_id=<?= $prodi_id ?>&status=<?= $status ?>" class="btn btn-primary pull-right">
                    <i class="fa fa-print"></i> Cetak Laporan Pelaksanaan PKL
                </a>

            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered datatable">
                        <thead class="bg-primary">
                            <tr>
                                <th>No</th>
                                <th>NIM</th>
                                <th>Nama Mahasiswa</th>
                                <th>Tahun Akademik</th>
                                <th>Status</th>
                                <th>Prodi</th>
                                <th>Nama Perusahaan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pelaksaan as $i => $pkl) : ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td><?= $pkl['nim'] ?></td>
                                    <td><?= $pkl['nama_mahasiswa'] ?></td>
                                    <td><?= $pkl['tahun_akademik'] ?></td>
                                    <td><?= ($pkl['status'] == 'Pending') ? 'Pending' : 'Selesai' ?></td>
                                    <td><?= $pkl['nama_prodi'] ?></td>
                                    <td><?= $pkl['nama_perusahaan'] ?></td>
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
<!-- Extend the default layout -->
<?= $this->extend('layouts/default'); ?>

<!-- Set the page title -->
<?= $this->section('title') ?>
Data Laporan KKN
<?= $this->endSection() ?>

<!-- Specify the page content -->
<?= $this->section('content') ?>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Filter Data Laporan KKN</h3>
            </div>
            <div class="box-body">
                <form action="<?= route_to('admin.kkn.laporan.index'); ?>" method="get">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="tahun_akademik" class="control-label">Tahun Akademik</label>

                                <select class="form-control" name="tahun_akademik" id="tahun_akademik">
                                    <option value="">Semua Tahun Akademik</option>
                                    <?php
                                    $currentYear = date('Y');
                                    $endYear = 2015;
                                    $startYear = $currentYear + 1;

                                    for ($year = $startYear; $year >= $endYear; $year--) {
                                        $academicYear = $year . '/' . ($year + 1);
                                        $selected = (isset($tahun_akademik) && $academicYear === $tahun_akademik) ? 'selected' : '';
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
                                    <option value="" <?= empty($prodi_id) ? 'selected' : '' ?>>Semua Prodi</option>
                                    <?php foreach ($prodi as $p) : ?>
                                        <?php $selected = ($p['id'] == $prodi_id) ? 'selected' : ''; ?>
                                        <option value="<?= $p['id'] ?>" <?= $selected ?>><?= $p['nama_prodi'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group" style="margin-top: 20px;">

                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Data Laporan</h3>
                <a href="<?= route_to('admin.kkn.laporan.cetak') ?>?tahun_akademik=<?= $tahun_akademik ?>&prodi_id=<?= $prodi_id ?>" class="btn btn-primary pull-right">
                    <i class="fa fa-print"></i> Cetak
                </a>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered datatable">
                        <thead class="bg-primary">
                            <tr>
                                <th>No</th>
                                <th>NIM</th>
                                <th>Mahasiswa</th>
                                <th>Program Studi</th>
                                <th>Dosen</th>
                                <th>Tgl Mulai</th>
                                <th>Tgl Selesai</th>
                                <th>Lokasi</th>
                                <th>Pelaksanaan</th>
                                <th>Bimbingan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data_kkn as $i => $kkn) : ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td><?= $kkn['nim'] ?></td>
                                    <td><?= $kkn['nama'] ?></td>
                                    <td><?= $kkn['nama_prodi'] ?></td>
                                    <td><?= $kkn['nama_dosen'] ?? '-' ?></td>
                                    <td><span class="label label-primary"><?= $kkn['tgl_mulai'] ?? '-' ?></span></td>
                                    <td><span class="label label-primary"><?= $kkn['tgl_selesai'] ?? '-' ?></span></td>
                                    <td><?= $kkn['nama_lokasi'] ?? '-' ?></td>
                                    <td>
                                        <a href="<?= route_to('admin.kkn.laporan.jurnal.pelaksanaan.detail', $kkn['mhs_id']); ?>" class="btn btn-primary">
                                            <i class="fa fa-file-text-o"></i> Pelaksanaan
                                        </a>
                                    </td>
                                    <td>
                                        <a href="<?= route_to('admin.kkn.laporan.jurnal.monitoring.detail',  $kkn['mhs_id']); ?>" class="btn btn-primary">
                                            <i class="fa fa-file-text-o"></i> Monitoring
                                        </a>
                                    </td>
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
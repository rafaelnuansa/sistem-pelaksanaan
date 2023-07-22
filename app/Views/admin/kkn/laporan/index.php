<!-- Extend the default layout -->
<?= $this->extend('layouts/default'); ?>

<!-- Set the page title -->
<?= $this->section('title') ?>
Data Laporan PKL
<?= $this->endSection() ?>

<!-- Specify the page content -->
<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Data Laporan PKL</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Laporan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Laporan Jurnal Pelaksanaan</td>
                            <td>
                                <a href="<?= route_to('admin.pkl.laporan.jurnal.pelaksanaan'); ?>" class="btn btn-primary">
                                    <i class="fa fa-file-text-o"></i> Laporan Jurnal Pelaksanaan
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>Laporan Jurnal Bimbingan</td>
                            <td>
                                <a href="<?= route_to('admin.pkl.laporan.jurnal.bimbingan'); ?>" class="btn btn-primary">
                                    <i class="fa fa-file-text-o"></i> Laporan Jurnal Bimbingan
                                </a>

                            </td>
                        </tr>
                        <tr>
                            <td>Laporan Jadwal</td>
                            <td>
                                <a href="<?= route_to('admin.pkl.laporan.jadwal'); ?>" class="btn btn-primary">
                                    <i class="fa fa-file-text-o"></i> Laporan Jadwal
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>Laporan Dospem</td>
                            <td>
                                <a href="<?= route_to('admin.pkl.laporan.dospem'); ?>" class="btn btn-primary">
                                    <i class="fa fa-file-text-o"></i> Laporan Dospem
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Filter Data Laporan PKL</h3>
            </div>
            <div class="box-body">
                <form action="<?= route_to('admin.pkl.laporan.index'); ?>" method="get">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="tahun_akademik" class="control-label">Tahun Akademik</label>

                                <select class="form-control" name="tahun_akademik" id="tahun_akademik">
                                    <option value="" <?= empty($tahun_akademik) ? 'selected' : '' ?>>Semua Tahun Akademik</option>
                                    <?php
                                    $currentYear = date('Y');
                                    $startYear = $currentYear - 5;
                                    $endYear = $currentYear + 5;
                                    for ($year = $startYear; $year <= $endYear; $year++) {
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
                <h3 class="box-title">Data Laporan Kelompok</h3>

                <a href="<?= route_to('admin.pkl.laporan.cetak') ?>?tahun_akademik=<?= $tahun_akademik ?>&prodi_id=<?= $prodi_id ?>" class="btn btn-primary pull-right">
                    <i class="fa fa-print"></i> Cetak
                </a>


            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered datatable">
                        <thead class="bg-primary">
                            <tr>
                                <th>No</th>
                                <th>Nama Kelompok</th>
                                <th>Tanggal Mulai</th>
                                <th>Selesai</th>
                                <th>Program Studi</th>
                                <th>Dosen</th>
                                <th>Instansi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data_pkl as $i => $pkl) : ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td><?= $pkl['nama_kelompok'] ?></td>
                                    <td><?= $pkl['tgl_mulai'] ?></td>
                                    <td><?= $pkl['tgl_selesai'] ?></td>
                                    <td><?= $pkl['nama_prodi'] ?></td>
                                    <td><?= $pkl['nama_dosen'] ?></td>
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
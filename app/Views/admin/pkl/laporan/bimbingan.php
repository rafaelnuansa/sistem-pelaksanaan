<!-- Extend the default layout -->
<?= $this->extend('layouts/default'); ?>

<!-- Set the page title -->
<?= $this->section('title') ?>Laporan Bimbingan PKL<?= $this->endSection() ?>

<!-- Set the content -->
<?= $this->section('content') ?>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Filter</h3>
    </div>
    <div class="box-body">
        <form method="get">
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
            <div class="form-group">
                <label for="prodi_id">Prodi</label>
                <select class="form-control" id="prodi_id" name="prodi_id">
                    <option value="">Pilih Prodi</option>
                    <?php foreach ($getProdi as $prodi) : ?>
                        <option value="<?= $prodi['id'] ?>" <?= $prodi_id == $prodi['id'] ? 'selected' : '' ?>><?= $prodi['nama_prodi'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="mahasiswa_id">Mahasiswa</label>
                <select class="form-control" id="mahasiswa_id" name="mahasiswa_id">
                    <option value="">Semua Mahasiswa</option>
                    <?php foreach ($mahasiswaAll as $mahasiswa) : ?>
                        <option value="<?= $mahasiswa['id'] ?>" <?= $mahasiswa_id == $mahasiswa['id'] ? 'selected' : '' ?>><?= $mahasiswa['nama'] ?> | <?= $mahasiswa['nim']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Filter</button>
        </form>
    </div>
</div>

<div class="box">
    <div class="box-header">
        <h3 class="box-title">
            <?php if (!empty($tahun_akademik) || !empty($prodi_id)) : ?>
                <?php if (!empty($tahun_akademik)) : ?>
                    Tahun Akademik: <?= $tahun_akademik ?>
                <?php endif; ?>
                <?php if (!empty($prodi_id)) : ?>
                    <?php foreach ($getProdi as $p) : ?>
                        <?php if ($p['id'] == $prodi_id) : ?>
                            <h3>Prodi: <?= $p['nama_prodi'] ?></h3>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            <?php else : ?>
                Laporan Bimbingan PKL - Semua Data
            <?php endif; ?>
        </h3>
        <div class="box-tools pull-right">
            <a href="<?= route_to('admin.pkl.laporan.jurnal.bimbingan.cetak', [
                            'tahun_akademik' => $tahun_akademik,
                            'prodi_id' => $prodi_id,
                            'mahasiswa_id' => $mahasiswa_id,
                        ]); ?>" class="btn btn-primary" method="get">
                <i class="fa fa-print"></i> Export to PDF
            </a>

        </div>
    </div>
    <div class="box-body">
        <?php if (!empty($bimbingan)) : ?>
            <table class="table table-bordered datatable">
                <thead class="bg-primary">
                    <tr>
                        <th>No.</th>
                        <th>NIM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Dosen</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <!-- Tambahkan kolom lain yang diperlukan -->
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($bimbingan as $row) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $row['nim'] ?></td>
                            <td><?= $row['nama_mahasiswa'] ?></td>
                            <td><?= $row['nama_dosen'] ?></td>
                            <td><?= $row['tanggal'] ?></td>
                            <td><?= $row['jam'] ?></td>
                            <!-- Tambahkan data lainnya sesuai dengan kolom yang ditambahkan -->
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>Tidak ada data bimbingan PKL yang tersedia.</p>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>
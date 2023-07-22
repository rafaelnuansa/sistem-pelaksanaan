<!-- Extend the default layout -->
<?= $this->extend('layouts/default'); ?>

<!-- Set the page title -->
<?= $this->section('title') ?>
    <?php if (!empty($tanggal)) : ?>
        Laporan Jadwal Sidang PKL - Tanggal <?= $tanggal ?>
    <?php else : ?>
        Laporan Jadwal Sidang PKL
    <?php endif; ?>
<?= $this->endSection() ?>

<!-- Set the content -->
<?= $this->section('content') ?>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Filter</h3>
        </div>
        <div class="box-body">
            <form method="get">
                <div class="form-group">
                    <label for="prodi_id">Prodi</label>
                    <select class="form-control" id="prodi_id" name="prodi_id">
                        <option value="">-- Pilih Prodi --</option>
                        <?php foreach ($getProdi as $prodi) : ?>
                            <option value="<?= $prodi['id'] ?>" <?= $prodi_id == $prodi['id'] ? 'selected' : '' ?>><?= $prodi['nama_prodi'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= $tanggal ?>">
                </div>
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="<?= route_to('admin.pkl.laporan.jadwal'); ?>" class="btn btn-success">
                  Reset
                    </a>
                <a href="<?= route_to('admin.pkl.laporan.jadwal.cetak'); ?>?prodi_id=<?= $prodi_id ?>&tanggal=<?= $tanggal ?>" class="btn btn-primary" target="_blank">
                        <i class="fa fa-print"></i> Export to PDF
                    </a>

            </form>
        </div>
    </div>

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">
                <?php if (!empty($prodi_id)) : ?>
                    <?php foreach ($getProdi as $prodi) : ?>
                        <?php if ($prodi['id'] == $prodi_id) : ?>
                            <?= $prodi['nama_prodi'] ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php else : ?>
                    Semua Prodi
                <?php endif; ?>
            </h3>
        </div>
        <div class="box-body">
            <?php if (!empty($jadwal)) : ?>
                <table class="table table-bordered datatable">
                    <thead class="bg-primary">
                        <tr>
                            <th>No.</th>
                            <th>NIM</th>
                            <th>Nama Mahasiswa</th>
                            <th>Dosen Penguji</th>
                            <th>Tanggal</th>
                            <th>Tempat</th>
                            <!-- Tambahkan kolom lain yang diperlukan -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($jadwal as $row) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $row['nim'] ?></td>
                                <td><?= $row['nama'] ?></td>
                                <td><?= $row['dospeng_nama'] ?></td>
                                <td><?= $row['tanggal'] ?></td>
                                <td><?= $row['nama_tempat'] ?></td>
                                <!-- Tambahkan data lainnya sesuai dengan kolom yang ditambahkan -->
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else : ?>
                <p>Tidak ada data jadwal PKL yang tersedia.</p>
            <?php endif; ?>
        </div>
    </div>
<?= $this->endSection() ?>

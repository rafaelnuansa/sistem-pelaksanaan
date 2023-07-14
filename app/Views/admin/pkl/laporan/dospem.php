<!-- Extend the default layout -->
<?= $this->extend('layouts/default'); ?>

<!-- Set the page title -->
<?= $this->section('title') ?>Laporan Dosen Pembimbing PKL<?= $this->endSection() ?>

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
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="<?= route_to('admin.pkl.laporan.dospem.cetak', [
                            'prodi_id' => $prodi_id,
                        ]) . '?' . http_build_query($_GET) ?>" class="btn btn-primary">
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
        <?php if (!empty($dospem)) : ?>
            <table class="table table-bordered datatable">
                <thead class="bg-primary">
                    <tr>
                        <th>No.</th>
                        <th>Nama Dosen Pembimbing</th>
                        <th>Nama Mahasiswa</th>
                        <th>Prodi</th>
                        <!-- Tambahkan kolom lain yang diperlukan -->
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($dospem as $row) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $row['nama_dospem'] ?></td>
                            <td><?= $row['nama_mahasiswa'] ?></td>
                            <td><?= $row['nama_prodi'] ?></td>
                            <!-- Tambahkan data lainnya sesuai dengan kolom yang ditambahkan -->
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>Tidak ada data Dosen Pembimbing PKL yang tersedia.</p>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>
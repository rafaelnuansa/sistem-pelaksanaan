<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Dosen Pembimbing</h3>
        </div>
        <div class="box-body">
            <?php if (session()->getFlashdata('error') !== null) : ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error'); ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('success') !== null) : ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success'); ?>
                </div>
            <?php endif; ?>
            <form action="<?= route_to('admin.dosen_pembimbing.update', $dosenPembimbing['id_dospem']); ?>" method="POST">
                <?= csrf_field(); ?>

                <div class="form-group">
                    <label for="dosen_id">Dosen</label>
                    <select name="dosen_id" class="form-control">
                        <?php foreach ($dosens as $dosen) : ?>
                            <option value="<?= $dosen['id']; ?>" <?= ($dosenPembimbing['dosen_id'] == $dosen['id']) ? 'selected' : ''; ?>><?= $dosen['nama']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="mahasiswa_id">Mahasiswa</label>
                    <select name="mahasiswa_id" class="form-control">
                        <?php foreach ($mahasiswas as $mahasiswa) : ?>
                            <option value="<?= $mahasiswa['id']; ?>" <?= ($dosenPembimbing['mahasiswa_id'] == $mahasiswa['id']) ? 'selected' : ''; ?>><?= $mahasiswa['nama']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="jenis_pembimbing">Jenis Pembimbing</label>
                    <select name="jenis_pembimbing" class="form-control">
                        <option value="PKL" <?= ($dosenPembimbing['jenis_pembimbing'] == 'PKL') ? 'selected' : ''; ?>>PKL</option>
                        <option value="KKN" <?= ($dosenPembimbing['jenis_pembimbing'] == 'KKN') ? 'selected' : ''; ?>>KKN</option>
                        <option value="SKRIPSI" <?= ($dosenPembimbing['jenis_pembimbing'] == 'SKRIPSI') ? 'selected' : ''; ?>>Skripsi</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="<?= route_to('admin.dosen_pembimbing.index'); ?>" class="btn btn-default">Batal</a>
            </form>
        </div>
    </div>
    <!-- /.box -->

</section>
<!-- /.content -->

<?= $this->endSection(); ?>
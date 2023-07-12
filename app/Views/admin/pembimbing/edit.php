<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>

<section class="content">
    <!-- Tampilkan pesan sukses jika ada -->
    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success'); ?>
        </div>
    <?php endif; ?>

    <!-- Tampilkan pesan error jika ada -->
    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error'); ?>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Edit Pembimbing</h3>
                </div>

                <div class="box-body">
                    <form action="<?= route_to('admin.pembimbing.update', $pembimbing['id']); ?>" method="post">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="PUT">

                        <div class="form-group">
                            <label for="dosen_id">Dosen</label>
                            <select name="dosen_id" id="dosen_id" class="form-control">
                                <?php foreach ($dosen as $d) : ?>
                                    <option value="<?= $d['id']; ?>" <?= ($pembimbing['dosen_id'] == $d['id']) ? 'selected' : ''; ?>><?= $d['nama']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="mahasiswa_id">Mahasiswa</label>
                            <select name="mahasiswa_id" id="mahasiswa_id" class="form-control">
                                <?php foreach ($mahasiswa as $m) : ?>
                                    <option value="<?= $m['id']; ?>" <?= ($pembimbing['mahasiswa_id'] == $m['id']) ? 'selected' : ''; ?>><?= $m['nama']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="tipe_bimbingan">Tipe Bimbingan</label>
                            <select name="tipe_bimbingan" id="tipe_bimbingan" class="form-control">
                                <option value="PKL" <?= ($pembimbing['tipe_bimbingan'] == 'PKL') ? 'selected' : ''; ?>>PKL</option>
                                <option value="KKN" <?= ($pembimbing['tipe_bimbingan'] == 'KKN') ? 'selected' : ''; ?>>KKN</option>
                                <option value="SKRIPSI" <?= ($pembimbing['tipe_bimbingan'] == 'SKRIPSI') ? 'selected' : ''; ?>>SKRIPSI</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="<?= route_to('admin.pembimbing.index'); ?>" class="btn btn-default">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>

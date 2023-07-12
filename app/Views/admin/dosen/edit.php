<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>

<section class="content">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Edit Dosen</h3>
        </div>

        <div class="box-body">
            <form action="<?= route_to('admin.dosen.update', $dosen['id']); ?>" method="post">
                <?= csrf_field(); ?>
                <input type="hidden" name="_method" value="PUT">

                <div class="form-group">
                    <label for="nama">Nama Dosen</label>
                    <input type="text" name="nama" class="form-control" id="nama" value="<?= $dosen['nama']; ?>" required>
                </div>

                <div class="form-group">
                    <label for="nidn">NIDN</label>
                    <input type="text" name="nidn" class="form-control" id="nidn" value="<?= $dosen['nidn']; ?>" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" id="email" value="<?= $dosen['email']; ?>">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" id="password" required>
                </div>

                <div class="form-group">
                    <label for="no_telpon">Nomor Telepon</label>
                    <input type="text" name="no_telpon" class="form-control" id="no_telpon" value="<?= $dosen['no_telpon']; ?>">
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" class="form-control" id="alamat" rows="3" required><?= $dosen['alamat']; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="status_akun">Status Akun</label>
                    <select name="status_akun" class="form-control" id="status_akun" required>
                        <option value="1" <?= $dosen['status_akun'] == 1 ? 'selected' : ''; ?>>Aktif</option>
                        <option value="0" <?= $dosen['status_akun'] == 0 ? 'selected' : ''; ?>>Tidak Aktif</option>
                    </select>
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="<?= site_url('/admin/dosen'); ?>" class="btn btn-default">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>

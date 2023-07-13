<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Tambah Mahasiswa</h3>
                </div>

                <div class="box-body">
                    <!-- Tampilkan pesan error jika ada -->
                    <?php if (session()->getFlashdata('errors')) : ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                                    <li><?= $error ?></li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    <?php endif ?>

                    <form action="<?= route_to('admin.mahasiswa.store'); ?>" method="post">
                        <?= csrf_field(); ?>

                        <div class="form-group">
                            <label for="nim">NIM</label>
                            <input type="text" class="form-control" id="nim" name="nim" value="<?= old('nim'); ?>">
                        </div>

                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="<?= old('nama'); ?>">
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= old('email'); ?>">
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>

                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="no_telpon">No. Telepon</label>
                            <input type="text" class="form-control" id="no_telpon" name="no_telpon" value="<?= old('no_telpon'); ?>">
                        </div>

                        <div class="form-group">
                            <label for="tgl_lahir">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" value="<?= old('tgl_lahir'); ?>">
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat"><?= old('alamat'); ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="angkatan">Angkatan</label>
                            <input type="text" class="form-control" id="angkatan" name="angkatan" value="<?= old('angkatan'); ?>">
                        </div>

                        <div class="form-group">
                            <label for="status_akun">Status Akun</label>
                            <select class="form-control" id="status_akun" name="status_akun">
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="prodi_id">Program Studi</label>
                            <select class="form-control" id="prodi_id" name="prodi_id">
                                <?php foreach ($prodi as $row) : ?>
                                    <option value="<?= $row['id']; ?>"><?= $row['nama_prodi']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="<?= site_url('/admin/mahasiswa'); ?>" class="btn btn-default">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>

<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body">
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
                    <form action="<?= site_url('/admin/fakultas'); ?>" method="post">
                        <?= csrf_field(); ?>
                        <div class="form-group">
                            <label for="nama">Nama Fakultas</label>
                            <input type="text" name="nama" class="form-control" id="nama" required>
                            <!-- Display validation errors for 'nama' field -->
                            <?php if (isset($errors['nama'])) : ?>
                                <span class="text-danger"><?= $errors['nama']; ?></span>
                            <?php endif; ?>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="<?= site_url('/admin/fakultas'); ?>" class="btn btn-default">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>
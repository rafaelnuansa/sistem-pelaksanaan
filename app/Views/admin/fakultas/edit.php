<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <form action="<?= site_url('/admin/fakultas/update/' . $fakultas['id']); ?>" method="post">
                            <?= csrf_field(); ?>
                            <div class="form-group">
                                <label for="nama">Nama Fakultas</label>
                                <input type="text" name="nama" class="form-control" id="nama" value="<?= $fakultas['nama']; ?>" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="<?= site_url('/admin/fakultas'); ?>" class="btn btn-default">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>]

<?= $this->endSection(); ?>

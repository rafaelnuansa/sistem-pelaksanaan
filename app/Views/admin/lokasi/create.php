<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>

<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Tambah Lokasi</h3>
        </div>
        <div class="box-body">
            <form action="<?= site_url('admin/lokasi/store') ?>" method="post">
                <div class="form-group">
                    <label for="nama_lokasi">Nama Lokasi:</label>
                    <input type="text" name="nama_lokasi" id="nama_lokasi" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="alamat_lokasi">Alamat Lokasi:</label>
                    <textarea name="alamat_lokasi" id="alamat_lokasi" class="form-control" rows="3"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="<?= site_url('admin/lokasi') ?>" class="btn btn-default">Kembali</a>
            </form>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>

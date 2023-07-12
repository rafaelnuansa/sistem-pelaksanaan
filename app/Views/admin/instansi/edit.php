<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>

<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Instansi</h3>
        </div>
        <div class="box-body">
            <form action="<?= site_url('admin/instansi/update/' . $instansi['id']) ?>" method="post">
                <div class="form-group">
                    <label for="nama_perusahaan">Nama Perusahaan:</label>
                    <input type="text" name="nama_perusahaan" id="nama_perusahaan" class="form-control" value="<?= $instansi['nama_perusahaan'] ?>" required>
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat:</label>
                    <textarea name="alamat" id="alamat" class="form-control" rows="3"><?= $instansi['alamat'] ?></textarea>
                </div>

                <div class="form-group">
                    <label for="pembimbing_lapangan">Pembimbing Lapangan:</label>
                    <input type="text" name="pembimbing_lapangan" id="pembimbing_lapangan" class="form-control" value="<?= $instansi['pembimbing_lapangan'] ?>">
                </div>

                <div class="form-group">
                    <label for="no_pembimbing_lapangan">No. Pembimbing Lapangan:</label>
                    <input type="text" name="no_pembimbing_lapangan" id="no_pembimbing_lapangan" class="form-control" value="<?= $instansi['no_pembimbing_lapangan'] ?>">
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="<?= site_url('admin/instansi') ?>" class="btn btn-default">Kembali</a>
            </form>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>

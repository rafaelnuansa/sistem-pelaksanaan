<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Tambah Program Studi</h3>
                </div>

                <div class="box-body">
                    <form action="<?= route_to('admin.prodi.store'); ?>" method="POST">
                        <?= csrf_field(); ?>

                        <div class="form-group">
                            <label for="nama_prodi">Nama Program Studi</label>
                            <input type="text" name="nama_prodi" id="nama_prodi" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="fakultas_id">Fakultas</label>
                            <select name="fakultas_id" id="fakultas_id" class="form-control" required>
                                <option value="">Pilih Fakultas</option>
                                <?php foreach ($fakultas as $row) : ?>
                                    <option value="<?= $row['id']; ?>"><?= $row['nama']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="<?= route_to('admin.prodi.index'); ?>" class="btn btn-default">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>

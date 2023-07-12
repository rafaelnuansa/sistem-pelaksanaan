<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>

<section class="content">
    <!-- Tampilkan pesan error jika validasi gagal -->
    <?php if (isset($validation)) : ?>
        <div class="alert alert-danger">
            <?= $validation->listErrors(); ?>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Edit Program Studi</h3>
                </div>

                <div class="box-body">
                    <form action="<?= route_to('admin.prodi.update', $prodi['id']); ?>" method="POST">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="PUT">

                        <div class="form-group">
                            <label for="nama_prodi">Nama Program Studi</label>
                            <input type="text" class="form-control" id="nama_prodi" name="nama_prodi" value="<?= old('nama_prodi', $prodi['nama_prodi']); ?>">
                        </div>

                        <div class="form-group">
                            <label for="fakultas_id">Fakultas</label>
                            <select class="form-control" id="fakultas_id" name="fakultas_id">
                                <?php foreach ($fakultas as $fakultas) : ?>
                                    <option value="<?= $fakultas['id']; ?>" <?= old('fakultas_id', $prodi['fakultas_id']) == $fakultas['id'] ? 'selected' : ''; ?>>
                                        <?= $fakultas['nama']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="<?= route_to('admin.prodi.index'); ?>" class="btn btn-default">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>

<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>


    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <form action="<?= route_to('admin.pkl.update', $pkl['id']); ?>" method="post">
                            <?= csrf_field(); ?> 
                            <div class="form-group">
                                <label for="nama_kelompok">Nama Kelompok</label>
                                <input type="text" name="nama_kelompok" class="form-control" value="<?= $pkl['nama_kelompok']; ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="tgl_mulai">Tanggal Mulai</label>
                                <input type="date" name="tgl_mulai" class="form-control" value="<?= $pkl['tgl_mulai']; ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="tgl_selesai">Tanggal Selesai</label>
                                <input type="date" name="tgl_selesai" class="form-control" value="<?= $pkl['tgl_selesai']; ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="tahun_akademik">Tahun Akademik</label>
                                <input type="text" name="tahun_akademik" class="form-control" value="<?= $pkl['tahun_akademik']; ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="dosen_id">Dosen</label>
                                <select name="dosen_id" class="form-control" required>
                                    <option value="">Pilih Dosen</option>
                                    <?php foreach ($dosens as $dosen) : ?>
                                        <option value="<?= $dosen['id']; ?>" <?= $dosen['id'] == $pkl['dosen_id'] ? 'selected' : ''; ?>><?= $dosen['nama']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="prodi_id">Prodi</label>
                                <select name="prodi_id" class="form-control" required>
                                    <option value="">Pilih Prodi</option>
                                    <?php foreach ($prodis as $prodi) : ?>
                                        <option value="<?= $prodi['id']; ?>" <?= $prodi['id'] == $pkl['prodi_id'] ? 'selected' : ''; ?>><?= $prodi['nama_prodi']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?= $this->endSection(); ?>

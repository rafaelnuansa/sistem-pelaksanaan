<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>

<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"><?= $title ?></h3>
        </div>
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


            <form action="<?= route_to('admin.pembimbing.store'); ?>" method="post">
                <!-- Form fields go here -->
                <div class="form-group">
                    <label for="dosen">Dosen:</label>
                    <select name="dosen_id" id="dosen" class="form-control">
                        <?php foreach ($dosens as $dosen) : ?>
                            <option value="<?= $dosen['id'] ?>"><?= $dosen['nama'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="mahasiswa">Mahasiswa:</label>
                    <select name="mahasiswa_id" id="mahasiswa" class="form-control">
                        <?php foreach ($mahasiswas as $mahasiswa) : ?>
                            <option value="<?= $mahasiswa['id'] ?>"><?= $mahasiswa['nama'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="tipe_bimbingan">Tipe Bimbingan</label>
                    <select name="tipe_bimbingan" id="tipe_bimbingan" class="form-control">
                        <option value="PKL">PKL</option>
                        <option value="KKN">KKN</option>
                        <option value="SKRIPSI">SKRIPSI</option>
                    </select>
                </div>  


                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Pembimbing:</h3>
        </div>
        <div class="box-body">
            <ul class="list-group">
                <?php foreach ($pembimbing as $p) : ?>
                    <li class="list-group-item"><?= $p['nama'] ?> - <?= $p['tipe_bimbingan'] ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>
<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>

<section class="content">
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

    <div class="row">
        <div class="col-md-4">
            <a href="<?= site_url('/admin/pembimbing/create?bimbingan=PKL'); ?>">
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3><?= $jumlahDosenPKL; ?></h3>
                        <p>Dosen PKL</p>
                        <h3><?= $jumlahMahasiswaPKL; ?></h3>
                        <p>Mahasiswa PKL</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-stalker"></i>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="<?= site_url('/admin/pembimbing/create?bimbingan=KKN'); ?>">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3><?= $jumlahDosenKKN; ?></h3>
                        <p>Dosen KKN</p>
                        <h3><?= $jumlahMahasiswaKKN; ?></h3>
                        <p>Mahasiswa KKN</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-stalker"></i>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="<?= site_url('/admin/pembimbing/create?bimbingan=SKRIPSI'); ?>">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3><?= $jumlahDosenSkripsi; ?></h3>
                        <p>Dosen Skripsi</p>
                        <h3><?= $jumlahMahasiswaSkripsi; ?></h3>
                        <p>Mahasiswa Skripsi</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-stalker"></i>
                    </div>
                </div>
            </a>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>

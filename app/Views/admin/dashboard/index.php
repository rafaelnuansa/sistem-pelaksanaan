<?= $this->extend('layouts/default'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-university"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Fakultas</span>
                    <span class="info-box-number"><?= $fakultasCount ?></span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-graduation-cap"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Prodi</span>
                    <span class="info-box-number"><?= $prodiCount ?></span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Mahasiswa</span>
                    <span class="info-box-number"><?= $mahasiswaCount ?></span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-user"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Dosen</span>
                    <span class="info-box-number"><?= $dosenCount ?></span>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

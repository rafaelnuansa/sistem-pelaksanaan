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

  <!-- PKL  -->
  <h3>Praktik Kerja Lapangan</h3>
  <div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="small-box bg-yellow">
        <div class="inner">

          <h3><?= $pklCount ?></h3>
          <p>Kelompok PKL</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href="#" class="small-box-footer p1">Info Lengkap <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="small-box bg-blue">
        <div class="inner">
          <h3><?= $pklBimbCount ?></h3>
          <p>Bimbingan PKL</p>
        </div>
        <div class="icon">
          <i class="ion ion-clipboard"></i>
        </div>
        <a href="#" class="small-box-footer p2">Info Lengkap <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- /.col -->

    <!-- fix for small devices only -->
    <div class="clearfix visible-sm-block"></div>

    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="small-box bg-green">
        <div class="inner">
          <h3><?= $pklJadwalCount ?></h3>
          <p>Jadwal Pengujian PKL</p>
        </div>
        <div class="icon">
          <i class="ion ion-ios-calendar-outline"></i>
        </div>
        <a href="#" class="small-box-footer p3">Info Lengkap <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="small-box bg-red">
        <div class="inner">
          <h3><?= $dosenCount ?></h3>

          <p>Dosen Pembimbing</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-stalker"></i>
        </div>
        <a href="<?= base_url('dosen_pembimbing') ?>" class="small-box-footer">Info Lengkap <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="small-box bg-red">
        <div class="inner">
          <h3>1</h3>

          <p>Dosen Penguji</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-stalker"></i>
        </div>
        <a href="#" class="small-box-footer">Info Lengkap <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="small-box bg-purple">
        <div class="inner">
          <h3>5</h3>

          <p>Cetak Laporan</p>
        </div>
        <div class="icon">
          <i class="ion ion-document-text"></i>
        </div>
        <a href="<?= route_to('admin.pkl.laporan.index') ?>" class="small-box-footer">Info Lengkap <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- /.col -->
  </div>
  <!-- End PKL  -->

  
  <!-- KKN  -->
  <h3>Kuliah Kerja Nyata</h3>
  <div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="small-box bg-yellow">
        <div class="inner">

          <h3><?= $pklCount ?></h3>
          <p>Kelompok KKN</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href="#" class="small-box-footer p1">Info Lengkap <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="small-box bg-blue">
        <div class="inner">
          <h3><?= $pklBimbCount ?></h3>
          <p>Bimbingan KKN</p>
        </div>
        <div class="icon">
          <i class="ion ion-clipboard"></i>
        </div>
        <a href="#" class="small-box-footer p2">Info Lengkap <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- /.col -->

    <!-- fix for small devices only -->
    <div class="clearfix visible-sm-block"></div>

    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="small-box bg-green">
        <div class="inner">
          <h3><?= $pklJadwalCount ?></h3>
          <p>Jadwal Pengujian KKN</p>
        </div>
        <div class="icon">
          <i class="ion ion-ios-calendar-outline"></i>
        </div>
        <a href="#" class="small-box-footer p3">Info Lengkap <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="small-box bg-red">
        <div class="inner">
          <h3><?= $dosenCount ?></h3>

          <p>Dosen Pembimbing</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-stalker"></i>
        </div>
        <a href="<?= base_url('dosen_pembimbing') ?>" class="small-box-footer">Info Lengkap <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="small-box bg-red">
        <div class="inner">
          <h3>1</h3>

          <p>Dosen Penguji</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-stalker"></i>
        </div>
        <a href="#" class="small-box-footer">Info Lengkap <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="small-box bg-purple">
        <div class="inner">
          <h3>5</h3>

          <p>Cetak Laporan</p>
        </div>
        <div class="icon">
          <i class="ion ion-document-text"></i>
        </div>
        <a href="<?= route_to('admin.pkl.laporan.index') ?>" class="small-box-footer">Info Lengkap <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- /.col -->
  </div>
  <!-- End KKN  -->

  
  <!-- SKRIPSI  -->
  <h3>SKRIPSI</h3>
  <div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="small-box bg-yellow">
        <div class="inner">

          <h3><?= $pklCount ?></h3>
          <p>Kelompok SKRIPSI</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href="#" class="small-box-footer p1">Info Lengkap <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="small-box bg-blue">
        <div class="inner">
          <h3><?= $pklBimbCount ?></h3>
          <p>Bimbingan SKRIPSI</p>
        </div>
        <div class="icon">
          <i class="ion ion-clipboard"></i>
        </div>
        <a href="#" class="small-box-footer p2">Info Lengkap <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- /.col -->

    <!-- fix for small devices only -->
    <div class="clearfix visible-sm-block"></div>

    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="small-box bg-green">
        <div class="inner">
          <h3><?= $pklJadwalCount ?></h3>
          <p>Jadwal Pengujian SKRIPSI</p>
        </div>
        <div class="icon">
          <i class="ion ion-ios-calendar-outline"></i>
        </div>
        <a href="#" class="small-box-footer p3">Info Lengkap <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="small-box bg-red">
        <div class="inner">
          <h3><?= $dosenCount ?></h3>

          <p>Dosen Pembimbing</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-stalker"></i>
        </div>
        <a href="<?= base_url('dosen_pembimbing') ?>" class="small-box-footer">Info Lengkap <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="small-box bg-red">
        <div class="inner">
          <h3>1</h3>

          <p>Dosen Penguji</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-stalker"></i>
        </div>
        <a href="#" class="small-box-footer">Info Lengkap <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="small-box bg-purple">
        <div class="inner">
          <h3>5</h3>

          <p>Cetak Laporan</p>
        </div>
        <div class="icon">
          <i class="ion ion-document-text"></i>
        </div>
        <a href="<?= route_to('admin.pkl.laporan.index') ?>" class="small-box-footer">Info Lengkap <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- /.col -->
  </div>
  <!-- End SKRIPSI  -->
</div>

<?= $this->endSection(); ?>
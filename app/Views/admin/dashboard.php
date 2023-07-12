<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>

<!-- Default box -->
<div class="row">
  <div class="col-md-4 col-sm-6 col-xs-12">
    <div class="small-box bg-yellow">
      <div class="inner">
        <h3><?= $total_pendaftaran ?></h3>

        <p>Kelompok</p>
      </div>
      <div class="icon">
        <i class="ion ion-person-add"></i>
      </div>
      <a href="#" class="small-box-footer p1">Info Lengkap <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- /.col -->
  <div class="col-md-4 col-sm-6 col-xs-12">
    <div class="small-box bg-blue">
      <div class="inner">
        <h3><?= $total_bimbingan ?></h3>

        <p>Bimbingan</p>
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

  <div class="col-md-4 col-sm-6 col-xs-12">
    <div class="small-box bg-green">
      <div class="inner">
        <h3><?= $total_jadwal ?></h3>

        <p>Jadwal Pengujian</p>
      </div>
      <div class="icon">
        <i class="ion ion-ios-calendar-outline"></i>
      </div>
      <a href="#" class="small-box-footer p3">Info Lengkap <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- /.col -->
  <div class="col-md-4 col-sm-6 col-xs-12">
    <div class="small-box bg-red">
      <div class="inner">
        <h3><?= $total_dosen ?></h3>

        <p>Dosen Pembimbing</p>
      </div>
      <div class="icon">
        <i class="ion ion-person-stalker"></i>
      </div>
      <a href="<?= base_url('dosen_pembimbing') ?>" class="small-box-footer">Info Lengkap <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- /.col -->
  <div class="col-md-4 col-sm-6 col-xs-12">
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
  <div class="col-md-4 col-sm-6 col-xs-12">
    <div class="small-box bg-purple">
      <div class="inner">
        <h3>5</h3>

        <p>Cetak Laporan</p>
      </div>
      <div class="icon">
        <i class="ion ion-document-text"></i>
      </div>
      <a href="<?= base_url('cetak-laporan') ?>" class="small-box-footer">Info Lengkap <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- /.col -->
</div>
<!-- /.box -->

<!-- /.modal -->
<div class="modal fade" id="modal-pendaftaran">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Navigasi</h4>
      </div>
      <div class="modal-body">
        <div class="row" style="margin-bottom: 10px;">
          <div class="col-md-12">
            <a href="<?= base_url('pkl/kelompok') ?>" class="btn btn-default btn-block">PKL</a>
          </div>
        </div>
        <div class="row" style="margin-bottom: 10px;">
          <div class="col-md-12">
            <a href="#" class="btn btn-default btn-block">KKN</a>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <a href="#" class="btn btn-default btn-block">Skripsi</a>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-bimbingan">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Navigasi</h4>
      </div>
      <div class="modal-body">
        <div class="row" style="margin-bottom: 10px;">
          <div class="col-md-12">
            <a href="<?= base_url('pkl/jurnal/bimbingan') ?>" class="btn btn-default btn-block">PKL</a>
          </div>
        </div>
        <div class="row" style="margin-bottom: 10px;">
          <div class="col-md-12">
            <a href="#" class="btn btn-default btn-block">KKN</a>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <a href="#" class="btn btn-default btn-block">Skripsi</a>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-jadwal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Navigasi</h4>
      </div>
      <div class="modal-body">
        <div class="row" style="margin-bottom: 10px;">
          <div class="col-md-12">
            <a href="<?= base_url('pkl/jadwal') ?>" class="btn btn-default btn-block">PKL</a>
          </div>
        </div>
        <div class="row" style="margin-bottom: 10px;">
          <div class="col-md-12">
            <a href="#" class="btn btn-default btn-block">KKN</a>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <a href="#" class="btn btn-default btn-block">Skripsi</a>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
  $(' .p1').click(function() {
    $('#modal-pendaftaran').modal('show');
  });

  $(' .p2').click(function() {
    $('#modal-bimbingan').modal('show');
  });

  $(' .p3').click(function() {
    $('#modal-jadwal').modal('show');
  });
</script>
<?= $this->endSection(); ?>
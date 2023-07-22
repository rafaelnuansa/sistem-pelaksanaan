<?= $this->extend('layouts/default'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">
  
<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="small-box bg-yellow">
        <div class="inner">

          <h3><?= $fakultasCount ?></h3>
          <p>Fakultas</p>
        </div>
        <div class="icon">
          <i class="fa fa-university"></i>
        </div>
        <a href="<?= base_url('admin/fakultas'); ?>" class="small-box-footer p1">Info Lengkap <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="small-box bg-yellow">
        <div class="inner">

          <h3><?= $prodiCount ?></h3>
          <p>Prodi</p>
        </div>
        <div class="icon">
          <i class="fa fa-graduation-cap"></i>
        </div>
        <a href="<?= base_url('admin/prodi'); ?>" class="small-box-footer p1">Info Lengkap <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="small-box bg-yellow">
        <div class="inner">

          <h3><?= $mahasiswaCount ?></h3>
          <p>Mahasiswa</p>
        </div>
        <div class="icon">
          <i class="fa fa-users"></i>
        </div>
        <a href="<?= base_url('admin/mahasiswa'); ?>" class="small-box-footer p1">Info Lengkap <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="small-box bg-yellow">
        <div class="inner">

          <h3><?= $dosenCount ?></h3>
          <p>Dosen</p>
        </div>
        <div class="icon">
          <i class="fa fa-users"></i>
        </div>
        <a href="<?= base_url('admin/dosen'); ?>" class="small-box-footer p1">Info Lengkap <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3><?= $pklCount ?></h3>
          <p>Kelompok</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href="#" class="small-box-footer p1" data-toggle="modal" data-target="#modal1">Info Lengkap <i class="fa fa-arrow-circle-right"></i></a>
      </div>
      <!-- Modal -->
      <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="modal1Label" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modal1Label">Kelompok</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <!-- Modal content here -->
              <div class="modal-body">
                <div class="row" style="margin-bottom: 10px;">
                  <div class="col-md-12">
                    <a href="<?php echo base_url('admin/pkl'); ?>" class="btn btn-default btn-block">PKL</a>
                  </div>
                </div>
                <div class="row" style="margin-bottom: 10px;">
                  <div class="col-md-12">
                    <a href="<?php echo base_url('admin/pkl'); ?>" class="btn btn-default btn-block">KKN</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="small-box bg-blue">
        <div class="inner">
          <h3><?= $pklBimbCount ?></h3>
          <p>Bimbingan</p>
        </div>
        <div class="icon">
          <i class="ion ion-clipboard"></i>
        </div>
        <a href="#" class="small-box-footer p2" data-toggle="modal" data-target="#modal2">Info Lengkap <i class="fa fa-arrow-circle-right"></i></a>
      </div>
      <!-- Modal -->
      <div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="modal2Label" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modal2Label">Bimbingan</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <div class="row" style="margin-bottom: 10px;">
                <div class="col-md-12">
                  <a href="<?php echo base_url('admin/pkl/jurnal/bimbingan'); ?>" class="btn btn-default btn-block">PKL</a>
                </div>
              </div>
              <div class="row" style="margin-bottom: 10px;">
                <div class="col-md-12">
                  <a href="<?php echo base_url('admin/pkl/jurnal/bimbingan'); ?>" class="btn btn-default btn-block">KKN</a>
                </div>
              </div>

              <div class="row" style="margin-bottom: 10px;">
                <div class="col-md-12">
                  <a href="<?php echo base_url('admin/pkl/jurnal/bimbingan'); ?>" class="btn btn-default btn-block">SKRIPSI</a>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /.col -->

    <!-- fix for small devices only -->
    <div class="clearfix visible-sm-block"></div>

    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="small-box bg-green">
        <div class="inner">
          <h3><?= $pklJadwalCount ?></h3>
          <p>Jadwal Pengujian</p>
        </div>
        <div class="icon">
          <i class="ion ion-ios-calendar-outline"></i>
        </div>
        <a href="#" class="small-box-footer p3" data-toggle="modal" data-target="#modal3">Info Lengkap <i class="fa fa-arrow-circle-right"></i></a>
      </div>
      <!-- Modal -->
      <div class="modal fade" id="modal3" tabindex="-1" role="dialog" aria-labelledby="modal3Label" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modal3Label">Jadwal Pengujian</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <!-- Modal content here -->
             
              <div class="row" style="margin-bottom: 10px;">
                <div class="col-md-12">
                  <a href="<?php echo base_url('admin/pkl/jadwal'); ?>" class="btn btn-default btn-block">PKL</a>
                </div>
              </div>
              <div class="row" style="margin-bottom: 10px;">
                <div class="col-md-12">
                  <a href="#" class="btn btn-default btn-block">KKN</a>
                </div>
              </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /.col -->
    <iv class="col-md-3 col-sm-6 col-xs-12">
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
    </iv>
    <!-- /.col -->
  </div>
</div>

<?= $this->endSection(); ?>
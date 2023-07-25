<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid">

  <div class="row">
    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3><?= $pklCount ?? 0 ?></h3>
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
    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="small-box bg-blue">
        <div class="inner">
          <h3><?= $pklBimbCount ?? 0 ?></h3>
          <p>Mahasiswa Bimbingan</p>
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
    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="small-box bg-green">
        <div class="inner">
          <h3><?= $pklJadwalCount ?? 0 ?></h3>
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
  </div>
</div>

<?= $this->endSection(); ?>

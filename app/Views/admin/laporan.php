<?= $this->extend('layouts/default'); ?>

<?= $this->section('head'); ?>
<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url('assets/datatables.net-bs/css/dataTables.bootstrap.min.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Laporan</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
              title="Collapse">
        <i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
        <i class="fa fa-times"></i></button>
    </div>
  </div>
  <div class="box-body">
    <table class="table table-hover" id="table" style="border: 1px solid #f0f0f0; margin-top: 10px;">
      <thead>
        <tr>
          <th>No</th>
          <th>Keterangan</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td>Kelompok PKL</td>
          <td>
            <a target="_blank" href="<?= base_url('laporan/1') ?>" class="btn btn-primary btn-sm">Cetak</a>
          </td>
        </tr>
        <tr>
          <td>2</td>
          <td>Jurnal Pelaksanaan</td>
          <td>
            <div class="btn-group">
              <button type="button" class="btn btn-primary btn-sm">Cetak</button>
              <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
              </button>
              <ul class="dropdown-menu" role="menu">
                <li><a target="_blank" href="<?= base_url('laporan/2?type=pkl') ?>">PKL</a></li>
                <li><a target="_blank" href="#">KKN</a></li>
              </ul>
            </div>
          </td>
        </tr>
        <tr>
          <td>3</td>
          <td>Jurnal Bimbingan</td>
          <td>
            <div class="btn-group">
              <button type="button" class="btn btn-primary btn-sm">Cetak</button>
              <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
              </button>
              <ul class="dropdown-menu" role="menu">
                <li><a target="_blank" href="<?= base_url('laporan/3?type=pkl') ?>">PKL</a></li>
                <li><a target="_blank" href="#">KKN</a></li>
                <li><a target="_blank" href="#">Skripsi</a></li>
              </ul>
            </div>
          </td>
        </tr>
        <tr>
          <td>4</td>
          <td>Jawal Sidang</td>
          <td>
            <div class="btn-group">
              <button type="button" class="btn btn-primary btn-sm">Cetak</button>
              <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
              </button>
              <ul class="dropdown-menu" role="menu">
                <li><a target="_blank" href="<?= base_url('laporan/4') ?>">PKL</a></li>
                <li><a target="_blank" href="#">Skripsi</a></li>
              </ul>
            </div>
          </td>
        </tr>
        <tr>
          <td>5</td>
          <td>Pembagian Dosen</td>
          <td>
            <a target="_blank" href="<?= base_url('laporan/5') ?>" class="btn btn-primary btn-sm">Cetak</a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
<!-- /.box -->

<?= $this->endSection(); ?>
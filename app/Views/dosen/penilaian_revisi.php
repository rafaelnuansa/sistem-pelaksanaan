<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>

<!-- Default box -->
<?php if(session()->getFlashData('success') !== null): ?>
<div class="alert alert-success"><?= session()->getFlashData('success') ?></div>
<?php endif; ?>
<div class="box">
  <div class="box-body">
    <div class="box-header with-border">
    <h3 class="box-title">Penilaian Revisi</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
              title="Collapse">
        <i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
        <i class="fa fa-times"></i></button>
    </div>
  </div>
    <table class="table table-hover" style="border: 1px solid #f0f0f0; margin-top: 10px;">
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
          <td>Lembar Revisi</td>
          <td>
            <a href="<?= base_url('downloads/lembar-revisi.pdf') ?>" target="_blank" class="btn btn-primary">Cetak</a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
<!-- /.box -->

<?= $this->endSection(); ?>
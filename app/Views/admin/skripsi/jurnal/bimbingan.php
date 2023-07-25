<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>

<!-- Default box -->
<?php if(session()->getFlashData('success') !== null): ?>
<div class="alert alert-success"><?= session()->getFlashData('success') ?></div>
<?php endif; ?>
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Jurnal Bimbingan</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
              title="Collapse">
        <i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
        <i class="fa fa-times"></i></button>
    </div>
  </div>
  <div class="box-body">
    <table class="table table-hover" style="border: 1px solid #f0f0f0; margin-top: 10px;">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama mahasiswa</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($data as $index => $row): ?>
          <tr>
            <td><?= ++$index ?></td>
            <td><?= $row['nama_mhs'] ?></td>
            <td class="text-center">
              <a href="<?= base_url('pkl/jurnal/bimbingan/detail/'.$row['nama_mhs']) ?>" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
              
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
<!-- /.box -->

<?= $this->endSection(); ?>
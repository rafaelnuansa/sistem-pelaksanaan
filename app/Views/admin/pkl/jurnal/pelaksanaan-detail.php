<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>

<!-- Default box -->
<?php if(session()->getFlashData('success') !== null): ?>
<div class="alert alert-success"><?= session()->getFlashData('success') ?></div>
<?php endif; ?>
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title"><?= $title ?></h3>

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
          <th>Hari/Tanggal</th>
          <th>Jam</th>
          <th>Keterangan</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($data as $index => $row): ?>
          <tr>
            <td><?= ++$index ?></td>
            <td><?= $row['hari'] ?></td>
            <td><?= $row['jam'] ?></td>
            <td><?= $row['keterangan'] ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
<!-- /.box -->

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>

  $('.delete').click(function() {
    const ok = confirm('Yakin ingin menghapus kelompok?');

    if(ok) {
      $(this).parent().submit();
    }
  });
</script>
<?= $this->endSection(); ?>
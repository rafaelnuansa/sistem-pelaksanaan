<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>

<!-- Default box -->
<?php if (session()->getFlashData('success') !== null) : ?>
  <div class="alert alert-success"><?= session()->getFlashData('success') ?></div>
<?php endif; ?>
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Jurnal Bimbingan</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
        <i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
        <i class="fa fa-times"></i></button>
    </div>
  </div>
  <div class="box-body">
    <table class="table table-hover datatable" style="border: 1px solid #f0f0f0; margin-top: 10px;">
      <thead class="bg-primary">
        <tr>
          <th>No</th>
          <th>NIM</th>
          <th>Nama mahasiswa</th>
          <th>Tahun Ajaran</th>
          <th>Nama Kelompok</th>
          <th>Prodi</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($data as $index => $row) : ?>
          <tr>
            <td><?= ++$index ?></td>
            <td><?= $row['nim'] ?></td>
            <td><?= $row['nama_mahasiswa'] ?></td>
            <td><?= $row['nama_kelompok'] ?></td>
            <td><?= $row['tahun_akademik'] ?></td>
            <td><?= $row['nama_prodi'] ?></td>
            <td>
            <a href="<?= base_url('dosen/pkl/jurnal/detail/' . $row['mahasiswa_id']) ?>" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
         
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
<!-- /.box -->

<?= $this->endSection(); ?>
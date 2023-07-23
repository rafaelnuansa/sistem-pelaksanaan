<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>

<!-- Default box -->
<?php if(session()->getFlashData('success') !== null): ?>
<div class="alert alert-success"><?= session()->getFlashData('success') ?></div>
<?php endif; ?>
<div class="box">
  <div class="box-body">
    <table class="table table-hover" style="border: 1px solid #f0f0f0; margin-top: 10px;">
      <thead class="bg-primary">
        <tr>
          <th>No</th>
          <th>Keterangan</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td>Formulir penilaian PKL</td>
          <td>
            <a href="<?= base_url('downloads/formulir-penilaian.docx') ?>" target="_blank" class="btn btn-primary">Cetak</a>
          </td>
        </tr>
        <tr>
          <td>2</td>
          <td>Kerangka Acuan</td>
          <td>
            <a href="<?= base_url('downloads/kerangka-acuan.docx') ?>" target="_blank" class="btn btn-primary">Cetak</a>
          </td>
        </tr>
        <tr>
          <td>3</td>
          <td>Log Harian</td>
          <td>
            <a href="<?= base_url('mahasiswa/pkl/formulir/log-harian') ?>" target="_blank" class="btn btn-primary">Cetak</a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
<!-- /.box -->

<?= $this->endSection(); ?>
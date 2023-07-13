<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Info Mahasiswa</h3>
        </div>
        <div class="box-body">
          <!-- Tambahkan konten info mahasiswa di sini -->
          <p>NIM: <?= $mahasiswa['nim'] ?></p>
          <p>Nama: <?= $mahasiswa['nama'] ?></p>
          <p>Prodi: <?= $mahasiswa['prodi'] ?></p>
        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>
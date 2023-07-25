<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>
<!-- Default box -->
<?php if (session()->getFlashData('success') !== null) : ?>
  <div class="alert alert-success"><?= session()->getFlashData('success') ?></div>
<?php endif; ?>

<?php if (session()->getFlashData('error') !== null) : ?>
  <div class="alert alert-danger"><?= session()->getFlashData('error') ?></div>
<?php endif; ?>
<?php if ($skripsi) : ?>
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Skripsi</h3>
    </div>

    <div class="box-body">

      <form method="POST" action="<?= route_to('mahasiswa.skripsi.edit_judul') ?>">
        <table class="table table-bordered">
          <thead class="bg-primary">
            <tr>

              <th colspan="2">Data Skripsi</th>
            </tr>
          </thead>
          <tbody>

            <tr>
              <th>NIM</th>
              <td><?= $skripsi->nim ?></td>
            </tr>
            <tr>
              <th>Mahasiswa</th>
              <td><?= $skripsi->nama_mahasiswa ?></td>
            </tr>
            <tr>
              <th>NIDN Dosen</th>
              <td>
                <?php echo $dospem->nidn ?? 'Belum Ada Pembimbing'; ?>
            </tr>
            <tr>
              <th>Dosen Pembimbing</th>
              <td>
                <?php echo $dospem->dospem ?? 'Belum Ada Pembimbing'; ?></td>
            </tr>
            <tr>

              <th>
                Judul Laporan
              </th>

              <td>
                <input type="text" class="form-control" required name="judul_skripsi" placeholder="Judul Skripsi" value="<?= $skripsi->judul_skripsi ?? ''; ?>">
              </td>
            </tr>
          </tbody>
        </table>


        <button type="submit" class="btn btn-primary">Simpan</button>
      </form>
    </div>
  </div>
<?php else : ?>
  <div class="alert alert-info">Anda belum terdaftar untuk Skripsi Administrasi/Staff Tata Usaha.</div>
<?php endif; ?>
<!-- /.box -->
<?= $this->endSection(); ?>
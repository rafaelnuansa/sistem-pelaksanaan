<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>

<!-- Default box -->
<?php if (session()->getFlashData('success') !== null) : ?>
  <div class="alert alert-success"><?= session()->getFlashData('success') ?></div>
<?php endif; ?>
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Daftar Anggota Kelompok <?= session()->get('kelompok') ?></h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
        <i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
        <i class="fa fa-times"></i></button>
    </div>
  </div>
  <div class="box-body">
    <?php if ($akun !== null && $akun['is_ketua'] == true) : ?>
      <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modal-tambah">
        Tempat PKL
      </button>
    <?php endif; ?>
    <table class="table table-hover" style="border: 1px solid #f0f0f0; margin-top: 10px;">
      <thead>
        <tr>
          <th>No</th>
          <th>NIM</th>
          <th>Nama Mahasiswa</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php $nomor = 1; ?>
        <?php foreach ($data as $key => $row) : ?>
          <?php if ($row['status_pkl'] == 'layak') : ?>
            <tr>
              <td><?= $nomor++ ?></td>
              <td><?= $row['nim'] ?></td>
              <td><?= $row['nama'] ?></td>
              <td><?= $row['is_ketua'] == true ? 'Ketua' : 'Anggota' ?></td>
            </tr>
          <?php endif; ?>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
<!-- /.box -->

<div class="modal fade" id="modal-tambah">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Data Instansi</h4>
      </div>
      <div class="modal-body">
        <form method="POST" action="">
          <div class="form-group">
            <label for="">Nama Perusahaan</label>
            <input type="text" readonly class="form-control" name="nama_perusahaan" value="<?= $instansi['nama_perusahaan'] ?? '' ?>">
          </div>
          <div class="form-group">
            <label for="">Alamat</label>
            <input type="text" class="form-control" name="alamat" value="<?= $instansi['alamat'] ?? '' ?>">
          </div>
          <div class="form-group">
            <label for="">Pembimbing Lapangan</label>
            <input type="text" class="form-control" name="pembimbing_lapangan" value="<?= $instansi['pembimbing_lapangan'] ?? '' ?>">
          </div>
          <div class="form-group">
            <label for="">No. Pembimbing Lapangan</label>
            <input type="text" class="form-control" name="no_hp_pl" value="<?= $instansi['no_pembimbing_lapangan'] ?? '' ?>">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>


<?= $this->endSection(); ?>
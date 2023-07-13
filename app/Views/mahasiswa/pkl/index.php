<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>
<!-- Default box -->
<?php if (session()->getFlashData('success') !== null) : ?>
  <div class="alert alert-success"><?= session()->getFlashData('success') ?></div>
<?php endif; ?>
<?php if ($anggota) : ?>
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Daftar Anggota Kelompok <?php $nama_kelompok; ?></h3>
    </div>

    <div class="box-body">
      
    <?php if (!$instansi) :; ?>
      <?php if ($akun !== null && $akun['is_ketua'] == true) : ?>
        <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modal-tambah">
          Instansi Praktik Kerja Lapangan
        </button>
      <?php endif; ?>
      <?php endif;?>
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
          <?php foreach ($anggota as $key => $row) : ?>
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
<?php else : ?>
  <div class="alert alert-info">Anda belum memiliki kelompok PKL.</div>
<?php endif; ?>
<!-- /.box -->

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Informasi Instansi</h3>
  </div>
  <div class="box-body">
    <form method="POST" action="<?= route_to('mahasiswa.pkl.edit_instansi') ?>">
      <table class="table table-bordered">
        <tbody>
          <input type="hidden" name="instansi_id" value="<?= $instansi['id'] ?>">
          <tr>
            <th>Nama Perusahaan</th>
            <td>
              <input type="text" class="form-control" name="nama_perusahaan" value="<?= $instansi['nama_perusahaan'] ?>">
            </td>
          </tr>
          <tr>
            <th>Alamat</th>
            <td>
              <input type="text" class="form-control" name="alamat" value="<?= $instansi['alamat'] ?>">
            </td>
          </tr>
          <tr>
            <th>Pembimbing Lapangan</th>
            <td>
              <input type="text" class="form-control" name="pembimbing_lapangan" value="<?= $instansi['pembimbing_lapangan'] ?>">
            </td>
          </tr>
          <tr>
            <th>No. Pembimbing Lapangan</th>
            <td>
              <input type="text" class="form-control" name="no_pembimbing_lapangan" value="<?= $instansi['no_pembimbing_lapangan'] ?>">
            </td>
          </tr>
        </tbody>
      </table>
      <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
  </div>
</div>



<?php if (!$instansi) :; ?>
  <div class="modal fade" id="modal-tambah">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Data Instansi</h4>
        </div>

        <form method="POST" action="<?= route_to('mahasiswa.pkl.simpan_instansi') ?>">
          <div class="modal-body">
            <div class="form-group">
              <label for="">Pilih Perusahaan Tersedia</label>
              <select class="form-control" name="instansi_id">
                <?php foreach ($instansi_list as $ins) : ?>
                  <option value="<?= $ins['id'] ?>"><?= $ins['nama_perusahaan'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Pilih Instansi</button>
          </div>
        </form>
        <form method="POST" action="<?= route_to('mahasiswa.pkl.simpan_instansi') ?>">
          <div class="modal-body">
            <h4>Input Baru</h4>
            <div class="form-group">
              <label for="">Nama Perusahaan</label>
              <input type="text" class="form-control" name="nama_perusahaan" value="<?= $instansi['nama_perusahaan'] ?? '' ?>">
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
              <input type="text" class="form-control" name="no_pembimbing_lapangan" value="<?= $instansi['no_pembimbing_lapangan'] ?? '' ?>">
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
<?php endif; ?>


<?= $this->endSection(); ?>
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
      <div class="dospem" style="margin-bottom: 20px;">

        <h4>Dosen Pembimbing : <?php echo $dospem->dospem ?? 'Belum Ada Pembimbing'; ?></h4>
        <h4>NIDN : <?php echo $dospem->nidn ?? 'Belum Ada Pembimbing'; ?></h4>
      </div>
      <table class="table table-bordered datatable" style="margin-top: 10px;">
        <thead class="bg-primary">
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
            <tr>
              <td><?= $nomor++ ?></td>
              <td><?= $row['nim'] ?></td>
              <td><?= $row['nama'] ?></td>
              <td><?= $row['is_ketua'] == true ? 'Ketua' : 'Anggota' ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
<?php else : ?>
  <div class="alert alert-info">Anda belum memiliki Kelompok PKL Hubungi Administrasi/Staff Tata Usaha.</div>
<?php endif; ?>
<!-- /.box -->
<?php if ($kelompok) : ?>
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Informasi Instansi</h3>
    </div>
    <div class="box-body">
      <form method="POST" action="<?= route_to('mahasiswa.pkl.edit_instansi') ?>">
        <table class="table table-bordered">
          <tbody>
            <input type="hidden" name="kelompok_id" value="<?= $kelompok->id ?>">
            <tr>
              <th>Nama Perusahaan</th>
              <td>
                <?php if ($is_ketua) : ?>
                  <select class="form-control" name="instansi_id">
                    <option value="">Pilih Perusahaan</option>
                    <?php foreach ($instansi as $row) : ?>
                      <option value="<?= $row['id'] ?>" <?= ($kelompok->instansi_id == $row['id']) ? 'selected' : '' ?>><?= $row['nama_perusahaan'] ?></option>
                    <?php endforeach; ?>
                  </select>
                  <?php if (empty($kelompok->instansi_id)) : ?>
                    <span class="text-danger">Jika perusahaan belum terdaftar harap hubungi admin/staff tata usaha</span>
                  <?php endif; ?>
                <?php else :; ?>
                  <select disabled class="form-control" name="instansi_id">
                    <option value="">Pilih Perusahaan</option>
                    <?php foreach ($instansi as $row) : ?>
                      <option value="<?= $row['id'] ?>" <?= ($kelompok->instansi_id == $row['id']) ? 'selected' : '' ?>><?= $row['nama_perusahaan'] ?></option>
                    <?php endforeach; ?>
                  </select>
                  <?php if (empty($kelompok->instansi_id)) : ?>
                    <span class="text-danger">Jika perusahaan belum terdaftar harap hubungi admin/staff tata usaha</span>
                  <?php endif; ?>
                <?php endif; ?>
              </td>
            </tr>
            <tr>
              <th>Alamat</th>
              <td>
                <?php
                // Fetch the selected instansi's alamat from the $instansi array
                $selectedInstansiId = $kelompok->instansi_id;
                $selectedAlamat = 'Pilih Instansi/Perusahaan';

                if ($selectedInstansiId) {
                  foreach ($instansi as $row) {
                    if ($row['id'] == $selectedInstansiId) {
                      $selectedAlamat = $row['alamat'];
                      break;
                    }
                  }
                }
                ?>
                <input type="text" class="form-control" name="alamat_perusahaan" value="<?= $selectedAlamat; ?>" disabled>
              </td>
            </tr>

            <tr>
              <th>Nama Pembimbing</th>
              <td> <?php if ($is_ketua) : ?>
                  <input type="text" class="form-control" name="bimbingan_perusahaan" value="<?= $kelompok->bimbingan_perusahaan ?>">
                <?php else :; ?>
                  <?= $kelompok->bimbingan_perusahaan ?>
                <?php endif; ?>
              </td>
            </tr>
            <tr>
              <th>Jabatan</th>
              <td>
                <?php if ($is_ketua) : ?>
                  <input type="text" class="form-control" name="jabatan_bimbingan_perusahaan" value="<?= $kelompok->jabatan_bimbingan_perusahaan ?>">
                <?php else :; ?>
                  <?= $kelompok->jabatan_bimbingan_perusahaan ?>
                <?php endif; ?>
              </td>
            </tr>
            <tr>
              <th>Nomor Telpon Pembimbing</th>
              <td>
                <?php if ($is_ketua) : ?>
                  <input type="number" class="form-control" name="no_perusahaan" value="<?= $kelompok->no_perusahaan ?>">
                <?php else :; ?>
                  <?= $kelompok->no_perusahaan ?>
                <?php endif; ?>
              </td>
            </tr>
          </tbody>
        </table>
        <?php if ($is_ketua) : ?>
          <button type="submit" class="btn btn-primary">Simpan</button>
        <?php endif; ?>
      </form>
    </div>
  </div>
<?php endif; ?>



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
          <h4>Data Perusahaan</h4>
          <div class="form-group">
            <label for="">Nama Perusahaan</label>
            <input type="text" class="form-control" name="nama_perusahaan" value="<?= $kelompok->nama_perusahaan ?? '' ?>">
          </div>

          <div class="form-group">
            <label for="">Alamat</label>
            <input type="text" class="form-control" name="alamat_perusahaan" value="<?= $kelompok->alamat_perusahaan ?? '' ?>">
          </div>

          <div class="form-group">
            <label for="">Bimbingan Perusahaan</label>
            <input type="text" class="form-control" name="bimbingan_perusahaan" value="<?= $kelompok->bimbingan_perusahaan ?? '' ?>">
          </div>

          <div class="form-group">
            <label for="">Jabatan Bimbingan Perusahaan</label>
            <input type="text" class="form-control" name="jabatan_bimbingan_perusahaan" value="<?= $kelompok->jabatan_bimbingan_perusahaan ?? '' ?>">
          </div>

          <div class="form-group">
            <label for="">No Perusahaan</label>
            <input type="text" class="form-control" name="no_perusahaan" value="<?= $kelompok->no_perusahaan ?? '' ?>">
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
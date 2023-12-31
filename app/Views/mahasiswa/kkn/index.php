<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>
<!-- Default box -->
<?php if (session()->getFlashData('success') !== null) : ?>
  <div class="alert alert-success"><?= session()->getFlashData('success') ?></div>
<?php endif; ?>
<?php if ($anggota) : ?>
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Kelompok KKN <?php if($nama_kelompok):;?> | <?php endif;?> <?php echo $nama_kelompok ?? '' ?></h3>
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
            <th>Program Studi</th>
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
              <td><?= $row['nama_prodi'] ?></td>
              <td><?= $row['is_ketua'] == true ? 'Ketua' : 'Anggota' ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
<?php else : ?>
  <div class="alert alert-info">Anda belum memiliki Kelompok KKN Hubungi Administrasi/Staff Tata Usaha.</div>
<?php endif; ?>
<!-- /.box -->
<?php if ($kelompok ?? '') : ?>
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Informasi Lokasi</h3>
    </div>
    <div class="box-body">
      <form method="POST" action="<?= route_to('mahasiswa.kkn.edit_lokasi') ?>">
        <table class="table table-bordered">
          <tbody>
            <input type="hidden" name="kelompok_id" value="<?= $kelompok->id ?>">
            <tr>
              <th>Nama Lokasi</th>
              <td>
                <?php if ($is_ketua) : ?>
                  <select disabled class="form-control" name="lokasi_id">
                    <option value="">Pilih Lokasi</option>
                    <?php foreach ($lokasi as $row) : ?>
                      <option value="<?= $row['id'] ?>" <?= ($kelompok->lokasi_id == $row['id']) ? 'selected' : '' ?>><?= $row['nama_lokasi'] ?></option>
                    <?php endforeach; ?>
                  </select>
                  <?php if (empty($kelompok->lokasi_id)) : ?>
                    <span class="text-danger">Jika lokasi belum terdaftar harap hubungi admin/staff tata usaha</span>
                  <?php endif; ?>
                <?php else :; ?>
                  <select disabled class="form-control" name="lokasi_id">
                    <option value="">Pilih Lokasi</option>
                    <?php foreach ($lokasi as $row) : ?>
                      <option value="<?= $row['id'] ?>" <?= ($kelompok->lokasi_id == $row['id']) ? 'selected' : '' ?>><?= $row['nama_lokasi'] ?></option>
                    <?php endforeach; ?>
                  </select>
                  <?php if (empty($kelompok->lokasi_id)) : ?>
                    <span class="text-danger">Jika lokasi belum terdaftar harap hubungi admin/staff tata usaha</span>
                  <?php endif; ?>
                <?php endif; ?>
              </td>
            </tr>
            <tr>
              <th>Alamat</th>
              <td>
                <?php
                // Fetch the selected lokasi's alamat from the $lokasi array
                $selectedLokasiId = $kelompok->lokasi_id;
                $selectedAlamat = 'Pilih Desa/Lokasi';

                if ($selectedLokasiId) {
                  foreach ($lokasi as $row) {
                    if ($row['id'] == $selectedLokasiId) {
                      $selectedAlamat = $row['alamat_lokasi'];
                      break;
                    }
                  }
                }
                ?>
                <input type="text" class="form-control" name="alamat_perusahaan" value="<?= $selectedAlamat; ?>" disabled>
              </td>
            </tr>

            <tr>
              <th>Nama Kepala Desa / Pengurus</th>
              <td> <?php if ($is_ketua) : ?>
                  <input type="text" class="form-control" name="nama_kepala_desa" value="<?= $kelompok->nama_kepala_desa ?>">
                <?php else :; ?>
                  <?= $kelompok->nama_kepala_desa ?>
                <?php endif; ?>
              </td>
            </tr>
            <tr>
              <th>Nomor Telpon Kepala Desa / Pengurus</th>
              <td>
                <?php if ($is_ketua) : ?>
                  <input type="number" class="form-control" name="no_kepala_desa" value="<?= $kelompok->no_kepala_desa ?>">
                <?php else :; ?>
                  <?= $kelompok->no_kepala_desa ?>
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
        <h4 class="modal-title">Data Lokasi</h4>
      </div>

      <form method="POST" action="<?= route_to('mahasiswa.kkn.simpan_lokasi') ?>">
        <div class="modal-body">
          <h4>Data Lokasi</h4>
          <div class="form-group">
            <label for="">Nama Lokasi</label>
            <input type="text" class="form-control" name="nama_lokasi" value="<?= $kelompok->nama_lokasi ?? '' ?>">
          </div>

          <div class="form-group">
            <label for="">Alamat</label>
            <input type="text" class="form-control" name="alamat_lokasi" value="<?= $kelompok->alamat_lokasi ?? '' ?>">
          </div>

          <div class="form-group">
            <label for="">Nama Kepala Desa</label>
            <input type="text" class="form-control" name="nama_kepala_desa" value="<?= $kelompok->nama_kepala_desa ?? '' ?>">
          </div>

          <div class="form-group">
            <label for="">No Kepala Desa</label>
            <input type="text" class="form-control" name="no_kepala_desa" value="<?= $kelompok->no_kepala_desa ?? '' ?>">
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
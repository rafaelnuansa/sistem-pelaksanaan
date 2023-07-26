<?php $this->extend('layouts/default'); ?>

<?php $this->section('content'); ?>

<!-- Default box -->
<?php if (session()->getFlashData('success') !== null) : ?>
  <div class="alert alert-success"><?= session()->getFlashData('success') ?></div>
<?php endif; ?>

<div class="box">
  <div class="box-body">
    <div class="table-responsive">
      <table class="table table-hover table-bordered datatable">
        <thead class="bg-primary">
          <tr>
            <th>No</th>
            <th>NIM</th>
            <th>Nama mahasiswa</th>
            <th>Dosen Penguji</th>
            <th>Dosen Pembimbing</th>
            <th>Tempat</th>
            <th>Tanggal</th>
            <th>Jam</th>
            <th>Status</th>
            <th>Penilaian</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;
          foreach ($data as $row) : ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= $row['nim'] ?></td>
              <td><?= $row['nama_mahasiswa'] ?></td>
              <td><span class="label label-primary"><?= $row['dospeng'] ?></span></td>
              <td><span class="label label-danger"><?= $row['dospem'] ?></span></td>
              <td><span class="label label-success"><?= $row['tempat_nama'] ?></span></td>
              <td><span class="label label-primary"><?= $row['tanggal'] ?></span></td>
              <td><span class="label label-primary"><?= $row['jam'] ?></span></td>
              <td>

                <span class="label <?= $row['total_nilai'] === null ? 'label-warning' : ($row['status_ujian'] ? 'label-primary' : 'label-danger') ?>">
                  <?= $row['total_nilai'] === null ? 'Belum Melaksanakan' : ($row['status_ujian'] ? 'Lulus' : 'Tidak Lulus') ?>
                </span>
              </td>
              <td>
                <div class="btn-group">

                  <button type="button" class="btn btn-primary btn-sm btn-open-modal" data-modal-target="#nilaiModal" data-id="<?= $row['id_pkl_jadwal_sidang'] ?>" data-mahasiswa-id="<?= $row['mahasiswa_id'] ?>" data-pkl-id="<?= $row['pkl_id'] ?>" data-dosen-id="<?= $dosenId ?>" data-nilai-sikap="<?= $row['nilai_sikap'] ?>" data-nilai-materi="<?= $row['nilai_penyajian_materi'] ?>" data-nilai-pendahuluan="<?= $row['nilai_pendahuluan'] ?>" data-nilai-tinjauan-pustaka="<?= $row['nilai_tinjauan_pustaka'] ?>" data-nilai-pembahasan="<?= $row['nilai_hasil_pembahasan'] ?>" data-nilai-kesimpulan="<?= $row['nilai_kesimpulan_dan_saran'] ?>" data-nilai-daftar-pustaka="<?= $row['nilai_daftar_pustaka'] ?>" data-nilai-argumentasi="<?= $row['nilai_argumentasi_penyaji'] ?>" data-nilai-penguasaan="<?= $row['nilai_penguasaan_materi'] ?>" data-komentar="<?= $row['catatan'] ?>">
                    Nilai
                  </button>
                  <a href="<?= base_url('dosen/pkl/penilaian/cetak/' . $row['mahasiswa_id']) ?>" class="btn btn-success btn-sm" target="_blank">
                    Cetak
                  </a>
                </div>
              </td>
              <td>
                <a href="<?= base_url('dosen/pkl/berita_acara/' . $row['mahasiswa_id']) ?>" class="btn btn-success btn-sm" target="_blank">
                  Berita Acara
                </a>
              </td>

            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Modal for nilai -->
<div class="modal fade" id="nilaiModal" tabindex="-1" role="dialog" aria-labelledby="nilaiModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <form method="POST" action="<?= base_url('dosen/pkl/penilaian/nilai') ?>">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Formulir penilaian</h4>
        </div>

        <input type="hidden" name="mahasiswa_id" id="mahasiswa_id">
        <input type="hidden" name="pkl_id" id="pkl_id">
        <input type="hidden" name="dosen_id" id="dosen_id">
        <input type="hidden" name="sidang_id" id="sidang_id">
        <div class="modal-body" style="height: 200px;">
          <div class="row mb-2">
            <div class="col-md-12">
              <table class="table table-hover" style="border: 1px solid #f0f0f0; margin-top: 10px;">
                <thead>
                  <tr>
                    <th>No</th>
                    <th><b>Kriteria Penilaian</b></th>
                    <th>Bobot Maksimal Nilai</th>
                    <th>Nilai</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td><b>Sikap/Penampilan Penyaji</b></td>
                    <td>10</td>
                    <td>
                      <input type="number" required step="0.01" class="form-control" name="nilai_sikap" id="nilai_sikap">
                    </td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td><b>Cara Penyajian Materi</b></td>
                    <td>10</td>
                    <td>
                      <input type="number" required step="0.01" class="form-control" name="nilai_penyajian_materi" id="nilai_materi">
                    </td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td><b>Pengorganisasian Makalah</b></td>
                    <td></td>
                    <td>

                    </td>
                  </tr>
                  <tr>
                    <td></td>
                    <td>Pendahuluan</td>
                    <td>10</td>
                    <td>
                      <input type="number" required step="0.01" class="form-control" name="nilai_pendahuluan" id="nilai_pendahuluan">
                    </td>
                  </tr>
                  <tr>
                    <td></td>
                    <td>Tinjauan Pustaka</td>
                    <td>10</td>
                    <td>
                      <input type="number" required step="0.01" class="form-control" name="nilai_tinjauan_pustaka" id="nilai_tinjauan_pustaka">
                    </td>
                  </tr>
                  <tr>
                    <td></td>
                    <td>Hasil dan Pembahasan</td>
                    <td>10</td>
                    <td>
                      <input type="number" required step="0.01" class="form-control" name="nilai_hasil_pembahasan" id="nilai_pembahasan">
                    </td>
                  </tr>
                  <tr>
                    <td></td>
                    <td>Kesimpulan dan Saran</td>
                    <td>10</td>
                    <td>
                      <input type="number" required step="0.01" class="form-control" name="nilai_kesimpulan_dan_saran" id="nilai_kesimpulan">
                    </td>
                  </tr>
                  <tr>
                    <td></td>
                    <td>Daftar Pustaka</td>
                    <td>10</td>
                    <td>
                      <input type="number" required step="0.01" class="form-control" name="nilai_daftar_pustaka" id="nilai_daftar_pustaka">
                    </td>
                  </tr>
                  <tr>
                    <td>4</td>
                    <td><b>Argumentasi Penyaji</b></td>
                    <td>10</td>
                    <td>
                      <input type="number" required step="0.01" class="form-control" name="nilai_argumentasi_penyaji" id="nilai_argumentasi">
                    </td>
                  </tr>
                  <tr>
                    <td>5</td>
                    <td><b>Penguasaan Materi/Konsep/Teori/Produk</b></td>
                    <td>20</td>
                    <td>
                      <input type="number" required step="0.01" class="form-control" name="nilai_penguasaan_materi" id="nilai_penguasaan">
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-12">
              <label for="">Catatan</label>
              <textarea name="catatan" rows="4" class="form-control" id="catatan" style="margin-bottom:8px;"></textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php $this->endSection(); ?>

<?php $this->section('script'); ?>
<script>
  $(document).ready(function() {
    // When the "Nilai" button is clicked, populate the modal form fields with the relevant data from the row
    $('.btn-open-modal').click(function() {

      var id_pkl_jadwal_sidang = $(this).data('id');
      var mahasiswa_id = $(this).data('mahasiswa-id');
      var pkl_id = $(this).data('pkl-id');
      var dosen_id = $(this).data('dosen-id');
      var nilai_sikap = $(this).data('nilai-sikap');
      var nilai_materi = $(this).data('nilai-materi');
      var nilai_pendahuluan = $(this).data('nilai-pendahuluan');
      var nilai_tinjauan_pustaka = $(this).data('nilai-tinjauan-pustaka');
      var nilai_pembahasan = $(this).data('nilai-pembahasan');
      var nilai_kesimpulan = $(this).data('nilai-kesimpulan');
      var nilai_daftar_pustaka = $(this).data('nilai-daftar-pustaka');
      var nilai_argumentasi = $(this).data('nilai-argumentasi');
      var nilai_penguasaan = $(this).data('nilai-penguasaan');
      var catatan = $(this).data('komentar');

      // Set the values in the modal form fields
      $('#sidang_id').val(id_pkl_jadwal_sidang);
      $('#mahasiswa_id').val(mahasiswa_id);
      $('#pkl_id').val(pkl_id);
      $('#dosen_id').val(dosen_id);
      $('#nilai_sikap').val(nilai_sikap);
      $('#nilai_materi').val(nilai_materi);
      $('#nilai_pendahuluan').val(nilai_pendahuluan);
      $('#nilai_tinjauan_pustaka').val(nilai_tinjauan_pustaka);
      $('#nilai_pembahasan').val(nilai_pembahasan);
      $('#nilai_kesimpulan').val(nilai_kesimpulan);
      $('#nilai_daftar_pustaka').val(nilai_daftar_pustaka);
      $('#nilai_argumentasi').val(nilai_argumentasi);
      $('#nilai_penguasaan').val(nilai_penguasaan);
      $('#catatan').val(catatan);

      // Show the modal
      $('#nilaiModal').modal('show');
    });
  });
</script>

<?php $this->endSection(); ?>
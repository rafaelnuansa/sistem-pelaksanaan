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
            <th>Penguji 1</th>
            <th>Penguji 2</th>
            <th>Pembimbing 1</th>
            <th>Pembimbing 2</th>
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
              <td><span class="label label-primary"><?= $row['nama_penguji_1'] ?></span></td>
              <td><span class="label label-primary"><?= $row['nama_penguji_2'] ?></span></td>
              <td><span class="label label-danger"><?= $row['nama_pembimbing_1'] ?></span></td>
              <td><span class="label label-danger"><?= $row['nama_pembimbing_1'] ?></span></td>
              <td><span class="label label-success"><?= $row['tempat_nama'] ?></span></td>
              <td><span class="label label-primary"><?= $row['tanggal'] ?></span></td>
              <td><span class="label label-primary"><?= $row['jam'] ?></span></td>
              <td>

              </td>
              <td>
                <button type="button" class="btn btn-primary btn-sm btn-open-modal" data-modal-target="#nilaiModal" data-sidang-id="<?= $row['idz'] ?>" data-mahasiswa-id="<?= $row['mahasiswa_id'] ?>" data-skripsi-id="<?= $row['skripsi_id'] ?>" data-dosen-id="<?= $dosenId ?>"
                 data-n1a="<?= $nilai->n1a ?? '' ?>"
                 data-n1b="<?= $nilai->n1b ?? '' ?>"
                 data-n1c="<?= $nilai->n1c ?? '' ?>"
                 data-n1d="<?= $nilai->n1d ?? '' ?>"
                 data-n1e="<?= $nilai->n1e ?? '' ?>"
                 data-n1f="<?= $nilai->n1f ?? '' ?>"
                 data-n2a="<?= $nilai->n2a ?? '' ?>" 
                 data-n2b="<?= $nilai->n2b ?? '' ?>">
                  Nilai
                </button>
              </td>
              <td>
                <a href="<?= base_url('dosen/skripsi/penilaian/cetak/' . $row['mahasiswa_id']) ?>" class="btn btn-success btn-sm" target="_blank">
                  Cetak
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

      <form method="POST" action="<?= base_url('dosen/skripsi/penilaian/nilai') ?>">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Formulir penilaian</h4>
        </div>

        <input type="hidden" name="mahasiswa_id" id="mahasiswa_id">
        <input type="hidden" name="skripsi_id" id="skripsi_id">
        <input type="hidden" name="sidang_id" id="sidang_id">

        <div class="modal-body" style="height: 200px;">
          <div class="row mb-2">
            <div class="col-md-12">
              <table class="table">
                <thead>
                  <tr>
                    <th>No</th>
                    <th><b>Komponen Penilaian</b></th>
                    <th>Interval Skor</th>
                    <th>Skor</th>
                  </tr>
                </thead>
                <tbody>

                  <tr>
                    <td>1</td>
                    <td><b>Isi Proposal Skripsi Tertulis</b></td>
                    <td></td>
                    <td>
                    </td>
                  </tr>
                  <tr>
                    <td></td>
                    <td>a. Keaslian (originalitas)</td>
                    <td>0-20</td>
                    <td>
                      <input type="number" required step="0.01" class="form-control" name="n1a" id="n1a">
                    </td>
                  </tr>
                  <tr>
                    <td></td>
                    <td>b. Kejelasan dan keruntutan rumusan masalah, tujuan, pembahasan, dan simpulan</td>
                    <td>0-10</td>
                    <td>
                      <input type="number" required step="0.01" class="form-control" name="n1b" id="n1b">
                    </td>
                  </tr>
                  <tr>
                    <td></td>
                    <td>c. Kemutakhiran, dan kedalaman kajian pustaka</td>
                    <td>0-10</td>
                    <td>
                      <input type="number" required step="0.01" class="form-control" name="n1c" id="n1c">
                    </td>
                  </tr>
                  <tr>
                    <td></td>
                    <td>d. Memiliki relevansi sesuai dengan Jurusan (Bidang Keilmuan)</td>
                    <td>0-10</td>
                    <td>
                      <input type="number" required step="0.01" class="form-control" name="n1d" id="n1d">
                    </td>
                  </tr>
                  <tr>
                    <td></td>
                    <td>e. Kualitas bahasa </td>
                    <td>0-10</td>
                    <td>
                      <input type="number" required step="0.01" class="form-control" name="n1e" id="n1e">
                    </td>
                  </tr>
                  <tr>
                    <td></td>
                    <td>f. Kesesuaian format dengan panduan penulisan skripsi </td>
                    <td>0-10</td>
                    <td>
                      <input type="number" required step="0.01" class="form-control" name="n1f" id="n1f">
                    </td>
                  </tr>

                  <tr>
                    <td>2</td>
                    <td><b>Penyajian Seminar Proposal</b></td>
                    <td></td>
                    <td>
                    </td>
                  </tr>

                  <tr>
                    <td></td>
                    <td>f. Kejelasan dan tampilan penyajian </td>
                    <td>0-10</td>
                    <td>
                      <input type="number" required step="0.01" class="form-control" name="n2a" id="n2a">
                    </td>
                  </tr>
                  
                  <tr>
                    <td></td>
                    <td>f. Penguasaan materi dan kemampuan menjawab pertanyaan </td>
                    <td>0-10</td>
                    <td>
                      <input type="number" required step="0.01" class="form-control" name="n2b" id="n2b">
                    </td>
                  </tr>

                </tbody>
              </table>
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

      var sidang_id = $(this).data('sidang-id');
      var mahasiswa_id = $(this).data('mahasiswa-id');
      var skripsi_id = $(this).data('skripsi-id');
      var dosen_id = $(this).data('dosen-id');
      var n1a = $(this).data('n1a');
      var n1b = $(this).data('n1b');
      var n1c = $(this).data('n1c');
      var n1d = $(this).data('n1d');
      var n1e = $(this).data('n1e');
      var n1f = $(this).data('n1f');
      var n2a = $(this).data('n2a');
      var n2b = $(this).data('n2b');

      // Set the values in the modal form fields
      $('#sidang_id').val(sidang_id);
      $('#mahasiswa_id').val(mahasiswa_id);
      $('#skripsi_id').val(skripsi_id);
      $('#dosen_id').val(dosen_id);
      $('#n1a').val(n1a);
      $('#n1b').val(n1b);
      $('#n1c').val(n1c);
      $('#n1d').val(n1d);
      $('#n1e').val(n1e);
      $('#n1f').val(n1f);
      $('#n2a').val(n2a);
      $('#n2b').val(n2b);

      // Show the modal
      $('#nilaiModal').modal('show');
    });
  });
</script>

<?php $this->endSection(); ?>
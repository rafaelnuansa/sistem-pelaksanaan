<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>

<!-- Default box -->
<?php if(session()->getFlashData('success') !== null): ?>
<div class="alert alert-success"><?= session()->getFlashData('success') ?></div>
<?php endif; ?>
<div class="box">
  <div class="box-body">
    <div class="box-header with-border">
    <h3 class="box-title">Penilaian Ujian</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
              title="Collapse">
        <i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
        <i class="fa fa-times"></i></button>
    </div>
  </div>
    <table class="table table-hover" style="border: 1px solid #f0f0f0; margin-top: 10px;">
      <thead>
        <tr>
          <th>No</th>
          <th>Keterangan</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php if(session()->get('level') == 'Dosen'): ?>
        <tr>
          <td>1</td>
          <td>Lembar penilaian PKL</td>
          <td>
            <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modal-cetak">
            Cetak
          </button>
          </td>
        </tr>
        <tr>
          <td>2</td>
          <td>Lembar Revisi</td>
          <td>
            <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modal-cetak2">
            Cetak
          </button>
          </td>
        </tr>
      <?php else: ?>
        <tr>
          <td>1</td>
          <td>Lembar penilaian PKL</td>
          <td>
            <a href="<?= base_url('downloads/lembar-nilai-pkl.pdf') ?>" target="_blank" class="btn btn-primary">Cetak</a>
          </td>
        </tr>
        <tr>
          <td>2</td>
          <td>Berita Acara</td>
          <td>
            <a href="<?= base_url('downloads/berita-acara.pdf') ?>" target="_blank" class="btn btn-primary">Cetak</a>
          </td>
        </tr>
        <tr>
          <td>3</td>
          <td>Penetapan Nilai</td>
          <td>
            <a href="<?= base_url('downloads/penetapan-nilai.pdf') ?>" target="_blank" class="btn btn-primary">Cetak</a>
          </td>
        </tr>
      <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
<!-- /.box -->

<div class="modal fade" id="modal-cetak">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Formulir penilaian</h4>
      </div>
      <div class="modal-body" style="height: 200px;">
        <form method="POST" action="<?= base_url('dosen/pkl/penilaian/cetak') ?>">
        <div class="row mb-2">
          <div class="col-md-4">
            <div class="form-group">
              <label for="">Nama Mahasiswa</label>
            </div>
          </div>
          <div class="col-md-8">
            <div class="form-group">
              <input type="text" class="form-control" name="nama_mhs">
            </div>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-md-4">
            <div class="form-group">
              <label for="">NIM</label>
            </div>
          </div>
          <div class="col-md-8">
            <div class="form-group">
              <input type="text" class="form-control" name="nim">
            </div>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-md-4">
            <div class="form-group">
              <label for="">Jurusan</label>
            </div>
          </div>
          <div class="col-md-8">
            <div class="form-group">
              <input type="text" class="form-control" name="jurusan">
            </div>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-md-4">
            <div class="form-group">
              <label for="">Tahun Angkatan</label>
            </div>
          </div>
          <div class="col-md-8">
            <div class="form-group">
              <input type="text" class="form-control" name="tahun">
            </div>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-md-4">
            <div class="form-group">
              <label for="">Judul Skripsi</label>
            </div>
          </div>
          <div class="col-md-8">
            <div class="form-group">
              <input type="text" class="form-control" name="judul_skripsi">
            </div>
          </div>
        </div>
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
                    <input type="text" class="form-control" name="nilai[]">
                  </td>
                </tr>
                <tr>
                  <td>2</td>
                  <td><b>Cara Penyajian Materi </b></td>
                  <td>10</td>
                  <td>
                    <input type="text" class="form-control" name="nilai[]">
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
                    <input type="text" class="form-control" name="nilai[]">
                  </td>
                </tr>
                <tr>
                  <td></td>
                  <td>Tinjauan Pustaka </td>
                  <td>10</td>
                  <td>
                    <input type="text" class="form-control" name="nilai[]">
                  </td>
                </tr>
                <tr>
                  <td></td>
                  <td>Hasil dan Pembahasan </td>
                  <td>10</td>
                  <td>
                    <input type="text" class="form-control" name="nilai[]">
                  </td>
                </tr>
                <tr>
                  <td></td>
                  <td>Kesimpulan dan Saran </td>
                  <td>10</td>
                  <td>
                    <input type="text" class="form-control" name="nilai[]">
                  </td>
                </tr>
                <tr>
                  <td></td>
                  <td>Daftar Pustaka </td>
                  <td>10</td>
                  <td>
                    <input type="text" class="form-control" name="nilai[]">
                  </td>
                </tr>
                <tr>
                  <td>4</td>
                  <td><b>Argumentasi Penyaji </b></td>
                  <td>10</td>
                  <td>
                    <input type="text" class="form-control" name="nilai[]">
                  </td>
                </tr>
                <tr>
                  <td>5</td>
                  <td><b>Penguasaan Materi/Konsep/Teori/Produk </b></td>
                  <td>20</td>
                  <td>
                    <input type="text" class="form-control" name="nilai[]">
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>  
        <div class="row mb-2">
          <div class="col-md-12">
            <div class="form-group">
              <label for="">Tempat & Tanggal</label>
              <input type="text" class="form-control" name="tempat_tanggal">
            </div>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-md-6">
            <div class="form-group">
              <label for="">Nama Penguji</label>
              <input type="text" class="form-control" name="nama_penguji">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="">NIDN</label>
              <input type="text" class="form-control" name="nidn">
            </div>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-md-12">
            <label for="">Komentar</label>
            <textarea name="komentar" rows="4" class="form-control" style="margin-bottom:8px;"></textarea>
          </div>
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

<div class="modal fade" id="modal-cetak2">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Lembar revisi</h4>
      </div>
      <div class="modal-body" style="height: 200px;">
        <form method="POST" action="<?= base_url('dosen/pkl/revisi/cetak') ?>">
        <button class="btn btn-primary btn-sm add"><i class="fa fa-plus" style="margin-right: 5px;"></i> Tambahkan BAB</button>
        <div class="row mb-2" style="margin-top: 10px;" id="uraian">
          <div class="col-md-4">
            <label for="">BAB</label>
            <input type="text" class="form-control" name="bab[]">
          </div>
          <div class="col-md-8">
            <label for="">Uraian</label>
            <textarea name="uraian[]" rows="3" class="form-control"></textarea>
          </div>
        </div>
        <div id="lain"></div>
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

<?= $this->section('script'); ?>
<script>
  $('.add').click(function(e) {
    e.preventDefault();
    $('#uraian').clone().appendTo('#lain')
  })
</script>
<?= $this->endSection(); ?>
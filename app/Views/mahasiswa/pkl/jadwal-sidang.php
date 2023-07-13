<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>

<!-- Default box -->
<?php if(session()->getFlashData('success') !== null): ?>
<div class="alert alert-success"><?= session()->getFlashData('success') ?></div>
<?php endif; ?>
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Jadwal Sidang</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
              title="Collapse">
        <i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
        <i class="fa fa-times"></i></button>
    </div>
  </div>
  <div class="box-body">
    <?php if (!empty($data)) : ?>
      <div class="py-2">
        <button class="btn btn-primary daftar">Daftar Ujian PKL</button>
      </div>
      <table class="table table-hover" style="border: 1px solid #f0f0f0; margin-top: 10px;">
        <thead>
          <tr>
            <th>Hari/Tanggal</th>
            <th>NIM</th>
            <th>Nama Mahasiswa</th>
            <th>Tempat</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($data as $row) : ?>
            <tr>
              <td><?= $row['tanggal'] ?></td>
              <td><?= $row['nim'] ?></td>
              <td><?= $row['nama_mahasiswa'] ?></td>
              <td><?= $row['tempat_nama'] ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php else : ?>
      <div class="alert alert-info">Belum Tersedia.</div>
    <?php endif; ?>
  </div>
</div>

<!-- /.box -->

<div class="modal fade" id="modal-tambah">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Pendaftaran Ujian PKL</h4>
      </div>
      <div class="modal-body">
        <form action="<?= route_to('mahasiswa.pkl.jadwal.daftar') ?>" method="POST" enctype="multipart/form-data">
          <div class="row" style="margin-bottom: 10px;">
            <div class="col-md-7">
              <label for="">Kwitansi pembayaran PKL</label>
            </div>
            <div class="col-md-5"><input type="file" class="form-control" name="lampiran_pembayaran"></div>
          </div>
          <div class="row" style="margin-bottom: 10px;">
            <div class="col-md-7">
              <label for="">KRS praktek kerja lapangan</label>
            </div>
            <div class="col-md-5"><input type="file" class="form-control" name="lampiran_krs"></div>
          </div>
          <div class="row" style="margin-bottom: 10px;">
            <div class="col-md-7">
              <label for="">Laporan PKL</label>
            </div>
            <div class="col-md-5"><input type="file" class="form-control" name="lampiran_laporan"></div>
          </div>
          <div class="row" style="margin-bottom: 10px;">
            <div class="col-md-7">
              <label for="">Surat keterangan telah melaksanakan PKL dari instansi</label>
            </div>
            <div class="col-md-5"><input type="file" class="form-control" name="lampiran_keterangan"></div>
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

<?= $this->section('script'); ?>
<script>
  $('.daftar').click(function() {
    $('#modal-tambah').modal('show')
  });
</script>
<?= $this->endSection(); ?>
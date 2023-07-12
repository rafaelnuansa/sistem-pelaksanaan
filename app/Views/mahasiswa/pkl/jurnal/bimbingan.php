<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>

<!-- Default box -->
<?php if (session()->getFlashData('success') !== null) : ?>
  <div class="alert alert-success"><?= session()->getFlashData('success') ?></div>
<?php endif; ?>
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Jurnal Bimbingan (<?= $judul_laporan ?? 'Judul Tidak Ada' ?>)</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
        <i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
        <i class="fa fa-times"></i></button>
    </div>
  </div>
  <div class="box-body">
    <button type="button" class="btn btn-primary mb-2" style="margin-right: 5px;" data-toggle="modal" data-target="#modal-tambah">
      Tambah Jurnal
    </button>
    <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#modal-judul">
      Judul Laporan
    </button>
    <table class="table table-hover" style="border: 1px solid #f0f0f0; margin-top: 10px;">
      <thead>
        <tr>
          <th>No</th>
          <th>Hari/Tanggal</th>
          <th>Jam</th>
          <th>Catatan Bimbingan</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($data as $i => $row) : ?>
          <tr>
            <td><?= $row['id_jurnal_bimbingan'] ?></td>
            <td><?= $row['tanggal'] ?></td>
            <td><?= $row['jam'] ?></td>
            <td><?= $row['catatan'] ?></td>
            <td><?= $row['status'] ?></td>
            <td class="text-center">
                <a href="<?= route_to('mahasiswa.pkl.jurnal.bimbingan.validasi', $row['id_jurnal_bimbingan']) ?>" class="btn btn-primary btn-sm">Edit</a>
                <a href="<?= route_to('mahasiswa.pkl.jurnal.bimbingan.validasi', $row['id_jurnal_bimbingan']) ?>" class="btn btn-danger btn-sm">Hapus</a>
            </td>
          </tr>
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
        <h4 class="modal-title">Tambahkan Jurnal</h4>
      </div>
      <div class="modal-body">
        <form method="POST" action="<?= route_to('mahasiswa.pkl.jurnal.bimbingan.store') ?>" enctype="multipart/form-data">
          <div class="row mb-2">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Jam</label>
                <input type="time" class="form-control" name="jam">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Hari / Tanggal</label>
                <input type="date" class="form-control" name="tanggal">
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-12">
              <div class="form-group">
                <label for="">Catatan</label>
                <textarea name="keterangan" class="form-control" cols="30" rows="5"></textarea>
              </div>
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

<div class="modal fade" id="modal-judul">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Judul Laporan</h4>
      </div>
      <div class="modal-body">
        <form method="POST" action="<?= route_to('mahasiswa.pkl.jurnal.bimbingan.simpanJudul');?>">
          <div class="row mb-2">
            <div class="col-md-12">
              <div class="form-group">
                <label for="">Judul Laporan</label>
                <input type="text" class="form-control" name="judul_laporan" placeholder="Masukkan Judul Laporan">
              </div>
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

<?= $this->endSection(); ?>
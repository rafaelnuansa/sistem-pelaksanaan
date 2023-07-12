<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>

<!-- Default box -->
<?php if(session()->getFlashData('success') !== null): ?>
<div class="alert alert-success"><?= session()->getFlashData('success') ?></div>
<?php endif; ?>
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Dosen Pembimbing</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
              title="Collapse">
        <i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
        <i class="fa fa-times"></i></button>
    </div>
  </div>
  <div class="box-body">
    <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modal-tambah">
      Tambah Dospem
    </button>
    <table class="table table-hover" style="border: 1px solid #f0f0f0; margin-top: 10px;">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Dosen</th>
          <th>Nama Mahasiswa</th>
          <th>NIM</th>
          <th>Keterangan</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($data as $row): ?>
          <tr>
            <td><?= $row['id_dosen'] ?></td>
            <td><?= $row['nama_dosen'] ?></td>
            <td><?= $row['nama_mhs'] ?></td>
            <td><?= $row['nim'] ?></td>
            <td><?= $row['keterangan'] ?></td>
            <td>
              <form style="display: inline;" action="<?= base_url('dosen_pembimbing/delete') ?>" method="POST">
                <input type="hidden" name="id" value="<?= $row['id_dosen'] ?>">
                <button type="button" class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i></button>
              </form>
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
        <h4 class="modal-title">Tambahkan Dosen Pembimbing</h4>
      </div>
      <div class="modal-body">
        <form method="POST" action="<?= base_url('dosen_pembimbing/simpan') ?>">
        <div class="row mb-2">
          <div class="col-md-12">
            <div class="form-group">
              <label for="">Nama Dospem</label>
              <input type="text" class="form-control" name="nama_dosen">
            </div>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-md-12">
            <div class="form-group">
              <label for="">Nama Mahasiswa</label>
              <input type="text" class="form-control" name="nama_mhs">
            </div>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-md-6">
            <div class="form-group">
              <label for="">NIM</label>
              <input type="text" class="form-control" name="nim">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="">Keterangan</label>
              <select class="form-control" name="keterangan">
                <option value="">-- Keterangan --</option>
                <option value="Dospem PKL">Dospem PKL</option>
                <option value="Dospem KKN">Dospem KKN</option>
                <option value="Dospem Skripsi">Dospem Skripsi</option>
              </select>
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

<?= $this->section('script'); ?>
<script>

  $('.delete').click(function() {
    const ok = confirm('Yakin ingin menghapus kelompok?');

    if(ok) {
      $(this).parent().submit();
    }
  });
</script>
<?= $this->endSection(); ?>
<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>

<!-- Default box -->
<?php if(session()->getFlashData('success') !== null): ?>
<div class="alert alert-success"><?= session()->getFlashData('success') ?></div>
<?php endif; ?>
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Upload Berkas</h3>

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
      Upload Berkas Baru
    </button>
    <table class="table table-hover" style="border: 1px solid #f0f0f0; margin-top: 10px;">
      <thead>
        <tr>
          <th>Nama file</th>
          <th>Jenis</th>
          <th>Keterangan</th>
          <th>Tanggal</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($data as $row): ?>
          <tr>
            <td>
              <a href="/uploads/berkas/<?= $row['file'] ?>"><?= $row['nama_file'] ?></a>
            </td>
            <td><?= $row['jenis'] ?></td>
            <td><?= $row['keterangan'] ?></td>
            <td><?= $row['tanggal'] ?></td>
            <td>
              <form style="display: inline;" action="<?= base_url('mahasiswa/upload-berkas/delete') ?>" method="POST">
                <input type="hidden" name="id" value="<?= $row['id_berkas'] ?>">
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
        <h4 class="modal-title">Upload Berkas Baru</h4>
      </div>
      <div class="modal-body">
        <form method="POST" action="" enctype="multipart/form-data">
        <div class="row mb-2">
          <div class="col-md-6">
            <div class="form-group">
              <label for="">Nama File</label>
              <input type="text" class="form-control" name="nama_file">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="">File</label>
              <input type="file" name="file" class="form-control">
            </div>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-md-12">
            <div class="form-group">
              <label for="">Jenis</label>
              <select name="jenis" class="form-control">
                <option value="">-- Pilih Jenis --</option>
                <option value="Word">Word</option>
                <option value="PDF">PDF</option>
                <option value="Gambar">Gambar</option>
                <option value="Lainnya">Lainnya</option>
              </select>
            </div>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-md-12">
            <div class="form-group">
              <label for="">Keterangan</label>
              <select name="keterangan" class="form-control">
                <option value="Bimbingan PKL">Bimbingan PKL</option>
                <option value="Proposal Skripsi">Proposal Skripsi</option>
                <option value="Skripsi">Skripsi</option>
              </select>
            </div>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-md-12">
            <div class="form-group">
              <label for="">Tanggal</label>
              <input type="date" class="form-control" name="tanggal">
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
  $('.edit').click(function() {
    const id = $(this).attr('data-id');
    $.get('<?= base_url('pkl/kelompok/show?id=') ?>' + id, function(data) {
      $('#modal-edit [name="id"]').val(id);
      $('#modal-edit [name="nama_mhs"]').val(data.nama_mhs);
      $('#modal-edit [name="nim"]').val(data.nim);
      $('#modal-edit [name="kelompok"]').val(data.kelompok);

      $('#modal-edit [name="id_jurusan"] option').each(function() {
        if(this.text == data.nama_jurusan) {
          this.setAttribute('selected', '');
        }
      });
    })
    $('#modal-edit').modal('show');
  });

  $('.delete').click(function() {
    const ok = confirm('Yakin ingin menghapus kelompok?');

    if(ok) {
      $(this).parent().submit();
    }
  });
</script>
<?= $this->endSection(); ?>
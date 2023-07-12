<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>

<!-- Default box -->
<?php if(session()->getFlashData('success') !== null): ?>
<div class="alert alert-success"><?= session()->getFlashData('success') ?></div>
<?php endif; ?>
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Daftar Akun</h3>

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
      Tambah Akun
    </button>
    <table class="table table-hover" style="border: 1px solid #f0f0f0; margin-top: 10px;">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nama Lengkap</th>
          <th>Username</th>
          <th>Level</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($users as $row): ?>
          <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['nama'] ?></td>
            <td><?= $row['username'] ?></td>
            <td>
              <?php if($row['level'] == 'Dosen'): ?>
                Dosen Pembimbing
              <?php elseif($row['level'] == 'Dosen2'): ?>
                Dosen Penguji
              <?php else: ?>
                <?= $row['level'] ?>
              <?php endif; ?>
            </td>
            <td>
              <button class="btn btn-info btn-sm edit" data-id="<?= $row['id'] ?>"><i class="fa fa-edit"></i></button>
              <form style="display: inline;" action="<?= base_url('akun/delete') ?>" method="POST">
                <input type="hidden" name="id" value="<?= $row['id'] ?>">
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
        <h4 class="modal-title">Tambahkan Akun</h4>
      </div>
      <div class="modal-body">
        <form method="POST" action="<?= base_url('akun/simpan') ?>">
        <div class="row mb-2">
          <div class="col-md-12">
            <div class="form-group">
              <label for="">Nama</label>
              <input type="text" class="form-control" name="nama">
            </div>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-md-12">
            <div class="form-group">
              <label for="">Username</label>
              <input type="text" class="form-control" name="username">
            </div>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-md-12">
            <div class="form-group">
              <label for="">Password</label>
              <input type="password" class="form-control" name="password">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="">Level</label>
              <select name="level" class="form-control">
                <option value="">-- Pilih Level --</option>
                <option value="Admin">Admin</option>
                <option value="Mahasiswa">Mahasiswa</option>
                <option value="Dosen">Dosen Pembimbing</option>
                <option value="Dosen2">Dosen Penguji</option>
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

<!-- /.modal -->
<div class="modal fade" id="modal-edit">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Kelompok</h4>
      </div>
      <div class="modal-body">
        <form method="POST" action="<?= base_url('akun/update') ?>">
          <input type="hidden" name="id">
        <div class="row mb-2">
          <div class="col-md-12">
            <div class="form-group">
              <label for="">Nama</label>
              <input type="text" class="form-control" name="nama">
            </div>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-md-12">
            <div class="form-group">
              <label for="">Username</label>
              <input type="text" class="form-control" name="username">
            </div>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-md-12">
            <div class="form-group">
              <label for="">Password</label>
              <input type="password" class="form-control" name="password">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="">Level</label>
              <select name="level" class="form-control">
                <option value="">-- Pilih Level --</option>
                <option value="Admin">Admin</option>
                <option value="Mahasiswa">Mahasiswa</option>
                <option value="Dosen">Dosen Pembimbing</option>
                <option value="Dosen2">Dosen Penguji</option>
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
<!-- /.modal -->

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
  $('.edit').click(function() {
    const id = $(this).attr('data-id');
    $.get('<?= base_url('akun/show?id=') ?>' + id, function(data) {
      $('#modal-edit [name="id"]').val(id);
      $('#modal-edit [name="nama"]').val(data.nama);
      $('#modal-edit [name="username"]').val(data.username);

      $('#modal-edit [name="level"] option').each(function() {
        if(this.text == data.level) {
          this.setAttribute('selected', '');
        }
      });
    })
    $('#modal-edit').modal('show');
  });

  $('.delete').click(function() {
    const ok = confirm('Yakin ingin menghapus akun?');

    if(ok) {
      $(this).parent().submit();
    }
  });
</script>
<?= $this->endSection(); ?>
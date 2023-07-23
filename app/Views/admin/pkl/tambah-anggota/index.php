<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>

<!-- Default box -->
<?php if(session()->getFlashData('success') !== null): ?>
<div class="alert alert-success"><?= session()->getFlashData('success') ?></div>
<?php endif; ?>
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title"><?= $title ?></h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
              title="Collapse">
        <i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
        <i class="fa fa-times"></i></button>
    </div>
  </div>
  <div class="box-body">
    <p>Nama Kelompok: <b><?= $kelompok ?></b></p>
    <p>Tahun Pelaksanaan: <b><?= $tgl_mulai ?> - <?= $tgl_selesai ?></b></p>
    <p>Program Studi: <b><?= $prodi ?></b></p>
    <p>Dosen Pembimbing: <b><?= $dospem ?></b></p>
    <button class="btn btn-success add" style="float: right; margin-bottom: 13px;" data-kelompok="<?= $kelompok ?>">Tambahkan Anggota</button>
    <table class="table table-hover datatable" style="border: 1px solid #f0f0f0; margin-top: 10px;">
      <thead>
        <tr>
          <th>No</th>
          <th>Tahun Akademik</th>
          <th>Nama Mahasiswa</th>
          <th>Prodi</th>
          <th>Role</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php $nomor = 0; ?>
        <?php foreach($rows as $index => $row): ?>
          <tr>
            <td><?= ++$nomor; ?></td>
            <td><?= $row['tahun_akademik'] ?></td>
            <td><?= $row['nama'] ?></td>
            <td><?= $jurusan[$index] ?></td>
            <td>
              <select name="status" data-id="<?= $row['id_anggota'] ?>" class="form-control roles">
                <option value="Anggota"<?= ($row['ketua'] == false) ? ' selected':'' ?>>Anggota</option>
                <option value="Ketua"<?= ($row['ketua'] == true) ? ' selected':'' ?>>Ketua</option>
              </select>
            </td>
            <td>
              <form style="display: inline;" action="<?= base_url('pkl/kelompok/anggota/delete') ?>" method="POST">
                <input type="hidden" name="id" value="<?= $row['id_anggota'] ?>">
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
        <h4 class="modal-title">Tambahkan ke Kelompok</h4>
      </div>
      <div class="modal-body">
        <form method="POST" action="<?= base_url('pkl/kelompok') ?>">
        <table class="table table-hover" style="border: 1px solid #f0f0f0; margin-top: 10px;" id="mahasiswa">
        <thead>
          <tr>
            <th>No</th>
            <th>NIM</th>
            <th>Nama Mahasiswa</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $nomor = 0; ?>
          <?php foreach($mahasiswa as $i => $row): ?>
         
            <tr>
              <td><?= ++$nomor ?></td>
              <td><?= $row['nim'] ?></td>
              <td><?= $row['nama'] ?></td>
              <td class="text-center">
                <a href="<?= base_url('pkl/kelompok/tambah-anggota/?pkl='.$id_kelompok.'&mahasiswa_id='.$row['id_mahasiswa']) ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i></a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script src="<?= base_url('bower_components/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') ?>"></script>
<script>
  $('#mahasiswa').DataTable({
    "pageLength": 7
  });

  $('.delete').click(function() {
    const ok = confirm('Yakin ingin menghapus anggota?');

    if(ok) {
      $(this).parent().submit();
    }
  });

  $('.roles').change(function() {
    const id = $(this).attr('data-id');
    const status = $(this).val();
    window.open("<?= base_url('pkl/kelompok/edit/status') ?>?id=" + id + '&status=' + status, '_self');
  });

  $('.add').click(function() {
    const kelompok = $(this).attr('data-kelompok');

    $('#modal-tambah [name="kelompok"]').val(kelompok);
    $('#modal-tambah').modal('show');
  });
</script>
<?= $this->endSection(); ?>
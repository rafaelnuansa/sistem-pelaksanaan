<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>

<!-- Default box -->
<?php if (session()->getFlashData('success') !== null) : ?>
  <div class="alert alert-success"><?= session()->getFlashData('success') ?></div>
<?php endif; ?>
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Jurnal Pelaksanaan</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
        <i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
        <i class="fa fa-times"></i></button>
    </div>
  </div>
  <div class="box-body">
    <!-- <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modal-tambah">
      Tambah Jurnal
    </button> -->
    <table class="table table-hover datatable" style="border: 1px solid #f0f0f0; margin-top: 10px;">
      <thead class="bg-primary">
        <tr>
          <th>No</th>
          <th>Nama mahasiswa</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($data as $index => $row) : ?>
          <tr>
            <td><?= ++$index ?></td>
            <td><?= $row['nama_mhs'] ?></td>
            <td class="text-center">
              <a href="<?= base_url('pkl/jurnal/pelaksanaan/detail/' . $row['nama_mhs']) ?>" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
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
        <form method="POST" action="<?= base_url('pkl/jurnal/1') ?>">
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
                <input type="date" class="form-control" name="hari">
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">DPL</label>
                <input type="text" class="form-control" name="dpl">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="">Keterangan kegiatan PKL</label>
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

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
  $('.delete').click(function() {
    const ok = confirm('Yakin ingin menghapus kelompok?');

    if (ok) {
      $(this).parent().submit();
    }
  });
</script>
<?= $this->endSection(); ?>
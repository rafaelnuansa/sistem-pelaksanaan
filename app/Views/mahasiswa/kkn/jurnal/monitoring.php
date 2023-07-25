<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>

<!-- Default box -->
<?php if (session()->getFlashData('success') !== null) : ?>
  <div class="alert alert-success"><?= session()->getFlashData('success') ?></div>
<?php endif; ?>
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Jurnal Monitoring</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
        <i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
        <i class="fa fa-times"></i></button>
    </div>
  </div>
  <div class="box-body">
    <?php if ($kelompokId) : ?>
      <button type="button" class="btn btn-primary mb-2" style="margin-right: 5px;" data-toggle="modal" data-target="#modal-tambah">
        Tambah Jurnal
      </button>
      <div class="table-responsive" style="margin-top:20px">

        <table class="table table-hover table-bordered datatable" style="margin-top: 10px;">
          <thead class="bg-primary">
            <tr>
              <th>No</th>
              <th>Hari/Tanggal</th>
              <th>Catatan Monitoring</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1;
            foreach ($data as $i => $row) : ?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?= $row['tanggal'] ?></td>
                <td><?= $row['catatan'] ?></td>
                <?php if ($row['status'] == 'Telah divalidasi') : ?>
                  <td><span class="label label-primary"><?= $row['status'] ?></span></td>
                <?php else : ?>
                  <td><span class="label label-danger"><?= $row['status'] ?></span></td>
                <?php endif; ?>
                <td class="text-center">
                  <?php if ($row['status'] == 'Telah divalidasi') : ?>
                  <?php else : ?>
                    <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-edit-<?= $row['id_jurnal_monitoring'] ?>">Edit</a>
                    <a href="<?= route_to('mahasiswa.kkn.jurnal.monitoring.delete', $row['id_jurnal_monitoring']); ?>" class="btn btn-primary btn-sm">Hapus</a>
                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php else : ?>
      <div class="alert alert-info">Kelompok KKN belum tersedia.</div>
    <?php endif; ?>
  </div>
</div>

<?php foreach ($data as $row) : ?>
  <div class="modal fade" id="modal-edit-<?= $row['id_jurnal_monitoring'] ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Edit Jurnal</h4>
        </div>
        <div class="modal-body">
          <form method="POST" action="<?= route_to('mahasiswa.kkn.jurnal.monitoring.edit', $row['id_jurnal_monitoring']); ?>">

            <div class="row mb-2">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Hari / Tanggal</label>
                  <input type="date" class="form-control" name="tanggal" value="<?= $row['tanggal'] ?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="">Keterangan kegiatan KKN</label>
                  <textarea name="catatan" class="form-control" cols="30" rows="5"><?= $row['catatan'] ?></textarea>
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
<?php endforeach; ?>

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
        <form method="POST" action="<?= route_to('mahasiswa.kkn.jurnal.monitoring.store') ?>" enctype="multipart/form-data">
          <div class="row mb-2">
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
                <textarea name="catatan" class="form-control" cols="30" rows="5"></textarea>
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
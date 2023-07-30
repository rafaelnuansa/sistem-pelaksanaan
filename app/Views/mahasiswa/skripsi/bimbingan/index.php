<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>

<!-- Default box -->
<?php if (session()->getFlashData('success') !== null) : ?>
  <div class="alert alert-success"><?= session()->getFlashData('success') ?></div>
<?php endif; ?>

<?php if (session()->getFlashData('error') !== null) : ?>
  <div class="alert alert-danger"><?= session()->getFlashData('error') ?></div>
<?php endif; ?>
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Jurnal Pembimbing 1</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
        <i class="fa fa-minus"></i></button>
    </div>
  </div>
  <div class="box-body">
    <?php if ($skripsi) : ?>
      <button type="button" class="btn btn-primary mb-2" style="margin-right: 5px;" data-toggle="modal" data-target="#modal-tambah">
        Tambah Jurnal
      </button>
      <div class="table-responsive" style="margin-top:20px">
        <table class="table table-hover table-bordered datatable" style="margin-top: 10px;">
          <thead class="bg-primary">
            <tr>
              <th>No</th>
              <th>Hari/Tanggal</th>
              <th>Catatan</th>
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
                    <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-edit-<?= $row['id'] ?>"><i class="fa fa-edit"></i></a>
                    <a href="<?= route_to('mahasiswa.skripsi.bimbingan.delete', $row['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="fa fa-trash"></i></a>
                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php else : ?>
      <div class="alert alert-info">Skripsi Bimbingan Belum tersedia.</div>
    <?php endif; ?>
  </div>
</div>

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Jurnal Pembimbing 2</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
        <i class="fa fa-minus"></i></button>
    </div>
  </div>
  <div class="box-body">
    <?php if ($skripsi) : ?>
      <button type="button" class="btn btn-primary mb-2" style="margin-right: 5px;" data-toggle="modal" data-target="#modal-tambah2">
        Tambah Jurnal
      </button>
      <div class="table-responsive" style="margin-top:20px">
        <table class="table table-hover table-bordered datatable" style="margin-top: 10px;">
          <thead class="bg-primary">
            <tr>
              <th>No</th>
              <th>Hari/Tanggal</th>
              <th>Catatan</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1;
            foreach ($data2 as $i => $row) : ?>
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
                    <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal2-edit-<?= $row['id'] ?>"><i class="fa fa-edit"></i></a>
                    <a href="<?= route_to('mahasiswa.skripsi.bimbingan.delete', $row['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="fa fa-trash"></i></a>
                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php else : ?>
      <div class="alert alert-info">Skripsi Bimbingan Belum tersedia.</div>
    <?php endif; ?>
  </div>
</div>

<?php foreach ($data as $row) : ?>
  <div class="modal fade" id="modal-edit-<?= $row['id'] ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Edit Jurnal</h4>
        </div>
        <div class="modal-body">
          <form method="POST" action="<?= route_to('mahasiswa.skripsi.bimbingan.edit', $row['id']); ?>">
            <div class="row mb-2">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="">Hari / Tanggal</label>
                  <input type="date" class="form-control" required name="tanggal" value="<?= $row['tanggal'] ?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="">Catatan</label>
                  <textarea name="catatan" class="form-control" required cols="30" rows="5"><?= $row['catatan'] ?></textarea>
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

<?php foreach ($data2 as $row) : ?>
  <div class="modal fade" id="modal2-edit-<?= $row['id'] ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Edit Jurnal</h4>
        </div>
        <div class="modal-body">
          <form method="POST" action="<?= route_to('mahasiswa.skripsi.bimbingan.edit', $row['id']); ?>">
            <div class="row mb-2">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="">Hari / Tanggal</label>
                  <input type="date" class="form-control" required name="tanggal" value="<?= $row['tanggal'] ?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="">Catatan</label>
                  <textarea name="catatan" class="form-control" required cols="30" rows="5"><?= $row['catatan'] ?></textarea>
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
        <h4 class="modal-title">Tambah Data Bimbingan 1</h4>
      </div>
      <div class="modal-body">
        <form method="POST" action="<?= route_to('mahasiswa.skripsi.bimbingan.store') ?>" enctype="multipart/form-data">
          <div class="row mb-2">
            <div class="col-md-12">
              <div class="form-group">
                <label for="">Hari / Tanggal</label>
                <input type="date" class="form-control" required name="tanggal">
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-12">
              <div class="form-group">
                <label for="">Catatan</label>
                <textarea name="catatan" class="form-control" required cols="30" rows="5"></textarea>
              </div>
            </div>
          </div>
      </div>
      <div class="modal-footer">

        <input type="hidden" name="is_pembimbing" value="1">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-tambah2">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tambah Data Bimbingan 2</h4>
      </div>
      <div class="modal-body">
        <form method="POST" action="<?= route_to('mahasiswa.skripsi.bimbingan.store') ?>" enctype="multipart/form-data">
          <div class="row mb-2">
            <div class="col-md-12">
              <div class="form-group">
                <label for="">Hari / Tanggal</label>
                <input type="date" class="form-control" required name="tanggal">
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-12">
              <div class="form-group">
                <label for="">Catatan</label>
                <textarea name="catatan" class="form-control" required cols="30" rows="5"></textarea>
              </div>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="is_pembimbing" value="2">
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
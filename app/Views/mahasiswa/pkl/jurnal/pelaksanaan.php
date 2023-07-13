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
    <?php if ($kelompokId) : ?>
      <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modal-tambah">
        Tambah Jurnal
      </button>

      <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modal-formulir">
        Formulir
      </button>
      <table class="table table-hover" style="border: 1px solid #f0f0f0; margin-top: 10px;">
        <thead>
          <tr>
            <th>No</th>
            <th>Hari/Tanggal</th>
            <th>Jam</th>
            <th>Keterangan Kegiatan PKL</th>
            <th>Status</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($data as $i => $row) : ?>
            <tr>
              <td><?= ++$i ?></td>
              <td><?= $row['hari'] ?></td>
              <td><?= $row['jam'] ?></td>
              <td><?= $row['keterangan'] ?></td>
              <td><?= $row['status'] ?></td>
              <td class="text-center">
                <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-edit-<?= $row['id_jurnal_pelaksanaan'] ?>">Edit</a>
                <a href="<?= route_to('mahasiswa.pkl.jurnal.pelaksanaan.delete', $row['id_jurnal_pelaksanaan']); ?>" class="btn btn-primary btn-sm">Hapus</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php else : ?>
      <div class="alert alert-info">Kelompok PKL Belum Tersedia.</div>
    <?php endif; ?>
  </div>
</div>

<!-- /.box -->
<?php foreach ($data as $row) : ?>
  <div class="modal fade" id="modal-edit-<?= $row['id_jurnal_pelaksanaan'] ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Edit Jurnal</h4>
        </div>
        <div class="modal-body">
          <form method="POST" action="<?= route_to('mahasiswa.pkl.jurnal.pelaksanaan.edit', $row['id_jurnal_pelaksanaan']); ?>">

            <div class="row mb-2">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Jam</label>
                  <input type="time" class="form-control" name="jam" value="<?= $row['jam'] ?>">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Hari / Tanggal</label>
                  <input type="date" class="form-control" name="hari" value="<?= $row['hari'] ?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="">Keterangan kegiatan PKL</label>
                  <textarea name="keterangan" class="form-control" cols="30" rows="5"><?= $row['keterangan'] ?></textarea>
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

<div class="modal fade" id="modal-tambah">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tambahkan Jurnal</h4>
      </div>
      <div class="modal-body">
        <form method="POST" action="<?= route_to('mahasiswa.jurnal.pelaksanaan.store'); ?>">
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

<div class="modal fade" id="modal-formulir">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Formulir</h4>
      </div>
      <div class="modal-body">
        <table class="table table-hover" style="border: 1px solid #f0f0f0; margin-top: 10px;">
          <thead>
            <tr>
              <th>No</th>
              <th>Keterangan</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Formulir penilaian PKL</td>
              <td>
                <a href="<?= base_url('downloads/formulir-penilaian.docx') ?>" target="_blank" class="btn btn-primary">Cetak</a>
              </td>
            </tr>
            <tr>
              <td>2</td>
              <td>Kerangka Acuan</td>
              <td>
                <a href="<?= base_url('downloads/kerangka-acuan.docx') ?>" target="_blank" class="btn btn-primary">Cetak</a>
              </td>
            </tr>
            <tr>
              <td>3</td>
              <td>Log Harian</td>
              <td>
                <a href="<?= base_url('mahasiswa/pkl/formulir/log-harian') ?>" target="_blank" class="btn btn-primary">Cetak</a>
              </td>
            </tr>
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
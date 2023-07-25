<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>

<!-- Default box -->
<?php if(session()->getFlashData('success') !== null): ?>
<div class="alert alert-success"><?= session()->getFlashData('success') ?></div>
<?php endif; ?>

<div class="row">
  <div class="col-md-8">
    <div class="box">
      <div class="box-body">
        <form action="<?= base_url('mahasiswa/pkl/daftar') ?>" method="POST" enctype="multipart/form-data">
          <div class="row" style="margin-bottom: 10px;">
            <div class="col-md-7">
              <label for="">1. Surat Layak Ujian dari dosen pembimbing</label>
            </div>
            <div class="col-md-5"><input type="file" class="form-control" name="lampiran_surat_layak"></div>
          </div>
          <div class="row" style="margin-bottom: 10px;">
            <div class="col-md-7">
              <label for="">2. Kwitansi pembayaran PKL</label>
            </div>
            <div class="col-md-5"><input type="file" class="form-control" name="lampiran_pembayaran"></div>
          </div>
          <div class="row" style="margin-bottom: 10px;">
            <div class="col-md-7">
              <label for="">3. KRS praktek kerja lapangan</label>
            </div>
            <div class="col-md-5"><input type="file" class="form-control" name="lampiran_krs"></div>
          </div>
          <div class="row" style="margin-bottom: 10px;">
            <div class="col-md-7">
              <label for="">4. Laporan PKL</label>
            </div>
            <div class="col-md-5"><input type="file" class="form-control" name="lampiran_laporan"></div>
          </div>
          <div class="row" style="margin-bottom: 10px;">
            <div class="col-md-7">
              <label for="">5. Surat keterangan telah melaksanakan PKL dari instansi</label>
            </div>
            <div class="col-md-5"><input type="file" class="form-control" name="lampiran_keterangan"></div>
          </div>
          <button type="submit" class="btn btn-primary">Kirim</button>
        </form>
      </div>
    </div>
    <!-- /.box -->
  </div>
</div>

<?= $this->endSection(); ?>
<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>
<style>
  .surat-box {
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }

  .iframe-container {
    position: relative;
    width: 100%;
    padding-bottom: 56.25%; /* Aspect ratio 16:9 (change as needed) */
    height: 0;
  }

  .iframe-container iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
  }
</style>
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Surat Izin Observasi</h3>
  </div>
  <div class="box-body">
    <!-- Add download attribute to the anchor tag -->
    <a href="<?= base_url('downloads/surat-izin-observasi.docx');?>" class="btn btn-primary" download> <i class="fa fa-envelope"></i> Download Surat Izin Observasi</a>
 
  </div>
</div>
<!-- /.box -->

<?= $this->endSection(); ?>

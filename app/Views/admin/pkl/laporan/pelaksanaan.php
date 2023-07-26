<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
        <a href="<?= base_url('admin/pkl/laporan') ?>" class="btn btn-primary">Kembali</a>
        <a href="<?= base_url('admin/pkl/laporan/jurnal/pelaksanaan/'.$mahasiswa->id.'/cetak') ?>" class="btn btn-success">Cetak</a>
            <br>
            <br>
        <h3 class="box-title">Jurnal Pelaksanaan <?php echo $mahasiswa->nama ?? '' ;?></h3>
        </div>
        <div class="box-body">
            <table class="table table-bordered" id="datatables">
                <thead class="bg-primary">
                    <tr>
                        <th>No</th>
                        <th>Hari</th>
                        <th>Jam</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;?>
                    <?php foreach ($jurnals as $jurnal): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $jurnal['hari'] ?></td>
                        <td><?= $jurnal['jam'] ?></td>
                        <td><?= $jurnal['keterangan'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.box -->

</section>
<!-- /.content -->


<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script src="<?= base_url('bower_components/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') ?>"></script>
<script>
  $('#datatables').DataTable({
    "pageLength": 7
  });

  </script>
  <?= $this->endSection(); ?>
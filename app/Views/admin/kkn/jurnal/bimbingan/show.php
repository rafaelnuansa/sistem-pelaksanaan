<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Jurnal Bimbingan Details</h3>
        </div>
        <div class="box-body">
            <table class="table table-bordered" id="datatables">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Hari</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;?>
                    <?php foreach ($jurnals as $jurnal): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $jurnal['hari'] ?></td>
                        <td><?= $jurnal['keterangan'] ?></td>
                        <td><?= $jurnal['status'] ?></td>
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
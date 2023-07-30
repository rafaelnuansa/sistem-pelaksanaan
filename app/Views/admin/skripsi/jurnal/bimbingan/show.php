<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">SKRIPSI : Jurnal Pembimbing 1</h3>
            <p>Mahasiswa :  <?php echo $mahasiswa->nama ?? ''; ?></p>
        </div>
        <div class="box-body">
            <table class="table table-bordered" id="datatables">
                <thead class="bg-primary">
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th>Hari</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($jurnals as $jurnal) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $jurnal['tanggal'] ?></td>
                            <td><?= $jurnal['catatan'] ?></td>
                            <td>
                                <?php if ($jurnal['status'] == 'Telah divalidasi') : ?>
                                    <span class="label label-primary">Telah divalidasi</span>
                                <?php elseif ($jurnal['status'] == 'Menunggu Validasi') : ?>
                                    <span class="label label-danger">Menunggu Validasi</span>
                                <?php else : ?>
                                    <?= $jurnal['status'] ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">SKRIPSI : Jurnal Pembimbing 2</h3>
            
            <p>Mahasiswa :  <?php echo $mahasiswa->nama ?? ''; ?></p>
        </div>
        <div class="box-body">
            <table class="table table-bordered" id="datatables">
                <thead class="bg-primary">
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th>Hari</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                    </tr>
                </thead> 
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($jurnals2 as $jurnal) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $jurnal['tanggal'] ?></td>
                            <td><?= $jurnal['catatan'] ?></td>
                            <td>
                                <?php if ($jurnal['status'] == 'Telah divalidasi') : ?>
                                    <span class="label label-primary">Telah divalidasi</span>
                                <?php elseif ($jurnal['status'] == 'Menunggu Validasi') : ?>
                                    <span class="label label-danger">Menunggu Validasi</span>
                                <?php else : ?>
                                    <?= $jurnal['status'] ?>
                                <?php endif; ?>
                            </td>
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
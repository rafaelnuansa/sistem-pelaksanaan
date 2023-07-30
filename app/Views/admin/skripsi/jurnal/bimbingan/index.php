<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>


<!-- Main content -->
<section class="content">

<!-- Default box -->
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">SKRIPSI : Jurnal Bimbingan</h3>
    </div>
    <div class="box-body">
        <?php if (session()->getFlashData('success') !== null) : ?>
            <div class="alert alert-success"><?= session()->getFlashData('success') ?></div>
        <?php endif; ?>

        <?php if (session()->getFlashData('error') !== null) : ?>
            <div class="alert alert-danger"><?= session()->getFlashData('error') ?></div>
        <?php endif; ?> 

        <!-- <a href="<?= route_to('admin.jurnal.bimbingan.create') ?>" class="btn btn-primary mb-3">Tambah Jurnal Bimbingan</a> -->

        <div class="table-responsive">
            
        <table class="table table-bordered" id="mahasiswa">
            <thead class="bg-primary">
                <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Mahasiswa</th>
                    <th>Pembimbing 1</th>
                    <th>Pembimbing 2</th>
                    <th>Prodi</th>
                    <th>Aksi</th>
                </tr>
            </thead> 
            <tbody>
                <?php $no = 1; foreach ($mahasiswa as $mhs) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $mhs['nim'] ?></td>
                        <td><?= $mhs['nama'] ?></td>
                        <td><?= $mhs['nama_pembimbing_1'] ?></td>
                        <td><?= $mhs['nama_pembimbing_2'] ?></td>
                        <td><?= $mhs['nama_prodi'] ?></td>
                        <td>
                            <a href="<?= route_to('admin.skripsi.bimbingan.show', $mhs['mhs_id']) ?>" class="btn btn-xs btn-primary"><i class="fa fa-eye"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
        </div>
    </div>
</div>
<!-- /.box -->
</section>
<?= $this->endSection(); ?>


<?= $this->section('script'); ?>
<script src="<?= base_url('bower_components/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') ?>"></script>
<script>
  $('#mahasiswa').DataTable({
    "pageLength": 10
  });

</script>
<?= $this->endSection(); ?>
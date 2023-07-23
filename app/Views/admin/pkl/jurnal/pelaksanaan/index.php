<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
<!-- Default box -->
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Daftar Jurnal Pelaksanaan</h3>
    </div>
    <div class="box-body">
        <?php if (session()->getFlashData('success') !== null) : ?>
            <div class="alert alert-success"><?= session()->getFlashData('success') ?></div>
        <?php endif; ?>

        <?php if (session()->getFlashData('error') !== null) : ?>
            <div class="alert alert-danger"><?= session()->getFlashData('error') ?></div>
        <?php endif; ?>

        <!-- <a href="<?= route_to('admin.jurnal.pelaksanaan.create') ?>" class="btn btn-primary mb-3">Tambah Jurnal Pelaksanaan</a> -->

        <div class="table-responsive">
            
        <table class="table table-bordered datatable" id="mahasiswa">
        <thead class="bg-primary">
                <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama Mahasiswa</th>
                    <th>Prodi</th>
                    <th>Kelompok</th>
                    <th>Instansi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($mahasiswa as $key => $mhs) : ?>
                    <tr>
                        <td><?= $key + 1 ?></td>
                        <td><?= $mhs['nim'] ?></td>
                        <td><?= $mhs['nama'] ?></td>
                        <td><?= $mhs['nama_prodi'] ?></td>
                        <td><?= $mhs['nama_kelompok'] ?></td>
                        <td><?= $mhs['nama_perusahaan'] ?></td>
                        <td> 
                            <a href="<?= route_to('admin.jurnal.pelaksanaan.show', $mhs['mhs_id']) ?>" class="btn btn-xs btn-primary"><i class="fa fa-eye"></i></a>
                            <!-- <a href="<?= route_to('admin.jurnal.pelaksanaan.delete', $mhs['id']) ?>" class="btn btn-xs btn-danger">Hapus</a> -->
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>
    </div>
</div>
<!-- /.box -->
</div>

<?= $this->endSection(); ?>


<?= $this->section('script'); ?>
<script src="<?= base_url('bower_components/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') ?>"></script>

<?= $this->endSection(); ?>
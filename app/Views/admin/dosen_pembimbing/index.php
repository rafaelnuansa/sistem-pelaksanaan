<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Daftar Dosen Pembimbing</h3>
            <div class="box-tools pull-right">
                <a href="<?= route_to('admin.dosen_pembimbing.create'); ?>" class="btn btn-primary">Tambah Dosen Pembimbing</a>
            </div>
        </div>
        <div class="box-body">
            <?php if(session()->getFlashdata('success') !== null): ?>
                <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
            <?php endif; ?>

            <table class="table table-bordered datatable">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Dosen</th>
                        <th>NIDN</th>
                        <th>Mahasiswa</th>
                        <th>NIM</th>
                        <th>Jenis Pembimbing</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($dosenPembimbing as $key => $row): ?>
                        <tr>
                            <td><?= $key + 1; ?></td>
                            <td><?= $row['nama_dosen']; ?></td>
                            <td><?= $row['nidn_dosen']; ?></td>
                            <td><?= $row['nama_mahasiswa']; ?></td>
                            <td><?= $row['nim_mahasiswa']; ?></td>
                            <td><?= $row['jenis_pembimbing']; ?></td>
                            <td>
                                <a href="<?= route_to('admin.dosen_pembimbing.edit', $row['id_dospem']); ?>" class="btn btn-xs btn-primary">Edit</a>
                                <a href="<?= route_to('admin.dosen_pembimbing.delete', $row['id_dospem']); ?>" class="btn btn-xs btn-danger">Hapus</a>
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

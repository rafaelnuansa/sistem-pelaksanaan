<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Tempat Sidang</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <?php if (session()->getFlashdata('success')) : ?>
                    <div class="alert alert-success">
                        <?= session()->getFlashdata('success'); ?>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('error')) : ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('error'); ?>
                    </div>
                <?php endif; ?>

                <a href="<?= route_to('admin.tempat.create'); ?>" class="btn btn-primary mb-2">Tambah Tempat</a>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Tempat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tempat as $key => $tempatItem) : ?>
                                <tr>
                                    <td><?= $key + 1; ?></td>
                                    <td><?= $tempatItem['nama_tempat']; ?></td>
                                    <td>
                                        <a href="<?= route_to('admin.tempat.edit', $tempatItem['id_tempat']); ?>" class="btn btn-primary">Edit</a>
                                        <a href="<?= route_to('admin.tempat.delete', $tempatItem['id_tempat']); ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>

                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->

<?= $this->endSection(); ?>
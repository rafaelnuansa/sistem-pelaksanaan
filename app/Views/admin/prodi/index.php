<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>

<section class="content">
    <!-- Tampilkan pesan sukses jika ada -->
    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success'); ?>
        </div>
    <?php endif; ?>

    <!-- Tampilkan pesan error jika ada -->
    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error'); ?>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Daftar Program Studi</h3>
                    <div class="box-tools">
                        <a href="<?= route_to('admin.prodi.create'); ?>" class="btn btn-primary">Tambah Program Studi</a>
                    </div>
                </div>

                <div class="box-body">
                    <table class="table table-striped datatable">
                        <thead class="bg-primary">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Program Studi</th>
                                <th scope="col">Fakultas</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($prodi) : ?>
                                <?php $no = 1;
                                foreach ($prodi as $row) : ?>
                                    <tr>
                                        <th scope="row"><?= $no++; ?></th>
                                        <td><?= $row['nama_prodi']; ?></td>
                                        <td><?= $row['fakultas']['nama']; ?></td>
                                        <td>
                                            <a href="<?= route_to('admin.prodi.edit', $row['id']); ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                            <form style="display: inline;" action="<?= route_to('admin.prodi.delete', $row['id']); ?>" method="POST" class="d-inline">
                                                <?= csrf_field(); ?>
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus program studi ini?')"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="5">Tidak ada data program studi</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>
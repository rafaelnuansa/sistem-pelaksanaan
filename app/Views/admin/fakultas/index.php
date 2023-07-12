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
                    <h3 class="box-title">Daftar Fakultas</h3>
                    <div class="box-tools">
                        <a href="<?= route_to('admin.fakultas.create'); ?>" class="btn btn-primary">Tambah Fakultas</a>
                    </div>
                </div>

                <div class="box-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Fakultas</th>
                                <th scope="col">Jumlah Prodi</th>
                                <th scope="col">Jumlah Mahasiswa</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($fakultas) : ?>
                                <?php foreach ($fakultas as $index => $row) : ?>
                                    <tr>
                                        <th scope="row"><?= $index + 1; ?></th>
                                        <td><?= $row['nama']; ?></td>
                                        <td><?= $prodiModel->where('fakultas_id', $row['id'])->countAllResults(); ?></td>
                                        <td><?= $mahasiswaModel->whereIn('prodi_id', function ($builder) use ($row) {
                                                return $builder->select('id')->from('prodi')->where('fakultas_id', $row['id']);
                                            })->countAllResults(); ?>
                                        </td>
                                        <td>
                                            <a href="<?= route_to('admin.fakultas.edit', $row['id']); ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                            <form  style="display: inline;" action="<?= route_to('admin.fakultas.delete', $row['id']); ?>" method="post" class="d-inline">
                                                <?= csrf_field(); ?>
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus fakultas ini?')"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="5">Tidak ada data fakultas</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="box-footer clearfix">
                    
                <?php if ($pager) : ?>
                    <?= $pager->links() ?>
                <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>

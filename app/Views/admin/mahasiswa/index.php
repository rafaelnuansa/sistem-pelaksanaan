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
                    <h3 class="box-title">Daftar Mahasiswa</h3>
                    <div class="box-tools">
                        <a href="<?= route_to('admin.mahasiswa.create'); ?>" class="btn btn-primary">Tambah Mahasiswa</a>
                    </div>
                </div>

                <div class="box-body">
                    <table class="table table-striped datatable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">NIM</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Angkatan</th>
                                <th scope="col">Prodi</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($mahasiswa) : ?>
                                <?php foreach ($mahasiswa as $index => $row) : ?>
                                    <tr>
                                        <th scope="row"><?= $index + 1; ?></th>
                                        <td><?= $row['nim']; ?></td>
                                        <td><?= $row['nama']; ?></td>
                                        <td><?= $row['angkatan']; ?></td>
                                        <td><?= $row['nama_prodi']; ?></td>
                                        <td>
                                            <a href="<?= route_to('admin.mahasiswa.edit', $row['id']); ?>" class="btn btn-primary btn-sm">Edit</a>
                                            <form style="display: inline;" action="<?= route_to('admin.mahasiswa.delete', $row['id']); ?>" method="post" class="d-inline">
                                                <?= csrf_field(); ?>
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus mahasiswa ini?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="6">Tidak ada data mahasiswa</td>
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

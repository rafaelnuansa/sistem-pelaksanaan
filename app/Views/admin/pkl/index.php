<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>


<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Data PKL</h3>
                    <div class="box-tools">
                        <a href="<?= site_url('/admin/pkl/create'); ?>" class="btn btn-primary btn-sm">Tambah PKL</a>
                    </div>
                </div>
                <div class="box-body">
                    <?php if (session()->getFlashdata('success')) : ?>
                        <div class="alert alert-success">
                            <?= session()->getFlashdata('success'); ?>
                        </div>
                    <?php endif; ?>

                    <table class="table table-bordered datatable ">
                        <thead class="bg-primary">
                            <tr>
                                <th>No</th>
                                <th>Nama Kelompok</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Tahun Akademik</th>
                                <th>Dosen</th>
                                <th>Prodi</th>
                                <th>Instansi</th>
                                <th>Ketua</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pkls as $key => $pkl) : ?>
                                <tr>
                                    <td><?= $key + 1; ?></td>
                                    <td><?= $pkl['nama_kelompok']; ?></td>
                                    <td><?= $pkl['tgl_mulai']; ?></td>
                                    <td><?= $pkl['tgl_selesai']; ?></td>
                                    <td><?= $pkl['tahun_akademik']; ?></td>
                                    <td><?= $pkl['nama_dosen']; ?></td>
                                    <td><?= $pkl['nama_prodi']; ?></td>
                                    <td><?= $pkl['nama_perusahaan']; ?></td>
                                    <td> <span class="label label-primary">  <?= $pkl['ketua_kelompok'] ?></span>
                            
                                    </td>
                                    <td>
                                        <a href="<?= site_url('/admin/pkl/anggota/' . $pkl['id']); ?>" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></a>
                                        <a href="<?= site_url('/admin/pkl/edit/' . $pkl['id']); ?>" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
                                        <a href="<?= site_url('admin/pkl/delete/' . $pkl['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus Kelompok PKL ini?')"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>
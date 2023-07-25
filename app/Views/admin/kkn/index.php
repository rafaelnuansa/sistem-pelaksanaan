<?= $this->extend('layouts/default'); ?>
<?= $this->section('content'); ?>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Data Kelompok KKN</h3>
                    <div class="box-tools">
                        <a href="<?= site_url('/admin/kkn/create'); ?>" class="btn btn-primary btn-sm">Tambah KKN</a>
                    </div>
                </div>
                <div class="box-body">
                    <?php if (session()->getFlashdata('success')) : ?>
                        <div class="alert alert-success">
                            <?= session()->getFlashdata('success'); ?>
                        </div>
                    <?php endif; ?>
                    <div class="table-responsive">

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
                                    <th>Desa</th>
                                    <th>Ketua</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($kkns as $key => $kkn) : ?>
                                    <tr>
                                        <td><?= $key + 1; ?></td>
                                        <td><?= $kkn['nama_kelompok']; ?></td>
                                        <td><?= $kkn['tgl_mulai']; ?></td>
                                        <td><?= $kkn['tgl_selesai']; ?></td>
                                        <td><?= $kkn['tahun_akademik']; ?></td>
                                        <td><?= $kkn['nama_dosen']; ?></td>
                                        <td><?= $kkn['nama_prodi']; ?></td>
                                        <td><?= $kkn['nama_lokasi'] ?? ''; ?></td>
                                        <td> <span class="label label-primary"> <?= $kkn['ketua_kelompok'] ?></span>

                                        </td>
                                        <td>
                                            <a href="<?= site_url('/admin/kkn/anggota/' . $kkn['id']); ?>" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></a>
                                            <a href="<?= site_url('/admin/kkn/edit/' . $kkn['id']); ?>" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
                                            <a href="<?= site_url('admin/kkn/delete/' . $kkn['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus Kelompok KKN ini?')"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>``
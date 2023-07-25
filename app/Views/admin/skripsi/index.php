<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Data Skripsi</h3>
                    <div class="box-tools">
                        <a href="<?= site_url('/admin/skripsi/create'); ?>" class="btn btn-primary btn-sm">Tambah Skripsi</a>
                    </div>
                </div>
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
                    <div class="table-responsive">

                        <table class="table table-bordered datatable ">
                            <thead class="bg-primary">
                                <tr>
                                    <th>No</th>
                                    <th>Nim</th>
                                    <th>Mahasiswa</th>
                                    <th>Dosen Pembimbing</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Selesai</th>
                                    <th>Tahun Akademik</th>
                                    <th>Prodi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach ($skripsis as $row) : ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $row['nim']; ?></td>
                                        <td><?= $row['nama_mahasiswa']; ?></td>
                                        <td><?= $row['nama_dosen']; ?></td>
                                        <td><?= $row['tgl_mulai']; ?></td>
                                        <td><?= $row['tgl_selesai']; ?></td>
                                        <td><?= $row['tahun_akademik']; ?></td>
                                        <td><?= $row['nama_prodi']; ?></td>
                                        <td>
                                            <a href="<?= site_url('/admin/skripsi/edit/' . $row['id']); ?>" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
                                            <a href="<?= site_url('admin/skripsi/delete/' . $row['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="fa fa-trash"></i></a>
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

<!-- Modal -->
<div class="modal fade" id="instansiModal" tabindex="-1" role="dialog" aria-labelledby="instansiModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="instansiModalLabel">Detail Instansi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Company details will be displayed here -->
                <table class="table table-bordered">
                    <tbody id="companyDetails">
                        <tr>
                            <th>Nama Perusahaan</th>
                            <td id="namaPerusahaan"></td>
                        </tr>
                        <tr>
                            <th>Alamat Perusahaan</th>
                            <td id="alamatPerusahaan"></td>
                        </tr>
                        <tr>
                            <th>Bimbingan Perusahaan</th>
                            <td id="bimbinganPerusahaan"></td>
                        </tr>
                        <tr>
                            <th>Jabatan Bimbingan Perusahaan</th>
                            <td id="jabatanBimbinganPerusahaan"></td>
                        </tr>
                        <tr>
                            <th>Nomor Perusahaan</th>
                            <td id="nomorPerusahaan"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
    $(document).ready(function() {
        // Add click event to company name with class 'show-instansi-modal'
        $('.show-instansi-modal').click(function() {
            // Get the company details from the data attributes of the clicked element
            var namaPerusahaan = $(this).data('nama-perusahaan');
            var alamatPerusahaan = $(this).data('alamat-perusahaan');
            var jabatan = $(this).data('jabatan-bimbingan-perusahaan');
            var bimbingan = $(this).data('bimbingan-perusahaan');
            var nomor = $(this).data('no-perusahaan');

            // Set the company details in the modal
            $('#namaPerusahaan').text(namaPerusahaan);
            $('#alamatPerusahaan').text(alamatPerusahaan);
            $('#bimbinganPerusahaan').text(bimbingan);
            $('#jabatanBimbinganPerusahaan').text(jabatan);
            $('#nomorPerusahaan').text(nomor);

            // Show the modal
            $('#instansiModal').modal('show');
        });
    });
</script>

<?= $this->endSection(); ?>
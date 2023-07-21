<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid">

    <?php if (session()->getFlashData('success') !== null) : ?>
        <div class="alert alert-success"><?= session()->getFlashData('success') ?></div>
    <?php endif; ?>

    <?php if (session()->getFlashData('error') !== null) : ?>
        <div class="alert alert-warning"><?= session()->getFlashData('error') ?></div>
    <?php endif; ?>
    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Berkas</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <!-- Form Filter -->
                <form action="<?= site_url('mahasiswa/berkas'); ?>" method="get">
                    <div class="form-group">
                        <label for="jenis">Filter Jenis</label>
                        <select name="jenis" class="form-control">
                            <option value="">-- Pilih Jenis --</option>
                            <option value="Word">Word</option>
                            <option value="PDF">PDF</option>
                            <option value="Gambar">Gambar</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Filter Keterangan</label>
                        <select name="keterangan" class="form-control">
                            <option value="">-- Pilih Keterangan --</option>
                            <option value="Bimbingan PKL">Bimbingan PKL</option>
                            <option value="Proposal Skripsi">Proposal Skripsi</option>
                            <option value="Skripsi">Skripsi</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="<?= base_url('mahasiswa/berkas');?>" class="btn btn-primary">Reset</a>
                </form>
                <hr>
                <!-- Button untuk modal Create -->
                <button type="button" id="uploadFileBtn" class="btn btn-primary" style="margin-bottom: 5px;" data-toggle="modal" data-target="#createModal">Upload File</button>

                <!-- Your content for the index page goes here -->
                <?php if (!empty($berkas)) : ?>
                    <table class="table table-bordered table-striped datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama File</th>
                                <th>Jenis</th>
                                <th>Keterangan</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($berkas as $key => $item) : ?>
                                <tr>
                                    <td><?= $key + 1; ?></td>
                                    <td><?= $item['nama_file']; ?></td>
                                    <td><?= $item['jenis']; ?></td>
                                    <td><?= $item['keterangan']; ?></td>
                                    <td><?= $item['tanggal']; ?></td>
                                    <td>
                                        
                                    <a href="<?= site_url('uploads/' . $item['file']); ?>" class="btn btn-success btn-sm"><i class="fa fa-file"></i></a>
                                        <button type="button" class="btn btn-primary btn-sm editBtn" data-id-berkas="<?= $item['id_berkas']; ?>" data-file="<?= $item['file']; ?>" data-nama-file="<?= $item['nama_file']; ?>" data-jenis="<?= $item['jenis']; ?>" data-keterangan="<?= $item['keterangan']; ?>" data-file-link="<?= base_url('uploads/' . $item['file']); ?>" data-toggle="modal" data-target="#editModal">
                                            Edit
                                        </button>
                                        <a href="<?= site_url('mahasiswa/berkas/delete/' . $item['id_berkas']); ?>" class="btn btn-danger btn-sm">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else : ?>
                    <p>Tidak ada berkas yang ditemukan.</p>
                <?php endif; ?>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Upload Berkas Baru</h4>
            </div>
            <div class="modal-body">
                <form action="<?= site_url('mahasiswa/berkas'); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nama_file">Nama File</label>
                        <input type="text" name="nama_file" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="jenis">Jenis</label>
                        <select name="jenis" class="form-control">
                            <option value="">-- Pilih Jenis --</option>
                            <option value="Word">Word</option>
                            <option value="PDF">PDF</option>
                            <option value="Gambar">Gambar</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <select name="keterangan" class="form-control">
                            <option value="Bimbingan PKL">Bimbingan PKL</option>
                            <option value="Proposal Skripsi">Proposal Skripsi</option>
                            <option value="Skripsi">Skripsi</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="file">File</label>
                        <input type="file" name="file" class="form-control-file" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /.modal -->

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Edit Berkas</h4>
            </div>
            <div class="modal-body" id="editModalBody">
                <form action="<?= site_url('mahasiswa/berkas/update'); ?>" enctype="multipart/form-data" method="post">
                    <input type="hidden" name="berkas_id" id="edit_berkas_id" value="">
                    <div class="form-group">
                        <label for="edit_nama_file">Nama File</label>
                        <input type="text" name="nama_file" id="edit_nama_file" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_jenis">Jenis</label>
                        <select name="jenis" id="edit_jenis" class="form-control">
                            <option value="Word">Word</option>
                            <option value="PDF">PDF</option>
                            <option value="Gambar">Gambar</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_keterangan">Keterangan</label>
                        <select name="keterangan" id="edit_keterangan" class="form-control">
                            <option value="Bimbingan PKL">Bimbingan PKL</option>
                            <option value="Proposal Skripsi">Proposal Skripsi</option>
                            <option value="Skripsi">Skripsi</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="edit_file">File Lama</label><br>
                        <a id="edit_file_link" href="" target="_blank"></a>
                    </div>
                    <div class="form-group">
                        <label for="edit_new_file">File Baru</label>
                        <input type="file" name="new_file" id="edit_new_file" class="form-control-file">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /.modal -->


<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>


    // Show the edit modal with selected jenis and keterangan
    $(document).on('click', '.editBtn', function() {
        var idBerkas = $(this).data('id-berkas');
        var namaFile = $(this).data('nama-file');
        var file = $(this).data('file');
        var jenis = $(this).data('jenis');
        var keterangan = $(this).data('keterangan');
        var fileLink = $(this).data('file-link'); // Assume this is the link to the existing file

        // Set the values in the edit modal
        $('#edit_berkas_id').val(idBerkas);
        $('#edit_nama_file').val(namaFile);
        $('#edit_jenis').val(jenis);
        $('#edit_keterangan').val(keterangan);

        // Set the file link in the modal
        $('#edit_file_link').attr('href', fileLink);
        $('#edit_file_link').text(file);

        // Show the edit modal
        $('#editModal').modal('show');
    });
</script>

<?= $this->endSection(); ?>
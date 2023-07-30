<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Kelompok : <?= $kelompok; ?></h3>

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
                    <button class="btn btn-success pull-right add" data-kelompok="<?= $kelompok ?>">Tambahkan Anggota</button>

                    <p>Nama Kelompok: <b><?= $kelompok ?></b></p>
                    <p>Tahun Pelaksanaan: <b><?= $tgl_mulai ?> - <?= $tgl_selesai ?></b></p>
                    <p>Dosen Pembimbing: <b><?= $dospem ?></b></p>
                
                    <div class="table-resposive">
                        
                    <table class="table table-bordered datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tahun Akademik</th>
                                <th>Mahasiswa</th>
                                <th>Prodi</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php $nomor = 0; ?>
                            <?php foreach ($rows as $row) : ?>
                                    <tr>
                                        <td><?= $row['id']; ?></td>
                                        <td><?= $row['tahun_akademik'] ?></td>
                                        <td><?= $row['nama'] ?></td>
                                        <td><?= $row['nama_prodi'] ?></td>
                                        <td>
                                            <select name="status" data-kkn_id="<?= $id_kelompok;?>" data-id="<?= $row['id'] ?>" class="form-control roles">
                                                <option value="Anggota" <?= ($row['is_ketua'] == false) ? ' selected' : '' ?>>Anggota</option>
                                                <option value="Ketua" <?= ($row['is_ketua'] == true) ? ' selected' : '' ?>>Ketua</option>
                                            </select>
                                        </td>
                                        <td>
                                            <form style="display: inline;" action="<?= base_url('admin/kkn/anggota/delete') ?>" method="POST">
                                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                                <button type="button" class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i></button>
                                            </form>

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


<div class="modal fade" id="modal-tambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambahkan ke Kelompok</h4>

            </div>
            <div class="modal-body">
                <form method="POST" action="<?= base_url('kkn/kelompok') ?>">
                    <table class="table table-hover" style="border: 1px solid #f0f0f0; margin-top: 10px;" id="mahasiswa">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIM</th>
                                <th>Nama Mahasiswa</th>
                                <th>Prodi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $nomor = 0; ?>

                            <?php foreach ($mahasiswa as $row) : ?>
                                <tr> 
                                    <td><?= ++$nomor ?></td>
                                    <td><?= $row['nim'] ?></td>
                                    <td><?= $row['nama'] ?></td>
                                    <td><?= $row['nama_prodi'] ?></td>
                                    <td class="text-center">
                                        <a href="<?= base_url('admin/kkn/anggota/tambah?kkn=' . $id_kelompok . '&mahasiswa_id=' . $row['mhs_id']) ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<?= $this->endSection(); ?>


<?= $this->section('script'); ?>
<script src="<?= base_url('bower_components/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') ?>"></script>
<script>
    $('#mahasiswa').DataTable({
        "pageLength": 7
    });

    $('.delete').click(function() {
        const ok = confirm('Yakin ingin menghapus anggota?');

        if (ok) {
            $(this).parent().submit();
        }
    });

    $('.roles').change(function() {
        const id = $(this).attr('data-id');
        const kkn_id = $(this).attr('data-kkn_id');
        const status = $(this).val();
        window.open("<?= base_url('admin/kkn/anggota/status') ?>?kkn_id="+kkn_id+'&id=' + id + '&status=' + status, '_self');
    });

    $('.add').click(function() {
        const kelompok = $(this).attr('data-kelompok');

        $('#modal-tambah [name="kelompok"]').val(kelompok);
        $('#modal-tambah').modal('show');
    });
</script>
<?= $this->endSection(); ?>
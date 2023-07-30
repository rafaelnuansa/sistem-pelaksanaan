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
                        <!-- Add the refresh button -->
                        <button class="btn btn-info btn-sm" id="refreshButton"><i class="fa fa-refresh"></i> Refresh</button>
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

                    <!-- Add the Prodi filter -->
                    <div class="form-group">
                        <label for="prodiFilter">Filter by Prodi:</label>
                        <select id="prodiFilter" class="form-control">
                            <option value="">All</option>
                            <?php foreach ($prodiList as $prodi) : ?>
                                <option value="<?= $prodi['id']; ?>"><?= $prodi['nama_prodi']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered skripsiTable">
                            <thead class="bg-primary">
                                <tr>
                                    <th>No</th>
                                    <th>Nim</th>
                                    <th>Mahasiswa</th>
                                    <th>Pembimbing 1</th>
                                    <th>Pembimbing 2</th>
                                    <th>Prodi</th>
                                    <th>Tahun Akademik</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <!-- The content will be loaded dynamically using DataTables -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
    $(document).ready(function() {
        var skripsiTable = $('.skripsiTable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true, // Enable responsive display for the table
            ajax: {
                url: '<?= site_url('/admin/skripsi/skripsi_ajax'); ?>',
                type: 'POST',
                data: function(data) {
                    data.prodi_id = $('#prodiFilter').val();
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    orderable: false
                },
                {
                    data: 'nim'
                },
                {
                    data: 'nama_mahasiswa'
                },
                {
                    data: 'nama_pembimbing_1'
                },
                {
                    data: 'nama_pembimbing_2'
                },
                {
                    data: 'nama_prodi'
                },
                {
                    data: 'tahun_akademik'
                },
                {
                    data: 'id',
                    render: function(data, type, row) {
                        return '<a href="<?= site_url('/admin/skripsi/edit/'); ?>' + data + '" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a> ' +
                            '<a href="<?= site_url('/admin/skripsi/delete/'); ?>' + data + '" class="btn btn-sm btn-danger" onclick="return confirm(\'Apakah Anda yakin ingin menghapus data ini?\')"><i class="fa fa-trash"></i></a>';
                    },
                    orderable: false
                }
            ],
        });
        // Add event listener to the refresh button
        $('#refreshButton').on('click', function() {
            skripsiTable.ajax.reload();
        });
        $('#prodiFilter').on('change', function() {
            skripsiTable.ajax.reload();
        });
    });
</script>
<?= $this->endSection(); ?>
<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>

<!-- Default box -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Create Jurnal Pelaksanaan</h3>
    </div>
    <div class="card-body">
        <?php if(session()->getFlashData('success') !== null): ?>
            <div class="alert alert-success"><?= session()->getFlashData('success') ?></div>
        <?php endif; ?>

        <form action="<?= route_to('admin.jurnal.pelaksanaan.store') ?>" method="POST">
            <?= csrf_field() ?>

            <div class="form-group">
                <label for="mahasiswa_id">Mahasiswa ID</label>
                <input type="text" name="mahasiswa_id" class="form-control">
            </div>

            <div class="form-group">
                <label for="jam">Jam</label>
                <input type="text" name="jam" class="form-control">
            </div>

            <div class="form-group">
                <label for="hari">Hari</label>
                <input type="text" name="hari" class="form-control">
            </div>

            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <textarea name="keterangan" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label for="pkl_id">PKL ID</label>
                <input type="text" name="pkl_id" class="form-control">
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" class="form-control">
                    <option value="Pending">Pending</option>
                    <option value="Approved">Approved</option>
                    <option value="Rejected">Rejected</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>

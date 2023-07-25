<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>

<!-- Default box -->
<?php if(session()->getFlashData('success') !== null): ?>
    <div class="alert alert-success"><?= session()->getFlashData('success') ?></div>
<?php endif; ?>

<h1>Edit Jurnal Pelaksanaan</h1>

<form action="<?= route('admin.kkn.jurnal.pelaksanaan.update', $jurnal['id_jurnal_pelaksanaan']) ?>" method="POST">
    <?= csrf_field() ?>
    <?= method_field('PUT') ?>

    <div class="form-group">
        <label for="mahasiswa_id">Mahasiswa ID</label>
        <input type="text" name="mahasiswa_id" value="<?= $jurnal['mahasiswa_id'] ?>" class="form-control">
    </div>

    <div class="form-group">
        <label for="jam">Jam</label>
        <input type="text" name="jam" value="<?= $jurnal['jam'] ?>" class="form-control">
    </div>

    <div class="form-group">
        <label for="hari">Hari</label>
        <input type="text" name="hari" value="<?= $jurnal['hari'] ?>" class="form-control">
    </div>

    <div class="form-group">
        <label for="keterangan">Keterangan</label>
        <textarea name="keterangan" class="form-control"><?= $jurnal['keterangan'] ?></textarea>
    </div>

    <div class="form-group">
        <label for="pkl_id">PKL ID</label>
        <input type="text" name="pkl_id" value="<?= $jurnal['pkl_id'] ?>" class="form-control">
    </div>

    <div class="form-group">
        <label for="status">Status</label>
        <select name="status" class="form-control">
            <option value="Pending" <?= $jurnal['status'] === 'Pending' ? 'selected' : '' ?>>Pending</option>
            <option value="Approved" <?= $jurnal['status'] === 'Approved' ? 'selected' : '' ?>>Approved</option>
            <option value="Rejected" <?= $jurnal['status'] === 'Rejected' ? 'selected' : '' ?>>Rejected</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>

<?= $this->endSection(); ?>

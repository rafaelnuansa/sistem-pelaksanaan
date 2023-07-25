<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">

                    <?php if (session()->getFlashdata('error')) : ?>
                        <div class="alert alert-danger">
                            <?= session()->getFlashdata('error'); ?>
                        </div>
                    <?php endif; ?>
                    <form action="<?= site_url('/admin/skripsi'); ?>" method="post">
                        <?= csrf_field(); ?>
                        <div class="form-group">
                            <label for="mahasiswa_id">Mahasiswa</label>
                            <select name="mahasiswa_id" class="form-control" required>
                                <option value="">Pilih Mahasiswa</option>
                                <?php foreach ($mahasiswas as $mahasiswa) : ?>
                                    <option value="<?= $mahasiswa['id']; ?>"><?= $mahasiswa['nim']; ?> | <?= $mahasiswa['nama']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="dosen_id">Dosen</label>
                            <select name="dosen_id" class="form-control" required>
                                <option value="">Pilih Dosen</option>
                                <?php foreach ($dosens as $dosen) : ?>
                                    <option value="<?= $dosen['id']; ?>"><?= $dosen['nama']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="tgl_mulai">Tanggal Mulai</label>
                            <input type="date" name="tgl_mulai" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="tgl_selesai">Tanggal Selesai</label>
                            <input type="date" name="tgl_selesai" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="tahun_akademik">Tahun Akademik</label>
                            <select name="tahun_akademik" class="form-control" required>
                                <option value="">Pilih Tahun Akademik</option>
                                <?php
                                // Get the current year
                                $currentYear = date('Y');

                                // Create options for 5 years before and after the current year
                                for ($i = $currentYear - 5; $i <= $currentYear + 5; $i++) {
                                    $nextYear = $i + 1;
                                    $optionValue = $i . '/' . $nextYear;
                                    echo '<option value="' . $optionValue . '">' . $optionValue . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>
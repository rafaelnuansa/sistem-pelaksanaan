<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <form action="<?= site_url('/admin/pkl'); ?>" method="post">
                        <?= csrf_field(); ?>

                        <div class="form-group">
                            <label for="nama_kelompok">Nama Kelompok</label>
                            <input type="text" name="nama_kelompok" class="form-control" required>
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

                                // Loop through the years starting from the current year and going back to 2015
                                for ($i = $currentYear; $i >= 2015; $i--) {
                                    $nextYear = $i + 1;
                                    $optionValue = $i . '/' . $nextYear;
                                    echo '<option value="' . $optionValue . '">' . $optionValue . '</option>';
                                }
                                ?>
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
                            <label for="prodi_id">Prodi</label>
                            <select name="prodi_id" class="form-control" required>
                                <option value="">Pilih Prodi</option>
                                <?php foreach ($prodis as $prodi) : ?>
                                    <option value="<?= $prodi['id']; ?>"><?= $prodi['nama_prodi']; ?></option>
                                <?php endforeach; ?>
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
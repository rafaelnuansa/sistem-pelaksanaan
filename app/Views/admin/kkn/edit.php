<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>


<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <form action="<?= route_to('admin.kkn.update', $kkn['id']); ?>" method="post">
                        <?= csrf_field(); ?>
                        <div class="form-group">
                            <label for="nama_kelompok">Nama Kelompok</label>
                            <input type="text" name="nama_kelompok" class="form-control" value="<?= $kkn['nama_kelompok']; ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="tgl_mulai">Tanggal Mulai</label>
                            <input type="date" name="tgl_mulai" class="form-control" value="<?= $kkn['tgl_mulai']; ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="tgl_selesai">Tanggal Selesai</label>
                            <input type="date" name="tgl_selesai" class="form-control" value="<?= $kkn['tgl_selesai']; ?>" required>
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
                                    $selected = ($kkn['tahun_akademik'] == $optionValue) ? 'selected' : '';
                                    echo '<option value="' . $optionValue . '" ' . $selected . '>' . $optionValue . '</option>';
                                }
                                ?>
                            </select>
                        </div>
 
                        <div class="form-group">
                            <label for="dosen_id">Dosen</label>
                            <select name="dosen_id" class="form-control" required>
                                <option value="">Pilih Dosen</option>
                                <?php foreach ($dosens as $dosen) : ?>
                                    <option value="<?= $dosen['id']; ?>" <?= $dosen['id'] == $kkn['dosen_id'] ? 'selected' : ''; ?>><?= $dosen['nama']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="lokasi_id">Lokasi</label>
                            <select name="lokasi_id" class="form-control" required>
                                <option value="">Pilih Lokasi</option>
                                <?php foreach ($lokasi as $row) : ?>
                                    <option value="<?= $row['id']; ?>" <?= $row['id'] == $kkn['lokasi_id'] ? 'selected' : ''; ?>><?= $row['nama_lokasi']; ?></option>
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
<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>

<!-- Default box -->
<?php if(session()->getFlashData('success') !== null): ?>
<div class="alert alert-success"><?= session()->getFlashData('success') ?></div>
<?php endif; ?>

<div class="row">
  <div class="col-md-6">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title"></h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                  title="Collapse">
            <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">
        <form action="<?= base_url('pkl/kelompok/detail/'.$kelompok) ?>" method="POST">
          <div class="row" style="margin-bottom: 8px;">
            <div class="col-md-4">
              Tanggal Mulai
            </div>
            <div class="col-md-8">
              <input type="date" class="form-control" name="tgl_mulai" value="<?= $tgl_mulai ?>">
            </div>
          </div>
          <div class="row" style="margin-bottom: 8px;">
            <div class="col-md-4">
              Tanggal Selesai
            </div>
            <div class="col-md-8">
              <input type="date" class="form-control" name="tgl_selesai" value="<?= $tgl_selesai ?>">
            </div>
          </div>
          <div class="row" style="margin-bottom: 8px;">
            <div class="col-md-4">
              Prodi
            </div>
            <div class="col-md-8">
              <select name="prodi_id" class="form-control">
                <option value="">-- Pilih Prodi --</option>
                <?php foreach($jurusan as $row): ?>
                  <option value="<?= $row['id_jurusan'] ?>"<?= ($prodi == $row['id_jurusan']) ? ' selected' : '' ?>><?= $row['nama_jurusan'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="row" style="margin-bottom: 8px;">
            <div class="col-md-4">
              Dosen Pembimbing
            </div>
            <div class="col-md-8">
              <select name="dosen_id" class="form-control">
                <option value="">-- Pilih Dosen --</option>
                <?php foreach($dospem as $row): ?>
                  <option value="<?= $row['id'] ?>"<?= ($dosen_id == $row['id']) ? ' selected' : '' ?>><?= $row['nama'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="row" style="margin-bottom: 8px;">
            <div class="col-md-4">
              Tahun Akademik
            </div>
            <div class="col-md-8">
              <select name="tahun_akademik" class="form-control">
                <option value="">-- Pilih Tahun --</option>
                <option value="2020/2021"<?= ($tahun_akademik == '2020/2021') ? ' selected' : '' ?>>2020/2021</option>
                <option value="2021/2022"<?= ($tahun_akademik == '2021/2022') ? ' selected' : '' ?>>2021/2022</option>
                <option value="2022/2023"<?= ($tahun_akademik == '2022/2023') ? ' selected' : '' ?>>2022/2023</option>
                <option value="2023/2024"<?= ($tahun_akademik == '2023/2024') ? ' selected' : '' ?>>2023/2024</option>
              </select>
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title"></h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
              title="Collapse">
        <i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
        <i class="fa fa-times"></i></button>
    </div>
  </div>
  <div class="box-body">
    <table class="table table-hover" style="border: 1px solid #f0f0f0; margin: 15px 0;">
      <thead>
        <tr>
          <th></th>
          <th>No</th>
          <th>NIM</th>
          <th>Nama Mahasiswa</th>
          <th>Angkatan</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($rows as $index => $row): ?>
          <tr>
            <td class="text-center">
              <?php if($row['status_pkl'] == 'layak'): ?>
                <input type="checkbox" name="status_pkl[]" data-id="<?= $row['id_mahasiswa'] ?>" checked>
              <?php else: ?>
                <input type="checkbox" name="status_pkl[]" data-id="<?= $row['id_mahasiswa'] ?>">
              <?php endif; ?>
            </td>
            <td><?= ++$index ?></td>
            <td><?= $row['nim'] ?></td>
            <td><?= $row['nama'] ?></td>
            <td><?= $row['angkatan'] ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <form action="<?= base_url('pkl/kelompok/update-anggota/'.$kelompok) ?>" method="POST" id="form">
      <?php foreach($rows as $index => $row): ?>
      <input type="text" style="display: none;" value="<?= $row['id_mahasiswa'] ?>|<?= $row['status_pkl'] ?>" data-id="<?= $row['id_mahasiswa'] ?>" name="status_pkl[]">
      <?php endforeach; ?>
      <button class="btn btn-primary">Simpan Perubahan</button>
    </form>
  </div>
</div>
<!-- /.box -->

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
  $('[name="status_pkl[]"]').change(function() {
    const aktif = $(this).is(':checked') ? 'layak' : 'belum_layak'
    // console.log(checked)
    const id = $(this).attr('data-id')
    console.log(id)
    $(`#form input[data-id="${id}"]`).attr('value', `${id}|${aktif}`)
  });
</script>
<?= $this->endSection(); ?>
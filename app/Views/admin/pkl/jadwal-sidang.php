<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>

<!-- Default box -->
<?php if (session()->getFlashData('success') !== null) : ?>
  <div class="alert alert-success"><?= session()->getFlashData('success') ?></div>
<?php endif; ?>
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Jadwal Sidang</h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
        <i class="fa fa-minus"></i></button>
    </div>
  </div>
  <div class="box-body">
    <div class="table-responsive">
      <table class="table table-hover datatable " style="border: 1px solid #f0f0f0; margin-top: 10px;">
        <thead class="bg-primary">
          <tr>
            <th>No</th>
            <th>NIM</th>
            <th>Nama Mahasiswa</th>
            <th>Dosen Penguji</th>
            <th>Dosen Pembimbing</th>
            <th>Tempat</th>
            <th>Tanggal</th>
            <th>Jam</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($data as $i => $row) : ?>
            <tr>
              <td><?= ++$i ?></td>
              <td><?= $row['nim'] ?></td>
              <td><?= $row['nama_mahasiswa'] ?></td>
              <td><span class="label label-primary"><?= $row['dospeng'] ?></span></td>
              <td><span class="label label-danger"><?= $row['dospem'] ?></span></td>
              <td><span class="label label-success"><?= $row['tempat_nama'] ?></span></td>
              <td><span class="label label-success"><?= $row['tanggal'] ?></span></td>
              <td><span class="label label-success"><?= $row['jam'] ?></span></td>
              <td>
                <span class="label <?= $row['total_nilai'] === null ? 'label-warning' : ($row['status_ujian'] ? 'label-primary' : 'label-danger') ?>">
                  <?= $row['total_nilai'] === null ? 'Belum Melaksanakan' : ($row['status_ujian'] ? 'Lulus' : 'Tidak Lulus') ?>
                </span>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

    </div>
  </div>
</div>


<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Menunggu Persetujuan</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
        <i class="fa fa-minus"></i></button>
    </div>
  </div>
  <div class="box-body">
    <table class="table table-hover datatable" style="border: 1px solid #f0f0f0; margin-top: 10px;">
      <thead class="bg-primary">
        <tr>
          <th>No</th>
          <th>Nama mahasiswa</th>
          <th>Kwitansi Pembayaran PKL</th>
          <th>KRS PKL</th>
          <th>Laporan PKL</th>
          <th>SK Pelaksanaan PKL Instansi</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($pending as $i => $row) : ?>
          <tr>
            <td><?= ++$i ?></td>
            <td><?= $row['nama'] ?></td>
            <td>
              <?php if ($row['kwitansi']) : ?>
                <a target="_blank" href="<?= base_url('uploads/pkl/' . $row['kwitansi']) ?>" class="btn btn-primary"><i class="fa fa-file"></i></a>
              <?php else : ?>
                -
              <?php endif; ?>
            </td>
            <td>
              <?php if ($row['krs']) : ?>
                <a target="_blank" href="<?= base_url('uploads/pkl/' . $row['krs']) ?>" class="btn btn-primary"><i class="fa fa-file"></i></a>
              <?php else : ?>
                -
              <?php endif; ?>
            </td>
            <td>
              <?php if ($row['laporan']) : ?>
                <a target="_blank" href="<?= base_url('uploads/pkl/' . $row['laporan']) ?>" class="btn btn-primary"><i class="fa fa-file"></i></a>
              <?php else : ?>
                -
              <?php endif; ?>
            </td>
            <td>
              <?php if ($row['sk_pkl']) : ?>
                <a target="_blank" href="<?= base_url('uploads/pkl/' . $row['sk_pkl']) ?>" class="btn btn-primary"><i class="fa fa-file"></i></a>
              <?php else : ?>
                -
              <?php endif; ?>
            </td>
            <td><span class="label label-primary"><?= $row['status_ujian'] ?? '' ?></span></td>
            <td class="text-center">
              <button class="btn btn-success approve btn-sm" data-id="<?= $row['id_pkl_ujian'] ?>" data-mahasiswa-id="<?= $row['mahasiswa_id'] ?>" data-mahasiswa-nama="<?= $row['nama'] ?>" data-nama-kelompok="<?= $row['nama_kelompok'] ?>" data-nama-dospem="<?= $row['dospem_nama'] ?>"><i class="fa fa-check"></i></button>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
<!-- /.box -->

<div class="modal fade" id="modal-approve">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tambahkan Jadwal</h4>
      </div>
      <div class="modal-body">
        <form method="POST" action="<?= route_to('admin.pkl.jadwal.simpan') ?>">
          <input type="hidden" name="id_daftar">
          <input type="hidden" name="mahasiswa_id">

          <div class="row mb-2">
            <div class="col-md-12">
              <div class="form-group">
                <label for="">Mahasiswa</label>
                <input type="hidden" readonly class="form-control" name="mahasiswa_id">
                <input type="text" readonly class="form-control" name="mahasiswa_nama">
              </div>
            </div>
          </div>

          <div class="row mb-2">
            <div class="col-md-12">
              <div class="form-group">
                <label for="">Nama Kelompok PKL</label>
                <input type="text" readonly class="form-control" name="nama_kelompok">
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-12">
              <div class="form-group">
                <label for="">Dosen Pembimbing</label>
                <input type="text" readonly class="form-control" name="nama_dospem">
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-12">
              <div class="form-group">
                <label for="">Tanggal</label>
                <input type="date" required class="form-control" name="tanggal">
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-12">
              <div class="form-group">
                <label>Jam</label>
                <input type="time" required class="form-control" name="jam">
              </div>
            </div>
          </div>

          <div class="row mb-2">
            <div class="col-md-12">
              <div class="form-group">
                <label for="">Dosen Penguji</label>
                <select class="form-control" name="dospeng_id">
                  <option value="">Pilih Dosen</option>
                  <?php foreach ($dosens as $dosen) : ?>
                    <option value="<?= $dosen['id'] ?>"><?= $dosen['nama'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-12">
              <div class="form-group">
                <label for="">Tempat</label>
                <select class="form-control select2" name="tempat_id">
                  <option value="">Pilih Tempat</option>
                  <?php foreach ($tempats as $tempat) : ?>
                    <option value="<?= $tempat['id_tempat'] ?>"><?= $tempat['nama_tempat'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-12">
              <div class="form-group">
                <label for="">Keterangan</label>
                <textarea name="keterangan" rows="4" class="form-control"></textarea>
              </div>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan & Setujui</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
  $('.approve').click(function() {
    $('#modal-approve [name="id_daftar"]').val($(this).attr('data-id'));
    $('#modal-approve [name="mahasiswa_id"]').val($(this).attr('data-mahasiswa-id'));
    $('#modal-approve [name="mahasiswa_nama"]').val($(this).attr('data-mahasiswa-nama'));
    $('#modal-approve [name="nama_kelompok"]').val($(this).attr('data-nama-kelompok'));
    $('#modal-approve [name="nama_dospem"]').val($(this).attr('data-nama-dospem'));
    $('#modal-approve').modal('show');
  });

  $('.edit').click(function() {
    const id = $(this).attr('data-id');
    $.get('<?= base_url('pkl/kelompok/show?id=') ?>' + id, function(data) {
      $('#modal-edit [name="id"]').val(id);
      $('#modal-edit [name="prodi_id"] option').each(function() {
        if (this.text == data.nama_prodi) {
          this.setAttribute('selected', '');
        }
      });

      $('#modal-edit [name="status"] option').each(function() {
        if (this.text == data.status) {
          this.setAttribute('selected', '');
        }
      });
    })
    $('#modal-edit').modal('show');
  });

  $('.detail').click(function() {
    const id = $(this).attr('data-id');
    $.get('<?= base_url('pkl/jadwal/detail?id=') ?>' + id, function(data) {
      $('#modal-detail [name="nama"]').val(data.nama);
      $('#modal-detail [name="nim"]').val(data.nim);
      $('#modal-detail [name="judul_laporan"]').val(data.judul_laporan);

      $('#modal-detail [name="id_jurusan"] option').each(function() {
        if (this.text == data.nama_jurusan) {
          this.setAttribute('selected', '');
        }
      });
    });

    $('#modal-detail').modal('show');
  });
</script>
<?= $this->endSection(); ?>
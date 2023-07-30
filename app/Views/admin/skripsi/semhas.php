<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>

<!-- Default box -->
<?php if (session()->getFlashData('success') !== null) : ?>
  <div class="alert alert-success"><?= session()->getFlashData('success') ?></div>
<?php endif; ?>

<?php if (session()->getFlashData('error') !== null) : ?>
  <div class="alert alert-danger"><?= session()->getFlashData('error') ?></div>
<?php endif; ?>


<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Sidang Skripsi</h3>

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
            <th>Penguji 1</th>
            <th>Penguji 2</th>
            <th>Pembimbing 1</th>
            <th>Pembimbing 2</th>
            <th>Tempat</th>
            <th>Tanggal</th>
            <th>Jam</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($jadwal_semhas as $i => $row) : ?>
            <tr>
              <td><?= ++$i ?></td>
              <td><?= $row['nim'] ?></td>
              <td><?= $row['nama_mahasiswa'] ?></td>
              <td><span class="label label-primary"><?= $row['nama_penguji_1'] ?></span></td>
              <td><span class="label label-primary"><?= $row['nama_penguji_2'] ?></span></td>
              <td><span class="label label-danger"><?= $row['nama_pembimbing_1'] ?></span></td>
              <td><span class="label label-danger"><?= $row['nama_pembimbing_2'] ?></span></td>
              <td><span class="label label-success"><?= $row['tempat_nama'] ?></span></td>
              <td><span class="label label-primary"><?= $row['tanggal'] ?></span></td>
              <td><span class="label label-primary"><?= $row['jam'] ?></span></td>
              <td>

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
    <h3 class="box-title">Seminar Hasil - Menunggu Persetujuan</h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
        <i class="fa fa-minus"></i></button>
    </div>
  </div>
  <div class="box-body">
    <div class="table-responsive">
      <table class="table table-bordered table-striped datatable" style=" margin-top: 10px;">
        <thead class="bg-primary">
          <tr>
            <th>No</th>
            <th>NIM</th>
            <th>Mahasiswa</th>
            <th>Transkrip
              <br>Nilai
            </th>
            <th>KRS</th>
            <th>Sertifikat<br>
              Seminar Kompetensi
            </th>
            <th>Nota Dinas Pemb</th>
            <th>Kartu Bimb</th>
            <th>Kartu Peserta</th>
            <th>Mampram Ospek</th>
            <th>Outbound</th>
            <th>TOEFL</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($pending_semhas as $i => $row) : ?>
            <tr>
              <td><?= ++$i ?></td>
              <td><?= $row['nim'] ?></td>
              <td><?= $row['nama'] ?></td>
              <td>
                <?php if ($row['transkrip_nilai']) : ?>
                  <a target="_blank" href="<?= base_url('uploads/skripsi/' . $row['transkrip_nilai']) ?>" class="btn btn-primary btn-sm"><i class="fa fa-file"></i></a>
                <?php else : ?>
                  -
                <?php endif; ?>
              </td>
              <td>
                <?php if ($row['krs']) : ?>
                  <a target="_blank" href="<?= base_url('uploads/skripsi/' . $row['krs']) ?>" class="btn btn-primary btn-sm"><i class="fa fa-file"></i></a>
                <?php else : ?>
                  -
                <?php endif; ?>
              </td>
              <td>
                <?php if ($row['sertifikat_seminar_kompetensi']) : ?>
                  <a target="_blank" href="<?= base_url('uploads/skripsi/' . $row['sertifikat_seminar_kompetensi']) ?>" class="btn btn-primary btn-sm"><i class="fa fa-file"></i></a>
                <?php else : ?>
                  -
                <?php endif; ?>
              </td>
              <td>
                <?php if ($row['nota_dinas_pembimbing']) : ?>
                  <a target="_blank" href="<?= base_url('uploads/skripsi/' . $row['nota_dinas_pembimbing']) ?>" class="btn btn-primary btn-sm"><i class="fa fa-file"></i></a>
                <?php else : ?>
                  -
                <?php endif; ?>
              </td>
              <td>
                <?php if ($row['kartu_bimbingan_skripsi']) : ?>
                  <a target="_blank" href="<?= base_url('uploads/skripsi/' . $row['kartu_bimbingan_skripsi']) ?>" class="btn btn-primary btn-sm"><i class="fa fa-file"></i></a>
                <?php else : ?>
                  -
                <?php endif; ?>
              </td>
              <td>
                <?php if ($row['kartu_peserta_seminar_proposal']) : ?>
                  <a target="_blank" href="<?= base_url('uploads/skripsi/' . $row['kartu_peserta_seminar_proposal']) ?>" class="btn btn-primary btn-sm"><i class="fa fa-file"></i></a>
                <?php else : ?>
                  -
                <?php endif; ?>
              </td>
              <td>
                <?php if ($row['sertifikat_mampram_ospek']) : ?>
                  <a target="_blank" href="<?= base_url('uploads/skripsi/' . $row['sertifikat_mampram_ospek']) ?>" class="btn btn-primary btn-sm"><i class="fa fa-file"></i></a>
                <?php else : ?>
                  -
                <?php endif; ?>
              </td>
              <td>
                <?php if ($row['sertifikat_outbound']) : ?>
                  <a target="_blank" href="<?= base_url('uploads/skripsi/' . $row['sertifikat_outbound']) ?>" class="btn btn-primary btn-sm"><i class="fa fa-file"></i></a>
                <?php else : ?>
                  -
                <?php endif; ?>
              </td>
              <td>
                <?php if ($row['sertifikat_toefl']) : ?>
                  <a target="_blank" href="<?= base_url('uploads/skripsi/' . $row['sertifikat_toefl']) ?>" class="btn btn-primary btn-sm"><i class="fa fa-file"></i></a>
                <?php else : ?>
                  -
                <?php endif; ?>
              </td>
              <td><span class="label label-primary"><?= $row['status'] ?? '' ?></span></td>
              <td class="text-center">
             
              <button class="btn btn-success approve-semhas btn-sm" data-id="<?= $row['id'] ?>" data-mahasiswa-id="<?= $row['mahasiswa_id'] ?>" data-mahasiswa-nama="<?= $row['nama'] ?>" data-nama-pembimbing-1="<?= $row['nama_pembimbing_1'] ?>" data-nama-pembimbing-2="<?= $row['nama_pembimbing_2'] ?>"><i class="fa fa-check"></i></button> </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>



<!-- /.box -->

<div class="modal fade" id="modal-approve-semhas">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tambahkan Jadwal Seminar Hasil</h4>
      </div>
      <div class="modal-body">
        <form method="POST" action="<?= route_to('admin.skripsi.sidang.simpan_semhas') ?>">
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
                <label for="">Pembimbing 1</label>
                <input type="text" readonly class="form-control" name="nama_pembimbing_1">
              </div>
            </div>
          </div>
          
          <div class="row mb-2">
            <div class="col-md-12">
              <div class="form-group">
                <label for="">Pembimbing 2</label>
                <input type="text" readonly class="form-control" name="nama_pembimbing_2">
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-12">
              <div class="form-group">
                <label for="">Tanggal</label>
              <input type="date" class="form-control" name="tanggal" requred>
              </div>
            </div>
          </div> 
          
          <div class="row mb-2">
            <div class="col-md-12">
              <div class="form-group">
                <label for="">Jam</label>
              <input type="time" class="form-control" name="jam" required>
              </div>
            </div>
          </div> 
          <div class="row mb-2">
            <div class="col-md-12">
              <div class="form-group">
                <label for="">Dosen Penguji 1</label>
                <select class="form-control" name="penguji_1_id" required>
                  <option value="">Pilih Dosen</option>
                  <?php foreach ($dosensSemhas as $dosen) : ?>
                    <option value="<?= $dosen['id'] ?>"><?= $dosen['nama'] ?></option>
                  <?php endforeach; ?>
                </select> 
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-12">
              <div class="form-group">
                <label for="">Dosen Penguji 2</label>
                <select class="form-control" name="penguji_2_id" required>
                  <option value="">Pilih Dosen</option>
                  <?php foreach ($dosensSemhas as $dosen) : ?>
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
                <select class="form-control select2" name="tempat_id" required>
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
  $('.approve-semhas').click(function() {
    $('#modal-approve-semhas [name="id_daftar"]').val($(this).attr('data-id'));
    $('#modal-approve-semhas [name="mahasiswa_id"]').val($(this).attr('data-mahasiswa-id'));
    $('#modal-approve-semhas [name="mahasiswa_nama"]').val($(this).attr('data-mahasiswa-nama'));
    $('#modal-approve-semhas [name="nama_pembimbing_1"]').val($(this).attr('data-nama-pembimbing-1'));
    $('#modal-approve-semhas [name="nama_pembimbing_2"]').val($(this).attr('data-nama-pembimbing-2'));
    
    $('#modal-approve-semhas').modal('show');
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
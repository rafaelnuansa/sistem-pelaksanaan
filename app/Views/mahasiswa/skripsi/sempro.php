<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>

<!-- Default box -->
<?php if (session()->getFlashData('success') !== null) : ?>
  <div class="alert alert-success"><?= session()->getFlashData('success') ?></div>
<?php endif; ?>

<?php if (session()->getFlashData('error') !== null) : ?>
  <div class="alert alert-danger"><?= session()->getFlashData('error') ?></div>
<?php endif; ?>

<?php if ($skripsiId) : ?>
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Jadwal Sidang Skripsi</h3>

    </div>
    <div class="box-body">
      <?php if ($register_sempro) :; ?>
        <button class="btn btn-success daftar-sempro" style="margin-bottom:20px;">Edit/Lengkapi Persyaratan Sempro</button>
      <?php else : ?>
        <button class="btn btn-primary daftar-sempro" style="margin-bottom:20px;">Daftar Sidang Sempro</button>
      <?php endif; ?>

      <div class="table-responsive">
        <table class="table table-hover" style="border: 1px solid #f0f0f0; margin-top: 10px;">
          <thead class="bg-primary">
            <tr>
              <th>Tanggal</th>
              <th>NIM</th>
              <th>Mahasiswa</th>
              <th>Penguji 1</th>
              <th>Penguji 2</th>
              <th>Pembimbing 1</th>
              <th>Pembimbing 2</th>
              <th>Tempat</th>
              <th>Nilai</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($seminar_proposal as $row) : ?>
              <tr>
                <td><?= $row['tanggal'] ?></td>
                <td><?= $row['nim'] ?></td>
                <td><?= $row['nama_mahasiswa'] ?></td>
                <td><span class="label label-primary"><?= $row['nama_pembimbing_1'] ?></span></td>
                <td><span class="label label-primary"><?= $row['nama_pembimbing_2'] ?></span></td>
                <td><span class="label label-danger"><?= $row['nama_penguji_1'] ?></span></td>
                <td><span class="label label-danger"><?= $row['nama_penguji_2'] ?></span></td>
                <td><?= $row['tempat_nama'] ?></td>
                <td>
                  <?php if ($row['total']) :; ?>
                    <a href="<?= base_url('mahasiswa/skripsi/penilaian/cetak/' . $row['sidang_id']) ?>" class="btn btn-success btn-sm" target="_blank">
                      Cetak
                    </a>
                  <?php else : ?>
                    Belum Ada Nilai
                  <?php endif; ?>
                </td>
                <td>
                  <span class="label <?= $row['total'] === null ? 'label-warning' : ($row['total'] ? 'label-primary' : 'label-danger') ?>">
                    <?= $row['total'] === null ? 'Belum Melaksanakan' : ($row['total'] ? 'Lulus' : 'Tidak Lulus') ?>
                  </span>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>

    </div>
  </div>

  <div class="row">
    <div class="col-md-12">

      <?php if ($register_sempro) : ?>
        <?php foreach ($register_sempro as $row) : ?>
          <div class="box">
            <div class="box-header with-border">
              <?php $statusLabelClass = ($row['status'] === 'Pending') ? 'label-danger' : 'label-primary'; ?>
              <h3 class="box-title">Pengajuan Sempro <span class="label <?= $statusLabelClass ?>"><?= $row['status'] ?></span></h3>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="table-responsive">
                    <table class="table table-hover" style="border: 1px solid #f0f0f0;">

                      <thead class="bg-primary">
                        <tr>
                          <th>Persyaratan</th>
                          <th>Berkas</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Kwitansi</td>
                          <td>
                            <?php if ($row['transkrip_nilai']) : ?>
                              <a target="_blank" href="<?= base_url('uploads/skripsi/' . $row['transkrip_nilai']) ?>" class="btn btn-primary"><i class="fa fa-file"></i></a>
                            <?php else : ?>
                              -
                            <?php endif; ?>
                          </td>
                        </tr>
                        <tr>
                          <td>KRS</td>
                          <td>
                            <?php if ($row['krs']) : ?>
                              <a target="_blank" href="<?= base_url('uploads/skripsi/' . $row['krs']) ?>" class="btn btn-primary"><i class="fa fa-file"></i></a>
                            <?php else : ?>
                              -
                            <?php endif; ?>
                          </td>
                        </tr>
                        <tr>
                          <td>Sertifikat Seminar / Kompetensi</td>
                          <td>
                            <?php if ($row['sertifikat_seminar_kompetensi']) : ?>
                              <a target="_blank" href="<?= base_url('uploads/skripsi/' . $row['sertifikat_seminar_kompetensi']) ?>" class="btn btn-primary"><i class="fa fa-file"></i></a>
                            <?php else : ?>
                              -
                            <?php endif; ?>
                          </td>
                        </tr>
                        <tr>
                          <td>NOTA Dinas Pembimbing</td>
                          <td>
                            <?php if ($row['nota_dinas_pembimbing']) : ?>
                              <a target="_blank" href="<?= base_url('uploads/skripsi/' . $row['nota_dinas_pembimbing']) ?>" class="btn btn-primary"><i class="fa fa-file"></i></a>
                            <?php else : ?>
                              -
                            <?php endif; ?>
                          </td>
                        </tr>

                        <tr>
                          <td>Kartu Bimbingan Skripsi</td>
                          <td>
                            <?php if ($row['kartu_bimbingan_skripsi']) : ?>
                              <a target="_blank" href="<?= base_url('uploads/skripsi/' . $row['kartu_bimbingan_skripsi']) ?>" class="btn btn-primary"><i class="fa fa-file"></i></a>
                            <?php else : ?>
                              -
                            <?php endif; ?>
                          </td>
                        </tr>

                        <tr>
                          <td>Kartu Peserta Seminar Proposal</td>
                          <td>
                            <?php if ($row['kartu_peserta_seminar_proposal']) : ?>
                              <a target="_blank" href="<?= base_url('uploads/skripsi/' . $row['kartu_peserta_seminar_proposal']) ?>" class="btn btn-primary"><i class="fa fa-file"></i></a>
                            <?php else : ?>
                              -
                            <?php endif; ?>
                          </td>
                        </tr>

                      </tbody>
                    </table>
                  </div>
                </div>
              <?php endforeach; ?>
              </div>
            </div>
          </div>
        <?php else : ?>
          <div class="alert alert-info">Persyaratan Sempro Belum Tersedia silahkan klik daftar dan upload berkas.</div>
        <?php endif; ?>
    </div>
  </div>
<?php endif; ?>


<!-- /.box -->

<div class="modal fade" id="modal-sempro">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Pendaftaran Sempro</h4>
        <span>Jika sudah melengkapi/tidak ingin mengganti file maka kosongkan bagian filenya</span>
      </div>
      <div class="modal-body">
        <form action="<?= route_to('mahasiswa.skripsi.daftar_sempro') ?>" method="POST" enctype="multipart/form-data">

          <div class="row" style="margin-bottom: 10px;">
            <div class="col-md-7">
              <label for="">Transkrip Nilai</label>
              <br>
              <?php if ($row['transkrip_nilai']) : ?>
                <span class="label label-primary">
                  <a target="_blank" style="color:white" href="<?= base_url('uploads/skripsi/' . $row['transkrip_nilai']) ?>">
                <i class="fa fa-file"></i> Telah dilengkapi</a></span>
              <?php else : ?>
                <span class="label label-danger"> Belum dilengkapi</span>
              <?php endif; ?>
            </div>
            <div class="col-md-5"><input type="file" class="form-control" name="transkrip_nilai"></div>
          </div>
          <div class="row" style="margin-bottom: 10px;">
            <div class="col-md-7">
              <label for="">KRS</label>
              <br>
              <?php if ($row['krs']) : ?>
                <span class="label label-primary">
                  <a target="_blank" style="color:white" href="<?= base_url('uploads/skripsi/' . $row['krs']) ?>">
                <i class="fa fa-file"></i> Telah dilengkapi</a></span>
              <?php else : ?>
                <span class="label label-danger"> Belum dilengkapi</span>
              <?php endif; ?>
            </div>
            <div class="col-md-5"><input type="file" class="form-control" name="krs"></div>
          </div>
          <div class="row" style="margin-bottom: 10px;">
            <div class="col-md-7">
              <label for="">Sertifikat Seminar / Kompetensi</label>
              <br>
              <?php if ($row['sertifikat_seminar_kompetensi']) : ?>
                <span class="label label-primary">
                  <a target="_blank" style="color:white" href="<?= base_url('uploads/skripsi/' . $row['sertifikat_seminar_kompetensi']) ?>">
                <i class="fa fa-file"></i> Telah dilengkapi</a></span>
              <?php else : ?>
                <span class="label label-danger"> Belum dilengkapi</span>
              <?php endif; ?>
            </div>
            <div class="col-md-5"><input type="file" class="form-control" name="sertifikat_seminar_kompetensi"></div>
          </div>
          <div class="row" style="margin-bottom: 10px;">
            <div class="col-md-7">
              <label for="">Nota Dinas Pembimbing</label>
              <br>
              <?php if ($row['nota_dinas_pembimbing']) : ?>
                <span class="label label-primary">
                  <a target="_blank" style="color:white" href="<?= base_url('uploads/skripsi/' . $row['nota_dinas_pembimbing']) ?>">
                <i class="fa fa-file"></i> Telah dilengkapi</a></span>
              <?php else : ?>
                <span class="label label-danger"> Belum dilengkapi</span>
              <?php endif; ?>
            </div>
            <div class="col-md-5"><input type="file" class="form-control" name="nota_dinas_pembimbing"></div>
          </div>
          <div class="row" style="margin-bottom: 10px;">
            <div class="col-md-7">
              <label for="">Kartu Bimbingan Skripsi</label>
              <br>
              <?php if ($row['kartu_bimbingan_skripsi']) : ?>
                <span class="label label-primary">
                  <a target="_blank" style="color:white" href="<?= base_url('uploads/skripsi/' . $row['kartu_bimbingan_skripsi']) ?>">
                <i class="fa fa-file"></i> Telah dilengkapi</a></span>
              <?php else : ?>
                <span class="label label-danger"> Belum dilengkapi</span>
              <?php endif; ?>
            </div>
            <div class="col-md-5"><input type="file" class="form-control" name="kartu_bimbingan_skripsi"></div>
          </div>
          <div class="row" style="margin-bottom: 10px;">
            <div class="col-md-7">
              <label for="">Kartu Peserta Seminar Proposal</label>
              <br>
              <?php if ($row['kartu_peserta_seminar_proposal']) : ?>
                <span class="label label-primary">
                  <a target="_blank" style="color:white" href="<?= base_url('uploads/skripsi/' . $row['kartu_peserta_seminar_proposal']) ?>">
                <i class="fa fa-file"></i> Telah dilengkapi</a></span>
              <?php else : ?>
                <span class="label label-danger"> Belum dilengkapi</span>
              <?php endif; ?>
            </div>
            <div class="col-md-5"><input type="file" class="form-control" name="kartu_peserta_seminar_proposal"></div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
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
  $('.daftar-sempro').click(function() {
    $('#modal-sempro').modal('show')
  });
</script>
<?= $this->endSection(); ?>
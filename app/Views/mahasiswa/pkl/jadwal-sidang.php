<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>

<!-- Default box -->
<?php if (session()->getFlashData('success') !== null) : ?>
  <div class="alert alert-success"><?= session()->getFlashData('success') ?></div>
<?php endif; ?>

<?php if (session()->getFlashData('error') !== null) : ?>
  <div class="alert alert-danger"><?= session()->getFlashData('error') ?></div>
<?php endif; ?>

<?php if ($kelompokId) : ?>
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Jadwal Sidang</h3>

    </div>
    <div class="box-body">
      <?php if ($persyaratan) :; ?>
        <div class="py-2">
          <button class="btn btn-primary daftar" style="margin-bottom:20px;">Edit/Lengkapi Persyaratan</button>
        </div>
      <?php else : ?>

        <div class="py-2">
          <button class="btn btn-primary daftar" style="margin-bottom:20px;">Daftar Ujian PKL</button>
        </div>
      <?php endif; ?>

      <table class="table table-hover datatable" style="border: 1px solid #f0f0f0; margin-top: 10px;">
        <thead class="bg-primary">
          <tr>
            <th>Tanggal</th>
            <th>NIM</th>
            <th>Nama Mahasiswa</th>
            <th>Dosen Penguji</th>
            <th>Dosen Pembimbing</th>
            <th>Tempat</th>
            <th>Nilai</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($data as $row) : ?>
            <tr>
              <td><?= $row['tanggal'] ?></td>
              <td><?= $row['nim'] ?></td>
              <td><?= $row['nama_mahasiswa'] ?></td>
              <td><span class="label label-primary"><?= $row['dospeng'] ?></span></td>
              <td><span class="label label-danger"><?= $row['dospem'] ?></span></td>
              <td><?= $row['tempat_nama'] ?></td>
              <td>
                <?php if ($row['total_nilai']) :; ?>
                  <a href="<?= base_url('mahasiswa/pkl/penilaian/cetak/' . $row['id_pkl_jadwal_sidang']) ?>" class="btn btn-success btn-sm" target="_blank">
                    Cetak
                  </a>
                <?php else : ?>
                  Belum Ada Nilai
                <?php endif; ?>
              </td>
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


  <?php if ($persyaratan) : ?>
    <?php foreach ($persyaratan as $row) : ?>
      <div class="box">
        <div class="box-header with-border">
          <?php $statusLabelClass = ($row['status'] === 'Pending') ? 'label-danger' : 'label-primary'; ?>
          <h3 class="box-title">Berkas Persyaratan <span class="label <?= $statusLabelClass ?>"><?= $row['status'] ?></span></h3>
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
                        <?php if ($row['kwitansi']) : ?>
                          <a target="_blank" href="<?= base_url('uploads/pkl/' . $row['kwitansi']) ?>" class="btn btn-primary"><i class="fa fa-file"></i></a>
                        <?php else : ?>
                          -
                        <?php endif; ?>
                      </td>
                    </tr>
                    <tr>
                      <td>KRS</td>
                      <td>
                        <?php if ($row['krs']) : ?>
                          <a target="_blank" href="<?= base_url('uploads/pkl/' . $row['krs']) ?>" class="btn btn-primary"><i class="fa fa-file"></i></a>
                        <?php else : ?>
                          -
                        <?php endif; ?>
                      </td>
                    </tr>
                    <tr>
                      <td>Laporan</td>
                      <td>
                        <?php if ($row['laporan']) : ?>
                          <a target="_blank" href="<?= base_url('uploads/pkl/' . $row['laporan']) ?>" class="btn btn-primary"><i class="fa fa-file"></i></a>
                        <?php else : ?>
                          -
                        <?php endif; ?>
                      </td>
                    </tr>
                    <tr>
                      <td>SK PKL</td>
                      <td>
                        <?php if ($row['sk_pkl']) : ?>
                          <a target="_blank" href="<?= base_url('uploads/pkl/' . $row['sk_pkl']) ?>" class="btn btn-primary"><i class="fa fa-file"></i></a>
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
      <div class="alert alert-info">Belum Tersedia silahkan klik daftar dan upload berkas.</div>
    <?php endif; ?>
  <?php else : ?>

    <div class="alert alert-danger">Pendaftaran sidang belum tersedia.</div>

  <?php endif; ?>



  <!-- /.box -->

  <div class="modal fade" id="modal-tambah">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Pendaftaran Ujian PKL</h4>
        </div>
        <div class="modal-body">
          <form action="<?= route_to('mahasiswa.pkl.jadwal.daftar') ?>" method="POST" enctype="multipart/form-data">
            <div class="row" style="margin-bottom: 10px;">
              <div class="col-md-7">
                <label for="">Kwitansi</label><br>
                <?php if ($row['kwitansi']) : ?>
                  <span class="label label-primary">
                    <a target="_blank" style="color:white" href="<?= base_url('uploads/pkl/' . $row['kwitansi']) ?>">
                      <i class="fa fa-file"></i> Telah dilengkapi</a></span>
                <?php else : ?>
                  <span class="label label-danger"> Belum dilengkapi</span>
                <?php endif; ?>
              </div>
              <div class="col-md-5"><input type="file" class="form-control" name="kwitansi"></div>
            </div>
            <div class="row" style="margin-bottom: 10px;">
              <div class="col-md-7">
                <label for="">KRS</label><br>
                <?php if ($row['krs']) : ?>
                  <span class="label label-primary">
                    <a target="_blank" style="color:white" href="<?= base_url('uploads/pkl/' . $row['krs']) ?>">
                      <i class="fa fa-file"></i> Telah dilengkapi</a></span>
                <?php else : ?>
                  <span class="label label-danger"> Belum dilengkapi</span>
                <?php endif; ?>
              </div>
              <div class="col-md-5"><input type="file" class="form-control" name="krs"></div>
            </div>
            <div class="row" style="margin-bottom: 10px;">
              <div class="col-md-7">
                <label for="">Laporan</label><br>
                <?php if ($row['laporan']) : ?>
                  <span class="label label-primary">
                    <a target="_blank" style="color:white" href="<?= base_url('uploads/pkl/' . $row['laporan']) ?>">
                      <i class="fa fa-file"></i> Telah dilengkapi</a></span>
                <?php else : ?>
                  <span class="label label-danger"> Belum dilengkapi</span>
                <?php endif; ?>
              </div>
              <div class="col-md-5"><input type="file" class="form-control" name="laporan"></div>
            </div>
            <div class="row" style="margin-bottom: 10px;">
              <div class="col-md-7">
                <label for="">SK PKL</label><br>
                <?php if ($row['sk_pkl']) : ?>
                  <span class="label label-primary">
                    <a target="_blank" style="color:white" href="<?= base_url('uploads/pkl/' . $row['sk_pkl']) ?>">
                      <i class="fa fa-file"></i> Telah dilengkapi</a></span>
                <?php else : ?>
                  <span class="label label-danger"> Belum dilengkapi</span>
                <?php endif; ?>
              </div>
              <div class="col-md-5"><input type="file" class="form-control" name="sk_pkl"></div>
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
    $('.daftar').click(function() {
      $('#modal-tambah').modal('show')
    });
  </script>
  <?= $this->endSection(); ?>
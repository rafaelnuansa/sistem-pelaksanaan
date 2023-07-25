<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MENU</li>
      <li class="treeview <?= (strpos(uri_string(), 'mahasiswa/pkl') !== false) ? 'active' : '' ?>">
        <a href="#">
          <i class="fa fa-book"></i>
          <span>PKL</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="<?= (uri_string() == 'mahasiswa/pkl') ? 'active' : '' ?>">
            <a href="<?= base_url('mahasiswa/pkl') ?>">
              <i class="fa fa-briefcase"></i> <span>Praktik Kerja Lapangan</span>
            </a>
          </li>
          <li class="<?= (uri_string() == 'mahasiswa/pkl/jurnal/pelaksanaan') ? 'active' : '' ?>">
            <a href="<?= base_url('mahasiswa/pkl/jurnal/pelaksanaan') ?>">
              <i class="fa fa-briefcase"></i> <span>Jurnal Pelaksanaan</span>
            </a>
          </li>
          <li class="<?= (uri_string() == 'mahasiswa/pkl/jurnal/bimbingan') ? 'active' : '' ?>">
            <a href="<?= base_url('mahasiswa/pkl/jurnal/bimbingan') ?>">
              <i class="fa fa-briefcase"></i> <span>Jurnal Bimbingan</span>
            </a>
          </li>
          <li class="<?= (uri_string() == 'mahasiswa/pkl/jadwal') ? 'active' : '' ?>">
            <a href="<?= base_url('mahasiswa/pkl/jadwal') ?>">
              <i class="fa fa-calendar"></i> <span>Persyaratan Sidang</span>
            </a>
          </li>
        </ul>
      </li>

      <li class="treeview <?= (strpos(uri_string(), 'mahasiswa/kkn') !== false) ? 'active' : '' ?>">
        <a href="#">
          <i class="fa fa-book"></i>
          <span>KKN</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          
        <li class="<?= (uri_string() == 'mahasiswa/kkn') ? 'active' : '' ?>">
            <a href="<?= base_url('mahasiswa/kkn') ?>">
              <i class="fa fa-briefcase"></i> <span>Kelompok KKN</span>
            </a>
          </li>
        <li class="<?= (uri_string() == 'mahasiswa/kkn/jurnal/pelaksanaan') ? 'active' : '' ?>">
            <a href="<?= base_url('mahasiswa/kkn/jurnal/pelaksanaan') ?>">
              <i class="fa fa-briefcase"></i> <span>Jurnal Pelaksanaan</span>
            </a>
          </li>
          <li class="<?= (uri_string() == 'mahasiswa/kkn/jurnal/monitoring') ? 'active' : '' ?>">
            <a href="<?= base_url('mahasiswa/kkn/jurnal/monitoring') ?>">
              <i class="fa fa-briefcase"></i> <span>Jurnal Monitoring</span>
            </a>
          </li>
          <li class="<?= (uri_string() == 'mahasiswa/kkn/surat_izin_observasi') ? 'active' : '' ?>">
            <a href="<?= base_url('mahasiswa/kkn/surat_izin_observasi') ?>">
              <i class="fa fa-envelope"></i> <span>Surat Izin Observasi</span>
            </a>
          </li>
        </ul>
      </li>

      <li class="treeview <?= (strpos(uri_string(), 'mahasiswa/skripsi') !== false) ? 'active' : '' ?>">
        <a href="#">
          <i class="fa fa-book"></i>
          <span>Skripsi</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="<?= (uri_string() == 'pemasukan') ? 'active' : '' ?>">
            <a href="<?= base_url('pemasukan') ?>">
              <i class="fa fa-briefcase"></i> <span>Jurnal Bimbingan</span>
            </a>
          </li>
          
          <li class="<?= (uri_string() == 'laporan') ? 'active' : '' ?>">
            <a href="<?= base_url('laporan') ?>">
              <i class="fa fa-calendar"></i> <span>Jadwal Sidang</span>
            </a>
          </li>
        </ul>
      </li>

      <li class="<?= (uri_string() == 'mahasiswa/berkas') ? 'active' : '' ?>">
        <a href="<?= base_url('mahasiswa/berkas') ?>">
          <i class="fa fa-briefcase"></i> <span>Upload Berkas</span>
        </a>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
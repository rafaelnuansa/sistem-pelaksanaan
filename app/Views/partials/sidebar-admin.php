<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MENU</li>
      <li class="<?= (uri_string() == 'admin/dashboard') ? 'active' : '' ?>">
        <a href="<?= base_url('admin/dashboard') ?>">
          <i class="fa fa-home"></i> <span>Dashboard</span>
        </a>
      </li>

      <li class="treeview <?= (strpos(uri_string(), 'admin/mahasiswa') === 0
                            || strpos(uri_string(), 'admin/dosen') === 0
                            || strpos(uri_string(), 'admin/dosen_pembimbing') === 0
                            || strpos(uri_string(), 'admin/users') === 0
                            || strpos(uri_string(), 'admin/fakultas') === 0
                            || strpos(uri_string(), 'admin/instansi') === 0
                            || strpos(uri_string(), 'admin/tempat') === 0
                            || strpos(uri_string(), 'admin/prodi') === 0) ? 'active' : '' ?>">
        <a href="#">
          <i class="fa fa-book"></i>
          <span>Data Master</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="<?= (uri_string() == 'admin/fakultas') ? 'active' : '' ?>">
            <a href="<?= base_url('admin/fakultas') ?>">
              <i class="fa fa-building-o"></i> <span>Fakultas</span>
            </a>
          </li>
          <li class="<?= (uri_string() == 'admin/prodi') ? 'active' : '' ?>">
            <a href="<?= base_url('admin/prodi') ?>">
              <i class="fa fa-building-o"></i> <span>Prodi</span>
            </a>
          </li>

          <li class="<?= (uri_string() == 'admin/mahasiswa') ? 'active' : '' ?>">
            <a href="<?= base_url('admin/mahasiswa') ?>">
              <i class="fa fa-users"></i> <span>Mahasiswa</span>
            </a>
          </li>

          <li class="<?= (uri_string() == 'admin/dosen') ? 'active' : '' ?>">
            <a href="<?= base_url('admin/dosen') ?>">
              <i class="fa fa-users"></i> <span>Dosen</span>
            </a>
          </li>

          <li class="<?= (uri_string() == 'admin/dosen_pembimbing') ? 'active' : '' ?>">
            <a href="<?= base_url('admin/dosen_pembimbing') ?>">
              <i class="fa fa-users"></i> <span>Dosen Pembimbing</span>
            </a>
          </li>

          <li class="<?= (uri_string() == 'admin/instansi') ? 'active' : '' ?>">
            <a href="<?= base_url('admin/instansi') ?>">
              <i class="fa fa-building-o"></i> <span>Instansi</span>
            </a>
          </li>

          <li class="<?= (uri_string() == 'admin/tempat') ? 'active' : '' ?>">
            <a href="<?= base_url('admin/tempat') ?>">
              <i class="fa fa-building-o"></i> <span>Tempat Sidang</span>
            </a>
          </li>
        </ul>
      </li>

      <li class="treeview <?= (strpos(uri_string(), 'admin/pkl') !== false) ? 'active' : '' ?>">
        <a href="#">
          <i class="fa fa-book"></i>
          <span>PKL</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="<?= (uri_string() == 'admin/pkl') ? 'active' : '' ?>">
            <a href="<?= base_url('admin/pkl') ?>">
              <i class="fa fa-briefcase"></i> <span>Kelompok PKL</span>
            </a>
          </li>
          <li class="<?= (uri_string() == 'admin/pkl/jurnal/pelaksanaan') ? 'active' : '' ?>">
            <a href="<?= base_url('admin/pkl/jurnal/pelaksanaan') ?>">
              <i class="fa fa-briefcase"></i> <span>Jurnal Pelaksanaan</span>
            </a>
          </li>
          <li class="<?= (uri_string() == 'admin/pkl/jurnal/bimbingan') ? 'active' : '' ?>">
            <a href="<?= base_url('admin/pkl/jurnal/bimbingan') ?>">
              <i class="fa fa-briefcase"></i> <span>Jurnal Bimbingan</span>
            </a>
          </li>
          <li class="<?= (uri_string() == 'admin/pkl/jadwal') ? 'active' : '' ?>">
            <a href="<?= base_url('admin/pkl/jadwal') ?>">
              <i class="fa fa-calendar"></i> <span>Jadwal Sidang</span>
            </a>
          </li>

          <li class="<?= (uri_string() == 'admin/pkl/berkas') ? 'active' : '' ?>">
            <a href="<?= base_url('admin/pkl/berkas') ?>">
              <i class="fa fa-file"></i> <span>Berkas</span>
            </a>
          </li>


          <li class="<?= (uri_string() == 'admin/pkl/laporan') ? 'active' : '' ?>">
            <a href="<?= base_url('admin/pkl/laporan') ?>">
              <i class="fa fa-file-pdf-o"></i> <span>Laporan PKL</span>
            </a>
          </li>
        </ul>
      </li>


      <li class="treeview <?= (strpos(uri_string(), 'admin/kkn') !== false) ? 'active' : '' ?>">
        <a href="#">
          <i class="fa fa-book"></i>
          <span>KKN</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="<?= (uri_string() == 'admin/kkn') ? 'active' : '' ?>">
            <a href="<?= base_url('admin/kkn') ?>">
              <i class="fa fa-briefcase"></i> <span>Kelompok KKN</span>
            </a>
          </li>
          <li class="<?= (uri_string() == 'admin/kkn/jurnal/pelaksanaan') ? 'active' : '' ?>">
            <a href="<?= base_url('admin/kkn/jurnal/pelaksanaan') ?>">
              <i class="fa fa-briefcase"></i> <span>Jurnal Pelaksanaan</span>
            </a>
          </li>
          <li class="<?= (uri_string() == 'admin/kkn/jurnal/monitoring') ? 'active' : '' ?>">
            <a href="<?= base_url('admin/kkn/jurnal/monitoring') ?>">
              <i class="fa fa-briefcase"></i> <span>Jurnal Monitoring</span>
            </a>
          </li>
          <li class="<?= (uri_string() == 'admin/kkn/laporan') ? 'active' : '' ?>">
            <a href="<?= base_url('admin/kkn/laporan') ?>">
              <i class="fa fa-file-pdf-o"></i> <span>Laporan KKN</span>
            </a>
          </li>
        </ul>
      </li>

      <li class="treeview <?= (strpos(uri_string(), 'admin/skripsi') !== false) ? 'active' : '' ?>">
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
          <li class="<?= (uri_string() == 'laporan') ? 'active' : '' ?>">
            <a href="<?= base_url('laporan') ?>">
              <i class="fa fa-briefcase"></i> <span>Menentukan Dosbing</span>
            </a>
          </li>
        </ul>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
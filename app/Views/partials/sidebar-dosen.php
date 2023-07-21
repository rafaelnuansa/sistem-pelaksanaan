<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MENU</li>
      <li class="treeview <?= (strpos(uri_string(), 'dosen/pkl') !== false) ? 'active' : '' ?>">
        <a href="#">
          <i class="fa fa-book"></i>
          <span>PKL</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="<?= (uri_string() == 'dosen/pkl') ? 'active' : '' ?>">
            <a href="<?= base_url('dosen/pkl') ?>">
              <i class="fa fa-briefcase"></i> <span>Validasi Bimbingan</span>
            </a>
          </li>
          <li class="<?= (uri_string() == 'dosen/pkl/jadwal') ? 'active' : '' ?>">
            <a href="<?= base_url('dosen/pkl/jadwal') ?>">
              <i class="fa fa-calendar"></i> <span>Jadwal Pengujian</span>
            </a>
          </li>
        </ul>
      </li>

        <li class="treeview <?= (strpos(uri_string(), 'dosen/kkn') !== false) ? 'active' : '' ?>">
          <a href="#">
            <i class="fa fa-book"></i>
            <span>KKN</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?= (uri_string() == 'pengeluaran') ? 'active' : '' ?>">
              <a href="<?= base_url('pengeluaran') ?>">
                <i class="fa fa-briefcase"></i> <span>Jurnal Pelaksanaan</span>
              </a>
            </li>
            <li class="<?= (uri_string() == 'laporan') ? 'active' : '' ?>">
              <a href="<?= base_url('laporan') ?>">
                <i class="fa fa-briefcase"></i> <span>Surat izin observasi</span>
              </a>
            </li>
            <li class="<?= (uri_string() == 'laporan') ? 'active' : '' ?>">
              <a href="<?= base_url('laporan') ?>">
                <i class="fa fa-briefcase"></i> <span>Jurnal Bimbingan</span>
              </a>
            </li>
          </ul>
        </li>

        <li class="treeview <?= (strpos(uri_string(), 'dosen/skripsi') !== false) ? 'active' : '' ?>">
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
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
<header class="main-header">
  <!-- Logo -->
  <a href="" class="logo">
    <img src="/assets/img/logo.png" width="140" alt="">
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </a>

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="<?= base_url('assets/img/user2-160x160.jpg') ?>" class="user-image" alt="User Image">
            <span class="hidden-xs"><?= session()->get('nama'); ?></span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <img src="<?= base_url('assets/img/user2-160x160.jpg') ?>" class="img-circle" alt="User Image">

              <p>
                <?= session()->get('nama'); ?>
                <small><?= session()->get('level'); ?></small>
              </p>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-right">
                <a href="<?= base_url('/logout') ?>" class="btn btn-default btn-flat">Keluar</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>
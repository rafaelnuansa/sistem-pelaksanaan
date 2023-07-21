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
        <style>
          /* Avatar Inisial */
          .user-initials,
          .user-initials-large {
            background-color: #3f454b;
            color: #fff;
            font-size: 10px;
            width: 20px;
            height: 20px;
            text-align: center;
            line-height: 20px;
            border-radius: 50%;
          }

          .user-initials-large {
            font-size: 20px;
            width: 40px;
            height: 40px;
            text-align: center;
            line-height: 40px;
          }

          /* Tata Letak Avatar dan Nama */
          .user-menu {
            display: flex;
            align-items: center;
          }

          .user-info {
            margin-left: 10px;
          }
          .navbar-nav>.user-menu>.dropdown-menu>li.user-header {
            height: auto!important;
            display: flex;
            justify-content: center;
          }
          .navbar-nav>.user-menu>.dropdown-menu>li.user-header>p {
            margin-top:0;
            margin-left: 10px;
          }
          .user-info p {
            margin: 0;
          }

          .user-info small {
            font-size: 12px;
            color: #737373;
          }
        </style>

        <li class="dropdown user user-menu">
          <?php
          $nama = session()->get('nama');
          $nama_array = explode(' ', $nama);
          $nama_initials = '';
          foreach ($nama_array as $nama_part) {
            $nama_initials .= $nama_part[0];
          }
          $nama_initials = strtoupper($nama_initials);
          ?>
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <div class="user-menu">
              <div class="user-initials">
                <?= $nama_initials; ?>
              </div>
              <div class="user-info">
                <p><?= $nama; ?></p>
              </div>
            </div>
          </a>
          <ul class="dropdown-menu">
            <!-- User initials -->
            <li class="user-header">
              <div class="user-initials-large">
                <?= $nama_initials; ?>
              </div>

              <p>
                <?= $nama; ?>
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
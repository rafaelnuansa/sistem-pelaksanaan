<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?= base_url('assets/bootstrap/dist/css/bootstrap.min.css') ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/font-awesome/css/font-awesome.min.css') ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?= base_url('assets/Ionicons/css/ionicons.min.css') ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/css/AdminLTE.min.css') ?>">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?= base_url('assets/iCheck/square/blue.css') ?>">

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo text-center">
        <img src="<?= base_url('assets/img/logo.png') ?>" width="200" alt="Logo" class="logo-img"><br>

            <a href="#" class="h3"><b>Aplikasi Pelaksanaan PKL, KKN dan Skripsi</b></a>
        </div>
        <!-- /.login-logo -->
        <?php if (session()->getFlashData('error') !== null) : ?>
            <div class="alert alert-danger"><?= session()->getFlashData('error') ?></div>
        <?php endif; ?>

        <div class="login-box-body">
            <div style="padding-bottom: 20px; text-align: center;">
                Silahkan login terlebih dahulu
            </div>
        
            <form action="<?= base_url('auth/login') ?>" method="post">
                <div class="form-group">
                    <input type="text" class="form-control" name="username" placeholder="Username/NIM/NIDN" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </div>
            </form>
        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery 3 -->
    <script src="<?= base_url('assets/jquery/dist/jquery.min.js') ?>"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="<?= base_url('assets/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
    <!-- iCheck -->
    <script src="<?= base_url('assets/iCheck/icheck.min.js') ?>"></script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pendaftaran Panitia E-Voting</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/')?>plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url('assets/')?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/')?>dist/css/adminlte.min.css">
</head>

<body class="hold-transition register-page">
    <div class="register-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="<?= base_url('auth/registration')?>" class="h1"><b>E-Voting</b></a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Pendaftaran Panitia</p>
                <?php
                    if($this->session->flashdata('message')){
                        echo $this->session->flashdata('message');
                        unset($_SESSION['message']);
                    }
                    unset($_SESSION['message']);
                ?>
                <form action="<?= base_url('auth/registration')?>" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Nama lengkap" name="name" value="<?= set_value('name')?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <small class="text-danger">
                        <?= form_error('name')?>
                    </small>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="email" value="<?= set_value('email')?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <small class="text-danger">
                        <?= form_error('email')?>
                    </small>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Username" name="username" value="<?= set_value('username')?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-signature"></span>
                            </div>
                        </div>
                    </div>
                    <small class="text-danger">
                        <?= form_error('username')?>
                    </small>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password" value="<?= set_value('password')?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <small class="text-danger">
                        <?= form_error('password')?>
                    </small>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Ulangi password" name="confpassword" value="<?= set_value('confpassword')?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <small class="text-danger">
                        <?= form_error('confpassword')?>
                    </small>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <a href="<?= base_url('auth/login')?>" class="text-center">Sudah punya akun</a>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.register-box -->

    <!-- jQuery -->
    <script src="<?= base_url('assets/')?>plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('assets/')?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('assets/')?>dist/js/adminlte.min.js"></script>
</body>

</html>
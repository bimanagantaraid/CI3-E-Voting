<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/fontawesome-free/css/all.min.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/toastr/toastr.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>dist/css/adminlte.min.css">
    <!-- Custom style -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>dist/css/custom.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/summernote/summernote-bs4.min.css">

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="<?= base_url('auth/logout') ?>" class="btn btn-sm btn-danger">LOGOUT</a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link text-center d-flex align-items-center" style="padding-left:16px">
                <div class="brand-icon" style="font-size: 1.6em; color: white;">
                    <i class="fas fa-vote-yea"></i>
                </div>
                <div class="brand-text font-weight-light mx-2">E-VOTING</div>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?= base_url('assets/image/users/') . $user['image'] ?>" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?= $user['name'] ?></a>
                        <?php
                        if ($user['role_id'] == 1) :
                        ?>
                            <span class="btn btn-xs btn-success">Administrator</span>
                        <?php
                        else :
                        ?>
                            <span class="btn btn-xs btn-primary">Panitia</span>
                        <?php
                        endif;
                        ?>
                    </div>
                </div>

                <!-- query menu -->
                <?php
                $role_id = $this->session->userdata('role_id');
                $sql = "SELECT `nav_menu`.`nav_menu_id`, `acces_menu_id`, `nama`
                                FROM `nav_menu` 
                                JOIN `user_acces_menu` 
                                    ON `nav_menu`.`nav_menu_id` = `user_acces_menu`.`nav_menu_id`
                                WHERE `user_acces_menu`.`role_id` = $role_id
                                ORDER BY `nav_menu`.`menu_urutan` ASC
                            ";
                $menu = $this->db->query($sql)->result_array();
                ?>

                <!-- Sidebar Menu -->
                <nav class="mt-2 mb-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <?php foreach ($menu as $m) : ?>
                            <li class="nav-header"><?= $m['nama'] ?></li>

                            <!-- query sub menu -->
                            <?php
                            $nav_menu_id = $m["nav_menu_id"];
                            $sql = "SELECT `nav_sub_menu`.`name`,`nav_sub_menu`.`url`,`nav_sub_menu`.`icon`, `nav_sub_menu`.`is_active`
                                FROM `nav_sub_menu` 
                                JOIN `nav_menu` 
                                    ON `nav_sub_menu`.`nav_menu_id` = `nav_menu`.`nav_menu_id`
                                WHERE `nav_sub_menu`.`nav_menu_id` = $nav_menu_id
                                AND `nav_sub_menu`.`is_active` = 1
                                ORDER BY `nav_sub_menu`.`sub_menu_urutan` ASC;
                            ";
                            $sub_menu = $this->db->query($sql)->result_array();
                            foreach ($sub_menu as $sm) :
                            ?>
                                <li class="nav-item">
                                    <?php if ($sm['name'] === $title) : ?>
                                        <a href="<?= base_url() . $sm['url'] ?>" class="nav-link active">
                                        <?php else : ?>
                                            <a href="<?= base_url() . $sm['url'] ?>" class="nav-link">
                                            <?php endif; ?>
                                            <i class="nav-icon <?= $sm['icon'] ?>"></i>
                                            <p>
                                                <?= $sm['name'] ?>
                                            </p>
                                            </a>
                                </li>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        <!-- jQuery -->
        <script src="<?= base_url('assets/') ?>plugins/jquery/jquery.min.js"></script>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <?php echo $contents ?>
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.1.0
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery UI 1.11.4 -->
    <script src="<?= base_url('assets/') ?>plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('assets/') ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="<?= base_url('assets/') ?>plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('assets/') ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url('assets/') ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url('assets/') ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="<?= base_url('assets/') ?>plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?= base_url('assets/') ?>plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="<?= base_url('assets/') ?>plugins/jszip/jszip.min.js"></script>
    <script src="<?= base_url('assets/') ?>plugins/pdfmake/pdfmake.min.js"></script>
    <script src="<?= base_url('assets/') ?>plugins/pdfmake/vfs_fonts.js"></script>
    <script src="<?= base_url('assets/') ?>plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="<?= base_url('assets/') ?>plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="<?= base_url('assets/') ?>plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- chart -->
    <script src="<?= base_url() ?>assets/plugins/chart.js/Chart.min.js"></script>
    <!-- bs-custom-file-input -->
    <script src="<?= base_url('assets/') ?>plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="<?= base_url('assets/') ?>plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Toastr -->
    <script src="<?= base_url('assets/') ?>plugins/toastr/toastr.min.js"></script>
    <!-- Select2 -->
    <script src="<?= base_url('assets/') ?>plugins/select2/js/select2.full.min.js"></script>
    <!-- daterangepicker -->
    <script src="<?= base_url('assets/') ?>plugins/moment/moment.min.js"></script>
    <script src="<?= base_url('assets/') ?>plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="<?= base_url('assets/') ?>plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Bootstrap Switch -->
    <script src="<?= base_url('assets/') ?>plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <!-- Summernote -->
    <script src="<?= base_url('assets/') ?>plugins/summernote/summernote-bs4.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('assets/') ?>dist/js/adminlte.js"></script>
</body>

</html>
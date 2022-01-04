<!DOCTYPE html>
<html lang="en">
<?php $url = current_url(true); ?>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Bengkelin | <?= $url->getSegment(3) ?></title>

    <!-- Bootstrap -->
    <link href="<?= base_url() ?>/public/vendor/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?= base_url() ?>/public/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <link href="<?= base_url() ?>/public/vendor/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?= base_url() ?>/public/css/custom.min.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="<?= base_url() ?>/public/vendor/jquery/dist/jquery.min.js"></script>
</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col menu_fixed">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="<?php echo base_url(); ?>/" class="site_title"><i class="fa fa-car"></i> <span>Bengkelin!</span></a>
                    </div>

                    <div class="clearfix"></div>

                    <!-- menu profile quick info -->
                    <div class="profile clearfix">
                        <div class="profile_pic">
                            <img src="<?= base_url() ?>/public/images/img.jpg" alt="..." class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>Hallo <?php if (session()->get('rule') == 1) {
                                            echo "admin";
                                        } else {
                                            echo "karyawan";
                                        } ?>,</span>
                            <h2><?= session()->get('nama'); ?></h2>
                        </div>
                    </div>
                    <!-- /menu profile quick info -->

                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <ul class="nav side-menu">
                                <li><a href="<?php echo base_url(); ?>/antrian"><i class="fa fa-list-ol"></i> Antrian</a>
                                </li>
                                <li><a href="<?php echo base_url(); ?>/laporan"><i class="fa fa-calendar"></i> Laporan</a>
                                </li>
                            </ul>
                        </div>
                        <div class="menu_section">
                            <h3>Data</h3>
                            <ul class="nav side-menu">
                                <li><a href="<?php echo base_url(); ?>/jasa"><i class="fa fa-wrench"></i> Jasa</a></li>
                                <?php if (session()->get("rule") == 1) : ?>
                                    <li><a href="<?php echo base_url(); ?>/user"><i class="fa fa-user"></i> User</a></li>
                                <?php endif; ?>
                            </ul>
                        </div>

                    </div>
                    <!-- /sidebar menu -->
                </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">
                <div class="nav_menu">
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>
                    <nav class="nav navbar-nav">
                        <ul class=" navbar-right">
                            <li class="nav-item" style="padding-left: 15px;">
                                <a href="<?= base_url() ?>/login/logout" class=" user-profile" aria-haspopup="true" id="navbarDropdown" aria-expanded="false">
                                    <img src="<?= base_url() ?>/public/images/img.jpg" alt="">Log out
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">
                <?php $this->renderSection('content'); ?>
            </div>
            <!-- /page content -->

            <!-- footer content -->
            <footer>
                <div class="pull-right">
                    Bengkelin by <a href="https://mn-belajarweb.blogspot.com">MN-Belajarweb.blogspot.com</a>
                </div>
                <div class="clearfix"></div>
            </footer>
            <!-- /footer content -->
        </div>
    </div>

    <!-- Bootstrap -->
    <script src="<?= base_url() ?>/public/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Datatables -->
    <script src="<?= base_url() ?>/public/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>/public/vendor/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="<?= base_url() ?>/public/js/custom.min.js"></script>


</body>

</html>
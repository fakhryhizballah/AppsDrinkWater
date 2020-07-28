<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title; ?></title>

    <!-- Custom fonts for this template-->
    <link href="Asset/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <!-- Custom styles for this template-->
    <link href="Asset/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a style="background-color: white;" class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon">
                    <!-- <i class="fas fa-stethoscope"></i> -->
                    <img src="/img/IG.png" class="logo" style="width: 70px; height:auto" alt="">
                </div>
                <div class="sidebar-brand-text mx-3" style="color: black;">Spairum</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider">


            <!-- QUERY MENU -->

            <!-- < ?php
            $role_id = $this->session->userdata('role_id');
            $queryMenu = "SELECT `user_menu`.`id`, `menu`
                FROM `user_menu` JOIN `user_access_menu` 
                ON `user_menu`.`id` = `user_access_menu`.`menu_id`
                WHERE `user_access_menu`.`role_id` = $role_id
            ORDER BY `user_access_menu`.`menu_id` ASC
    ";
            $menu = $this->db->query($queryMenu)->result_array();
            ?> -->



            <!-- LOOPING MENU -->
            <!-- < ?php foreach ($menu as $m) : ?>
                < ?php if ($m['menu'] != 'Menu') : ?>
                    <div class="sidebar-heading">
                        < ?= $m['menu'] ?>
                    </div> -->

            <!-- SIAPKAN MENU SESUAI SUB-MENU -->
            <!-- < ?php
                    $menuId = $m['id'];
                    $querySubMenu = "SELECT *
                FROM `user_sub_menu`
                WHERE `menu_id` = $menuId
                AND `is_active` = 1
            ";
                    $subMenu = $this->db->query($querySubMenu)->result_array();
                    ?>

                    < ?php foreach ($subMenu as $sm) : ?> -->

            <!-- Nav Item - Dashboard -->
            <!-- < ?php if ($title == $sm['title']) : ?>
                            <li class="nav-item active">
                            < ?php else : ?>
                            <li class="nav-item">
                            < ?php endif; ?>

                            <a class="nav-link pb-0" href="< ?= base_url($sm['url']); ?>">
                                <i class="< ?= $sm['icon']; ?>"></i>
                                <span>< ?= $sm['title']; ?></span></a>
                            </li>

                        < ?php endforeach ?> -->

            <!-- Divider -->
            <!-- <hr class="sidebar-divider mt-3">
                    < ?php endif; ?>
                < ?php endforeach; ?> -->

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin'); ?>">
                    <i class="fas fa-fw fa-sign-out-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="mitraDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-fw fa-sign-out-alt"></i>
                    <span>Mitra</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="mitraDropdown">
                    <a class="dropdown-item" href="admin/driver">
                        <span>Driver</span>
                    </a>
                    <a class="dropdown-item" href="admin/ptcv">
                        <span>PT/CV</span>
                    </a>
                </div>
            </li>


            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/user'); ?>">
                    <i class="fas fa-fw fa-sign-out-alt"></i>
                    <span>User</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/stasiun'); ?>">
                    <i class="fas fa-fw fa-sign-out-alt"></i>
                    <span>Stasiun</span></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="createDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-fw fa-sign-out-alt"></i>
                    <span>Create</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="createDropdown">
                    <a class="dropdown-item" href="admin/crtmitra">
                        <span>Mitra/Supplier</span>
                    </a>
                    <a class="dropdown-item" href="admin/crtdriver">
                        <span>Driver</span>
                    </a>
                    <a class="dropdown-item" href="'admin/crtstasiun">
                        <span>Stasiun</span>
                    </a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('auth/logout'); ?>">
                    <i class="fas fa-fw fa-sign-out-alt"></i>
                    <span>Logout</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Messages -->

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Fakhry</span>
                                <!-- <img class="img-profile rounded-circle" src="< ?= base_url('Asset/img/profile/') . $user['image']; ?>"> -->
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    My Profile
                                </a>

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= base_url('auth/logout'); ?>" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
                <?= $this->renderSection('admcontent'); ?>
                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span> <strong>Copyright &copy; <?= date('Y'); ?> SPAIRUM.</strong> All rights reserved. V.1</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="<?= base_url('auth/logout'); ?>">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="Asset/vendor/jquery/jquery.min.js"></script>
        <script src="Asset/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="Asset/vendor/jquery-easing/jquery.easing.min.js"></script>


        <!-- Custom scripts for all pages-->
        <script src="Asset/js/sb-admin-2.min.js"></script>

        <!-- Untuk AJAX UBAH DATA -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
        <script src="Asset/js/jquery-3.2.1.min.js"></script>
        <script src="Asset/js/scriptsuratrujukan.js"></script>

        <script src="Asset/js/popper.min.js"></script>


        <script src="Asset/js/script.js"></script>
        <script src="Asset/js/scriptresep.js"></script>
        <script src="Asset/js/script_obat.js"></script>

        <link rel="stylesheet" href="Asset/plugins/jquery-ui/jquery-ui.css">

        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


        <script>
            $('.form-check-input').on('click', function() {
                const menuId = $(this).data('menu');
                const roleId = $(this).data('role');

                $.ajax({
                    url: "<?= base_url('admin/changeaccess'); ?>",
                    type: 'post',
                    data: {
                        menuId: menuId,
                        roleId: roleId
                    },
                    success: function() {
                        document.location.href = "<?= base_url('admin/roleaccess/'); ?>" + roleId;
                    }
                });

            })
        </script>

        <script>
            $(function() {
                $("#tanggalantrian").datepicker({
                    changeMonth: true,
                    changeYear: true,
                    yearRange: '1950:2020',
                    dateFormat: 'dd/mm/yy',
                    autoclose: true,
                    todayHighlight: true,
                });
            });
        </script>
        <script>
            $(function() {
                $("#tanggalpembuatan").datepicker({
                    changeMonth: true,
                    changeYear: true,
                    yearRange: '1950:2020',
                    format: 'yyyy-mm-dd',
                    autoclose: true,
                    todayHighlight: true,
                });
            });
        </script>
        <script>
            $(function() {
                $("#tanggalkadaluwarsa").datepicker({
                    changeMonth: true,
                    changeYear: true,
                    yearRange: '1950:2020',
                    format: 'yyyy-mm-dd',
                    autoclose: true,
                    todayHighlight: true,
                });
            });
        </script>
</body>

</html>
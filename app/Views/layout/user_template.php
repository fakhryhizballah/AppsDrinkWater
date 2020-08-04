<!doctype html>

<html lang="id">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Material design icons CSS -->
    <link rel="stylesheet" href="vendor/materializeicon/material-icons.css">

    <!-- Roboto fonts CSS -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&amp;display=swap" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap-4.4.1/css/bootstrap.min.css" rel="stylesheet">

    <!-- Swiper CSS -->
    <link href="vendor/swiper/css/swiper.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/home_style.css" rel="stylesheet">

    <!-- my style.css -->
    <link rel="stylesheet" href="css/style.css">
    <!-- My font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<title><?= $title; ?></title>


<body>
    <div class="sidebar">
        <div class="mt-4 mb-3">
            <div class="row">
                <div class="col-auto">
                    <figure class="avatar avatar-60 border-0"><img src="img/user1.png" alt=""></figure>
                </div>
                <div class="col pl-0 align-self-center">
                    <h5 class="mb-1">Ammy Jahnson</h5>
                    <p class="text-mute small">Work, London, UK</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="list-group main-menu">
                    <a href="/home" class="list-group-item list-group-item-action active"><i class="material-icons icons-raised">home</i>Home</a>

                    <!-- <a href="notification.html" class="list-group-item list-group-item-action"><i class="material-icons icons-raised">notifications</i>Notification <span class="badge badge-dark text-white">2</span></a> -->

                    <a href="/user/history" class="list-group-item list-group-item-action"><i class="material-icons icons-raised">find_in_page</i>History</a>
                    <!-- <a href="controls.html" class="list-group-item list-group-item-action"><i class="material-icons icons-raised">view_quilt<span class="new-notification"></span></i>Pages Controls</a> -->
                    <a href="#" class="list-group-item list-group-item-action"><i class="material-icons icons-raised">important_devices</i>Settings</a>
                    <!-- <a href="javascript:void(0)" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#colorscheme"><i class="material-icons icons-raised">color_lens</i>Color scheme</a> -->
                    <a href="/auth/logout" class="list-group-item list-group-item-action"><i class="material-icons icons-raised bg-danger">power_settings_new</i>Logout</a>
                </div>
            </div>
        </div>
    </div>
    <a href="javascript:void(0)" class="closesidemenu"><i class="material-icons icons-raised bg-dark ">close</i></a>
    <div class="wrapper homepage">

        <!-- header -->
        <div class="header">
            <div class="card fixed-top">
                <div class="row no-gutters">
                    <div class="col-1">
                        <button class="btn  btn-link text-dark menu-btn"><i class="material-icons">menu</i></button>
                    </div>
                    <div class="col text-center"><img src="img/spairum logo.png" alt="" class="header-logo"></div>
                    <div class="col-11">
                        <!-- <a href="notification.html" class="btn  btn-link text-dark position-relative"><i class="material-icons">notifications_none</i><span class="counts">9+</span></a> -->
                    </div>
                </div>
            </div>
        </div>
        <!-- header ends -->


        <?= $this->renderSection('content'); ?>

        <!-- footer-->
        <div class="foother">
            <div class="no-gutters">
                <nav class="nav nav-pills nav-fill fixed-bottom bg-light">
                    <div class="col-12 mx-auto">
                        <div class="row no-gutters justify-content-center">

                            <li class="nav-item col-3">
                                <a href="/home">
                                    <img src="/img/ui.svg" alt="" class="buttonNav">
                                    <a class="nav-link fontNav" href="/home">Home</a>
                                </a>
                            </li>
                            <li class="nav-item col-3">
                                <a href="/stasiun">
                                    <img src="/img/explore.svg" alt="" class="buttonNav">
                                    <a class="nav-link fontNav" href="/stasiun">Explore</a>
                                </a>
                            </li>
                            <li class="nav-item col-3">
                                <a href="#">
                                    <img src="/img/wallet.svg" alt="" class="buttonNav">
                                    <a class="nav-link fontNav" href="#">Top Up</a>
                                </a>
                            </li>
                            <li class="nav-item col-3">
                                <a href="/riwayat">
                                    <img src="/img/history.svg" alt="" class="buttonNav">
                                    <a class="nav-link fontNav">History</a>
                                </a>
                            </li>
                        </div>
                    </div>
                </nav>

            </div>
        </div>
        <!-- footer ends-->







        <!-- jquery, popper and bootstrap js -->
        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="vendor/bootstrap-4.4.1/js/bootstrap.min.js"></script>

        <!-- swiper js -->
        <script src="vendor/swiper/js/swiper.min.js"></script>

        <!-- cookie js -->
        <script src="vendor/cookie/jquery.cookie.js"></script>


        <script>
            var slider = document.getElementById("myRange");
            var output = document.getElementById("take");
            output.innerHTML = slider.value;

            slider.oninput = function() {
                output.innerHTML = this.value;
            }
        </script>

        <!-- template custom js -->
        <script src="js/main.js"></script>

        <!-- page level script -->
        <script></script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        <script src="js/script.js"></script>
</body>

</html>
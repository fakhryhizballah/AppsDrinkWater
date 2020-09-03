<html lang="id">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Material design icons CSS -->
    <link rel="stylesheet" href="Mandor/materializeicon/material-icons.css">

    <!-- Roboto fonts CSS -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&amp;display=swap" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <!-- <link href="Mandor/bootstrap-4.4.1/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">

    <!-- Swiper CSS -->
    <link href="Mandor/swiper/css/swiper.min.css" rel="stylesheet">



    <!-- my style.css -->
    <link rel="stylesheet" href="css/style.css">
    <!-- My font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <!-- Manifes -->
    <link rel="manifest" href="Manifes/manifes.json">
    <meta name="theme-color" content="#2196f3">
    <!-- <link rel="manifest" href="https://goo.gl/aESk5L"> -->

    <!-- Custom styles for this template -->
    <link href="css/home_style.css" rel="stylesheet">

    <!-- leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>





    <style>
        /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
        #map {
            height: 100%;
            width: 100%;
            margin-top: 54px;
            position: fixed;

        }

        /* Optional: Makes the sample page fill the window. */
        html,
        body {

            height: 100%;

            margin: 0;
            padding: 0;
        }

        #tabel_markers {
            position: fixed;
            top: 50%;
            left: 2%;
            overflow-y: auto;
            max-height: 300px;
            max-width: 500px;
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            background-color: #f2f2f2;
            font-size: 9pt
        }

        #tabel_markers td,
        #tabel_markers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #tabel_markers tr:hover {
            background-color: #ddd;
        }

        #tabel_markers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<title><?= $title; ?></title>

<body>
    <div class="countainer">
        <div class="map"></div>
    </div>

    <div id="map"></div>

    <!-- <div id="tabel_markers">
        <table border="1" cellpadding="10" cellspacing="0">
            <th colspan="6">
                Data
            </th>
            <tr>
                <td>No.</td>
                <td>ID Stasiun</td>
                <td>Lokasi</td>
                <td>Lat</td>
                <td>Lng</td>
                <td>Status</td>
            </tr>
            <!--Mengambil data markers-->
    <tr>
        <?php $i = 1; ?>
        <?php foreach ($stasiun as $row) : ?>
            <td><?= $i; ?></td>
            <td><?= $row["id_mesin"]; ?></td>
            <td><?= $row["lokasi"]; ?></td>
            <td><?= $row["lat"]; ?></td>
            <td><?= $row["lng"]; ?></td>
            <td><?= $row["status"]; ?></td>

    </tr>
    <?php $i++; ?>
<?php endforeach; ?>
</table>
</div> -->

<script>
    // Note: This example requires that you consent to location sharing when
    // prompted by your browser. If you see the error "The Geolocation service
    // failed.", it means you probably did not give permission for the browser to
    // locate you.
    var map, infoWindow;
    // <div id="mapid" style="width: 600px; height: 400px;"></div>
    var mymap = L.map('map').setView([-0.024779, 109.328607], 15);
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {

        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
            '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        id: 'mapbox/streets-v11',

    }).addTo(mymap);

    <?php foreach ($stasiun as $key => $value) { ?>
        L.marker([<?= $value['lat']; ?>, <?= $value['lng']; ?>]).addTo(mymap).bindPopup("<b><?= $value['lokasi']; ?></b><br /><?= $value['ket']; ?>. <br><a href='<?= $value['link']; ?> '>Buka Maps</a>");
    <?php } ?>

    // function initMap() {
    //     // The location of Uluru
    //     var uluru = {
    //         lat: -0.024779,
    //         lng: 109.328607
    //     };
    //     // The map, centered at Uluru
    //     // var map = new google.maps.Map(
    //     //     document.getElementById('map'), {
    //     //         zoom: 15,
    //     //         center: uluru
    //     //     });
    //     // The marker, positioned at Uluru
    //     var marker = new google.maps.Marker({
    //         position: uluru,
    //         map: map,
    //         title: 'Stasiun'
    //     });

    //     var contentString = '<div id="content">' +
    //         '<div id="siteNotice">' +
    //         '</div>' +
    //         '<h1 id="firstHeading" class="firstHeading">Spairum</h1>' +
    //         '<div id="bodyContent">' +
    //         '<b>Office Spairum</b>, ' +
    //         '<p><a href="https://goo.gl/maps/3cX4HM8YPgz46EoH9">' +
    //         'Klik Kunjungi</a> ' +
    //         '</p>' +
    //         '</div>' +
    //         '</div>';
    //     var infowindow = new google.maps.InfoWindow({
    //         content: contentString
    //     });

    //     marker.addListener('click', function() {
    //         infowindow.open(map, marker);
    //     });


    //     infoWindow = new google.maps.InfoWindow;

    //     // Try HTML5 geolocation.
    //     if (navigator.geolocation) {
    //         navigator.geolocation.getCurrentPosition(function(position) {
    //             var pos = {
    //                 lat: position.coords.latitude,
    //                 lng: position.coords.longitude
    //             };

    //             infoWindow.setPosition(pos);
    //             infoWindow.setContent('Lokasi anda');
    //             infoWindow.open(map);
    //             map.setCenter(pos);
    //         }, function() {
    //             handleLocationError(true, infoWindow, map.getCenter());
    //         });
    //     } else {
    //         // Browser doesn't support Geolocation
    //         handleLocationError(false, infoWindow, map.getCenter());
    //     }
    // }


    // function handleLocationError(browserHasGeolocation, infoWindow, pos) {
    //     infoWindow.setPosition(pos);
    //     infoWindow.setContent(browserHasGeolocation ?
    //         'Error: The Geolocation service failed.' :
    //         'Error: Your browser doesn\'t support geolocation.');
    //     infoWindow.open(map);
    // }
</script>
<script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDjKeVFWsG5gTOd4UegCxqJgKoRam9yJX0&callback=initMap">
</script>

<div class="sidebar">
    <div class="mt-4 mb-3">
        <div class="row">
            <div class="col-auto">
                <figure class="avatar avatar-60 border-0"><img src="img/user/user.png" alt=""></figure>
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




<!-- footer-->
<div class="foother">
    <div class="no-gutters">
        <nav class="nav nav-pills nav-fill fixed-bottom bg-light">
            <div class="col-12 mx-auto">
                <div class="row no-gutters justify-content-center">

                    <li class="nav-item col-3">
                        <a href="/user">
                            <img src="/img/ui.svg" alt="" class="buttonNav">
                            <a class="nav-link fontNav" href="/user">Home</a>
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
<script src="Mandor/bootstrap-4.4.1/js/bootstrap.min.js"></script>

<!-- swiper js -->
<script src="Mandor/swiper/js/swiper.min.js"></script>

<!-- cookie js -->
<script src="Mandor/cookie/jquery.cookie.js"></script>

<!-- template custom js -->
<script src="js/main.js"></script>

<!-- page level script -->


</body>

</html>
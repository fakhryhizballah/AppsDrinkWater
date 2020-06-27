<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- my style.css -->
    <link rel="stylesheet" href="/css/style.css">
    <!-- My font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>

<body>

    <?= $this->renderSection('content'); ?>
    <!-- footer-->
    <div class="foother">
        <div class=" no-gutters">
            <nav class="nav nav-pills nav-fill fixed-bottom">
                <div class="col-auto mx-auto">
                    <div class="row no-gutters justify-content-center">

                        <li class="nav-item col-auto">
                            <img src="/img/Shape.png" alt="" class="buttonNav">
                            <a class="nav-link fontNav" href="#">Profil</a>
                        </li>
                        <li class="nav-item col-auto">
                            <img src="/img/explore.png" alt="" class="buttonNav">
                            <a class="nav-link fontNav" href="#">Explore</a>
                        </li>
                        <li class="nav-item col-auto" href="#">
                            <img src="/img/riwayat.png" alt="" class="buttonNav">
                            <a class="nav-link fontNav" href="#">History</a>
                        </li>
                    </div>
                </div>
            </nav>


        </div>
    </div>
    <!-- footer ends-->


    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>
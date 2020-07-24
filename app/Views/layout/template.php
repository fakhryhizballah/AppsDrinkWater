<!doctype html>
<html lang="id">

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
<title><?= $title; ?></title>

<body>
    <?= $this->renderSection('content'); ?>

    <!-- footer-->
    <div class="foother">
        <div class="no-gutters">
            <nav class="nav nav-pills nav-fill fixed-bottom bg-light">
                <div class="col-auto mx-auto">
                    <div class="row no-gutters justify-content-center">

                        <li class="nav-item col-auto">
                            <a href="/driver/index">
                                <img src="/img/Shape.png" alt="" class="buttonNav">
                                <a class="nav-link fontNav" href="/driver">Profil</a>
                            </a>
                        </li>
                        <li class="nav-item col-auto">
                            <a href="/driver/explore">
                                <img src="/img/explore.png" alt="" class="buttonNav">
                                <a class="nav-link fontNav" href="/driver/explore">Explore</a>
                            </a>
                        </li>
                        <li class="nav-item col-auto">
                            <a href="/driver/History">
                                <img src="/img/riwayat.png" alt="" class="buttonNav">
                                <a class="nav-link fontNav">History</a>
                            </a>
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
    <script>
        function previewImg() {
            const profil = document.querySelector('#profil');
            const profilLabel = document.querySelector('.custom-file-label');
            const imgPreview = document.querySelector('.img-preview');

            profilLabel.textContent = profil.files[0].name;
            const fileProfil = new FileReader();

            fileProfil.readAsDataURL(profil.files[0]);

            fileProfil.onload = function(e) {
                imgPreview.src = e.target.result;
            }
        }
    </script>
</body>

</html>
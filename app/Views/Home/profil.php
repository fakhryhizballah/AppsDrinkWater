<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <img src="/img/devax.jpg" class="profil" alt="">
        <h1 class="name ">Tiara Aluan</h1>
        <p class="name-crop">Ponti Kua</p>
    </div>
</div>
<div class="card card-dasbord shadow">
    <div class="row no-gutters justify-content-center">
        <div class="col-xs card-block">
            <div class="card-item ">
                <h5 class="card-item-title">20</h5>
            </div>
            <p class="text-center" style="padding-top: 10px;">Trip</p>
        </div>
        <div class="col-xs card-block">
            <div class="card-item">
                <h5 class="card-item-title">20</h5>
            </div>
            <p class="text-center" style="padding-top: 10px;">Liter</p>
        </div>
        <div class="col-xs card-block">
            <div class="card-item">
                <h5 class="card-item-title">20</h5>
            </div>
            <p class="text-center" style="padding-top: 10px;">Point</p>
        </div>
    </div>
</div>
<!-- <div class="container">
    <div class="counter">
        <div class="card-body " style="width: 18rem;">
            <img class="card-img-top" src="..." alt="Card image cap">
            <div class="card-body">
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
        </div>
    </div>
</div> -->

<?= $this->endSection('content'); ?>
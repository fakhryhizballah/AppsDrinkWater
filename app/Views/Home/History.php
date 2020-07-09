<?= $this->extend('layout/templateBack'); ?>
<?= $this->section('MainBack'); ?>


<nav class="nav nav-pills nav-fill justify-content-center">
    <div class="row no-gutters justify-content-center " style="margin-top: 60px">

        <li class="nav-item col-xs text-center nav-margin">
            <img class="status buttonNav" src="/img/Group 14.png" alt="">
            <a class="nav-link fontNav" href="#">Selesai</a>

        </li>
        <li class="nav-item col-xs text-center nav-margin">
            <img class="status buttonNav" src="/img/Group 8.png" alt="">
            <a class="nav-link fontNav" href="#">Batal</a>
        </li>
        <li class="nav-item col-xs text-center nav-margin">
            <img class="status buttonNav" src="/img/Group 10.png" alt="" href="page/Histori">
            <a class="nav-link fontNav" href="page/Histori">Proses</a>
        </li>
    </div>
</nav>


<div class="card card-iden shadow">
    <h5 class="card-iden-h5">Selesai</h5>
    <div class="row">
        <div class="col">
            <p class="card-iden-p1">ID Transaksi</p>
        </div>
        <div class="col">
            <p class="card-iden-p2">002019303</p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <p class="card-iden-p1">ID Stasiun</p>
        </div>
        <div class="col">
            <p class="card-iden-p2">00012293</p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <p class="card-iden-p1">Lokasi</p>
        </div>
        <div class="col">
            <p class="card-iden-p2">Taman Digulis</p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <p class="card-iden-p1">Jumlah Air</p>
        </div>
        <div class="col">
            <p class="card-iden-p2 "><strong>20 </strong> L</p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <p class="card-iden-p1">Tanggal</p>
        </div>
        <div class="col">
            <p class="card-iden-p2 text-muted">01/7/2020</p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <p class="card-iden-p1">Waktu</p>
        </div>
        <div class="col">
            <p class="card-iden-p2 text-muted">15.30</p>
        </div>
    </div>
</div>

<!-- Looping -->

<div class="card card-iden shadow">
    <h5 class="card-iden-h5">Selesai</h5>
    <div class="row">
        <div class="col">
            <p class="card-iden-p1">ID Transaksi</p>
        </div>
        <div class="col">
            <p class="card-iden-p2">002019233</p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <p class="card-iden-p1">ID Stasiun</p>
        </div>
        <div class="col">
            <p class="card-iden-p2">00012287</p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <p class="card-iden-p1">Lokasi</p>
        </div>
        <div class="col">
            <p class="card-iden-p2">Water Front Barito</p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <p class="card-iden-p1">Jumlah Air</p>
        </div>
        <div class="col">
            <p class="card-iden-p2 "><strong>20 </strong> L</p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <p class="card-iden-p1">Tanggal</p>
        </div>
        <div class="col">
            <p class="card-iden-p2 text-muted">02/7/2020</p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <p class="card-iden-p1">Waktu</p>
        </div>
        <div class="col">
            <p class="card-iden-p2 text-muted">09.15</p>
        </div>
    </div>
</div>

<?= $this->endSection('MainBack'); ?>
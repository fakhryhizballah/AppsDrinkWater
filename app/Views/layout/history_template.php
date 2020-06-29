<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="card">
    <div class="row no-gutters">
        <div class="col-4">
            <img class="back" src="/img/back.png" alt="">
        </div>
        <div class="col-8">
            <h5 class="h5-navbar">Riwayat</h5>
        </div>
    </div>
</div>

<nav class="nav nav-pills nav-fill justify-content-center">
    <div class="row no-gutters justify-content-center">

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
<?= $this->endSection('content'); ?>
<?= $this->renderSection('histori'); ?>
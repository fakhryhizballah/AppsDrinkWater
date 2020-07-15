<?= $this->extend('layout/templateBack'); ?>
<?= $this->section('MainBack'); ?>
<h5>Hai</h5>
<?php foreach ($stasiun as $s) : ?>
    <div class="card card-iden shadow">
        <h5 class="card-iden-h5"><?= $s['lokasi']; ?></h5>
        <div class="row">
            <div class="col">
                <p class="card-iden-p1">ID Mesin</p>
            </div>
            <div class="col">
                <p class="card-iden-p2"><?= $s['id mesin']; ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <p class="card-iden-p1">Isi Air dalam Stasiun</p>
            </div>
            <div class="col">
                <p class="card-iden-p2"><?= $s['isi']; ?> L</p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <p class="card-iden-p1">Indikator</p>
            </div>
            <div class="col">
                <p class="card-iden-p2"><?= $s['indikator']; ?></p>
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
<?php endforeach; ?>


<?= $this->endSection('MainBack'); ?>
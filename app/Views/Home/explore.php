<?= $this->extend('layout/templateBack'); ?>
<?= $this->section('MainBack'); ?>
<?php foreach ($stasiun as $s) : ?>
    <div class="card card-iden shadow">
        <h5 class="card-iden-h5"><?= $s['lokasi']; ?></h5>
        <div class="row">
            <div class="col">
                <p class="card-iden-p1">Kordinat</p>
            </div>
            <div class="col">
                <p class="card-iden-p2"><?= $s['geo']; ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <p class="card-iden-p1">ID Mesin</p>
            </div>
            <div class="col">
                <p class="card-iden-p2"><?= $s['id_mesin']; ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <p class="card-iden-p1">Isi Air dalam Stasiun</p>
            </div>
            <div class="col">
                <p class="card-iden-p2"><?= $s['isi']; ?> mL</p>
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
                <p class="card-iden-p1">Status</p>
            </div>
            <div class="col">

                <h1 class="card-iden-p2 text-muted">
                    <?php
                    if ($s['status'] == '1') {
                        echo "stanbay";
                    } elseif ($s['status']  == '2') {
                        echo "Sedang proses pengisian";
                    } else {
                        echo "Off";
                    }
                    ?></h1>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <p class="card-iden-p1">Update Time</p>
            </div>
            <div class="col">
                <p class="card-iden-p2 text-muted"><?= $s['updated_at']; ?></p>
            </div>
        </div>
    </div>
<?php endforeach; ?>


<?= $this->endSection('MainBack'); ?>
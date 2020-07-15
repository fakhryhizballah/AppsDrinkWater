<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <img src="/img/devax.jpg" class="profil" alt="">
        <h1 class="name ">Tiara Aluan</h1>
        <p class="name-crop">Ponti Kua</p>
    </div>
</div>
<div>
    <div class="card card-dasbord shadow">
        <div class="row no-gutters justify-content-center">
            <div class="col-xs card-block">
                <div class="card-item ">
                    <h5 class="card-item-title">8</h5>
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
                    <h5 class="card-item-title">90</h5>
                </div>
                <p class="text-center" style="padding-top: 10px;">Point</p>
            </div>
        </div>
    </div>
    <div class="card card-iden shadow">
        <h5 class="card-iden-h5">Identitas Akun</h5>
        <div class="row">
            <div class="col">
                <p class="card-iden-p1">Nama</p>
            </div>
            <div class="col">
                <p class="card-iden-p2">Tiara Alunan</p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <p class="card-iden-p1">ID Akun</p>
            </div>
            <div class="col">
                <p class="card-iden-p2">#108293</p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <p class="card-iden-p1">Nomor Telpon</p>
            </div>
            <div class="col">
                <p class="card-iden-p2">+62 8953 2981 199</p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <p class="card-iden-p1">Setting</p>
            </div>
            <div class="col">
                <p class="card-iden-p2 text-muted"><u>Edit Profile</u></p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <p class="card-iden-p1"></p>
            </div>
            <div class="col">
                <a href="/Auth/logout" class="stretched-link "><u>Logout</u></a>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection('content'); ?>
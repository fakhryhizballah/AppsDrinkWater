<?= $this->extend('layout/user_template'); ?>
<?= $this->section('content'); ?>

<div class="container">
    <div class="card bg-template shadow mt-4 h-190">
        <div class="card-body">
            <div class="row">
                <div class="col-auto">
                    <figure class="avatar avatar-60"><img src="/img/user/<?= $akun['profil']; ?>" alt=""></figure>
                </div>
                <div class="col pl-0 align-self-center">
                    <h5 class="mb-1"><?= $akun['nama']; ?></h5>
                    <p class="text-mute small"><?= $akun['id_user']; ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container top-100">
    <div class="card mb-4 shadow">
        <div class="card-body border-bottom">
            <div class="row">
                <div class="col">
                    <h3 class="mb-0 font-weight-normal"><?= $akun['debit']; ?> mL</h3>
                    <p class="text-mute">Saldo Air</p>
                </div>
                <div class="col-auto">
                    <!-- <button class="btn btn-default btn-rounded-54 shadow" data-toggle="modal" data-target="#addmoney"><i class="material-icons">add</i></button> -->
                </div>
            </div>
        </div>
        <div class="card-footer bg-none">
            <div class="row">
                <div class="col">
                    <p><?= $akun['kredit']; ?> mL<i class="material-icons text-danger vm small"></i><br><small class="text-mute">kredit</small></p>
                </div>
                <!-- <div class="col text-center">
                    <p>2.24 L<i class="material-icons text-success vm small">arrow_upward</i><br><small class="text-mute">today</small></p>
                </div> -->
                <div class="col text-right">
                    <p><span name="take" id="take"></span> mL<br><small class="text-mute">Take</small></p>
                </div>
            </div>
        </div>
    </div>
    <h6 class="subtitle">Take drink Water</h6>
    <div class="card shadow border-0 mb-2">
        <div class="card-body">
            <div class="row">
                <div class="col">

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <p class="text-mute small text-secondary ">Take a minimum of 100 mL</p>
            </div>
        </div>
    </div>
    <form class="user" method="POST" action="user/take">
        <div class="form-group user-form">
            <div class="slidecontainer">
                <input type="range" min="100" max="1200" value="220" class="slider" id="myRange" name="take">
            </div>


            <button type=" submit" class="btn btn-user btn-block btn-outline-primary btn-rounded">
                Take
            </button>
    </form>
    <div class="row">
        <!-- <div class="col-auto mx-auto">
                <button type="button" href="user/take" name="take" id="take" value="" class="mb-2 btn btn-outline-primary btn-rounded">Take</button>
            </div> -->
    </div>
</div>
</div>

<?= $this->endSection('content'); ?>
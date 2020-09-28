<?= $this->extend('layout/user_template'); ?>
<?= $this->section('content'); ?>

<div class="wrapper">
    <div class="container">
        <div class="text-center">
            <div class="figure-profile shadow my-4">
                <figure><img src="/img/user/<?= $akun['profil']; ?>" alt=""></figure>
                <div class="btn btn-dark text-white floating-btn">
                    <i class="material-icons">camera_alt</i>
                    <input type="file" class="float-file">
                </div>
            </div>
        </div>

        <h6 class="subtitle">Edit Profile</h6>
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="form-group float-label active">
                    <input type="text" class="form-control" required="" value="<?= $akun['nama_depan']; ?>">
                    <label class="form-control-label">Nama Depan</label>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group float-label active">
                    <input type="text" class="form-control" required="" value="<?= $akun['nama_belakang']; ?>">
                    <label class="form-control-label">Nama Belakang</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="form-group float-label active">
                    <input type="text" class="form-control" required="" value="<?= $akun['nama']; ?>">
                    <label class="form-control-label">Username</label>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group float-label active mb-0">
                    <input type="tel" class="form-control" required="" value="<?= $akun['telp']; ?>">
                    <label class="form-control-label">Nomor Telp</label>
                </div>
            </div>
        </div>

        <h6 class="subtitle">Change Email</h6>
        <div class="form-group float-label active">
            <input type="email" id="email" class="form-control form-control-lg" value="<?= $akun['email']; ?>" required>
            <label class="form-control-label">Current Email</label>
        </div>
        <div class="form-group float-label">
            <input type="email" id="email1" class="form-control form-control-lg" required>
            <label class="form-control-label">New Email</label>
        </div>
        <div class="row mt-4">
            <div class="col">
                <a href="" class="btn btn-lg btn-default btn-block btn-rounded shadow"><span>Update Email</span></a>
            </div>
        </div>

        <h6 class="subtitle">Change Password</h6>
        <div class="form-group float-label">
            <input type="password" id="inputPassword" class="form-control form-control-lg" required>
            <label for="inputPassword" class="form-control-label">Current Password</label>
        </div>
        <div class="form-group float-label">
            <input type="password" id="inputPassword1" class="form-control form-control-lg" required>
            <label for="inputPassword1" class="form-control-label">New Password</label>
        </div>
        <div class="form-group float-label">
            <input type="password" id="inputPassword2" class="form-control form-control-lg" required>
            <label for="inputPassword2" class="form-control-label">Confirm New Password</label>
        </div>
        <div class="row mt-4">
            <div class="col">
                <a href="" class="btn btn-lg btn-default btn-block btn-rounded shadow"><span>Update Password</span></a>
            </div>
        </div>
        <br>
        <a href="" class="btn btn-lg btn-default text-white btn-block btn-rounded shadow"><span>Submit</span></a>
        <br>
    </div>

    <?= $this->endSection('content'); ?>
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
        <form method="post" action="user/profileupdate">
            <div class="row">
                <div class="col-12 col-md-6" hidden>
                    <div class="form-group float-label active">
                        <input type="text" id="id" name="id" class="form-control" required="" value="<?= $akun['id']; ?>">
                        <label class="form-control-label">ID</label>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group float-label active">
                        <input type="text" id="nama_depan" name="nama_depan" class="form-control" required="" value="<?= $akun['nama_depan']; ?>">
                        <label class="form-control-label">Nama Depan</label>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group float-label active">
                        <input type="text" id="nama_belakang" name="nama_belakang" class="form-control" required="" value="<?= $akun['nama_belakang']; ?>">
                        <label class="form-control-label">Nama Belakang</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="form-group float-label active">
                        <input type="text" id="nama" name="nama" class="form-control" required="" value="<?= $akun['nama']; ?>">
                        <label class="form-control-label">Username</label>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group float-label active mb-0">
                        <input type="tel" id="telp" name="telp" class="form-control" required="" value="<?= $akun['telp']; ?>">
                        <label class="form-control-label">Nomor Telp</label>
                    </div>
                </div>
            </div>

            <br>
            <button type="submit" class="btn btn-lg btn-default text-white btn-block btn-rounded shadow"><span>Submit</span></button>
            <br>
        </form>

        <h6 class="subtitle">Change Email</h6>
        <form method="post" action="user/emailupdate">
            <div class="form-group float-label active">
                <input type="email" id="email1" name="email1" class="form-control form-control-lg" value="<?= $akun['email']; ?>" required>
                <label class="form-control-label">Current Email</label>
            </div>
            <div class="form-group float-label">
                <input type="email" id="email2" name="email2" class="form-control form-control-lg" required>
                <label class="form-control-label">New Email</label>
            </div>

            <button type="submit" class="btn btn-lg btn-default btn-block btn-rounded shadow"><span>Update Email</span></button>
        </form>
    </div>
</div>

<?= $this->endSection('content'); ?>
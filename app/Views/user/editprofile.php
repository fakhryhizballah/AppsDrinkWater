<?= $this->extend('layout/user_template'); ?>
<?= $this->section('content'); ?>

<div class="wrapper">
    <div class="container">
        <div class="flash-Error" data-flashdata="<?= session()->getFlashdata('salah'); ?>"></div>
        <form method="post" action="user/profileupdate" enctype="multipart/form-data">

            <div class="text-center">
                <div class="form-group">
                    <div class="figure-profile shadow my-4">
                        <figure><img class="img-thumbnail img-preview" src="/img/user/<?= $akun['profil']; ?>" alt=""></figure>

                        <div class="btn btn-dark text-white floating-btn custom-file">
                            <i class="material-icons">camera_alt</i>
                            <input type="file" class="float-file  <?= ($validation->hasError('profil')) ? 'is-invalid' : ''; ?>" name="profil" id="profil" onchange="previewImg()">
                            <input type="hidden" name="profilLama" id="profilLama" value="<?= $akun['profil']; ?>">
                            <div class="invalid-feedback"><?= $validation->getError('profil'); ?></div>
                        </div>

                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <!-- <div class="col-md-2">
                            <img src="/img/driver/<?= $akun['profil']; ?>" class="img-thumbnail img-preview mx-auto d-block">
                        </div> -->
                        <div class="col-md-8">
                            <div class="custom-file">
                                <!-- <input type="file" class="custom-file-input <?= ($validation->hasError('profil')) ? 'is-invalid' : ''; ?>" id="profil" name="profil" onchange="previewImg()"> -->
                                <label class="custom-file-label" for="profil">Pilih Gambar</label>
                                <div class="invalid-feedback"><?= $validation->getError('profil'); ?></div>
                            </div>
                        </div>
                    </div>

                    <div class="invalid-feedback"></div>
                </div>
            </div>


            <h6 class="subtitle">Edit Profile</h6>
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
                    <div class="form-group float-label active mb-0">
                        <input type="text" id="telp" name="telp" class="form-control form-control-user <?= ($validation->hasError('telp')) ? 'is-invalid' : ''; ?>" id="telp" name="telp" placeholder="" value="<?= $akun['telp']; ?>">
                        <label class="form-control-label">Nomor Telp</label>
                        <div class="invalid-feedback"><?= $validation->getError('telp'); ?></div>
                    </div>
                </div>
            </div>

            <br>
            <button type="submit" class="btn btn-lg btn-default text-white btn-block btn-rounded shadow"><span>Submit</span></button>
            <br>
        </form>

        <h6 class="subtitle">Ganti Email</h6>
        <form method="post" action="user/emailupdate">
            <div class="form-group float-label active">
                <input type="email" id="email1" name="email1" class="form-control form-control-lg" value="<?= $akun['email']; ?>" disabled>
                <label class="form-control-label">Email Lama</label>
            </div>
            <!-- <div class="form-group float-label">
                <input type="email" id="email" name="email" class="form-control form-control-lg" required>
                <label class="form-control-label">Email Baru</label>
            </div> -->
            <div class="form-group float-label">
                <input type="text" class="form-control form-control-user <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" id="email" name="email" placeholder="" value="">
                <label class="form-control-label">Email Baru</label>
                <div class="invalid-feedback"><?= $validation->getError('email'); ?></div>
            </div>

            <button type="submit" class="btn btn-lg btn-default btn-block btn-rounded shadow"><span>Update Email</span></button>
        </form>
    </div>
</div>

<!-- <script>
    function previewImg() {
        const profil = document.querySelector('#profil');
        const imgprofil = document.querySelector('.img-preview');
        const profilLabel = document.querySelector('.float-file');

        profilLabel.textContent = profil.files[0].name;
        const fileProfil = new FileReader();

        fileProfil.readAsDataURL(profil.files[0]);

        fileProfil.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }
</script> -->


<?= $this->endSection('content'); ?>
<?= $this->extend('layout/auth_template'); ?>

<?= $this->section('auth'); ?>


<!-- Outer Row -->
<div class="row justify-content-center">

    <!-- <div class="col-xl-10 col-lg-12 col-md-9"> -->
    <div class="col-lg-7">

        <!-- Nested Row within Card Body -->
        <div class="row">
            <!-- <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> -->
            <div class="col-lg">
                <img src="/img/IG.png" class="logo" alt="">
                <div class="from-auth user">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Login!</h1>
                    </div>
                    <?php if (!empty(session()->getFlashdata('gagal'))) { ?>
                        <div class="alert alert-warning">
                            <?php echo session()->getFlashdata('gagal'); ?>
                        </div>
                    <?php } ?>

                    <!-- <form class="user"> -->
                    <div class="form-group user-form">
                        <img class="icon" src="/img/Vector.png" alt="">
                        <input type="text" class="form-control form-control-user" style="padding-left: 50px;" id="username" name="username" placeholder="username" required>

                    </div>
                    <div class="form-group user-form">
                        <img class="icon" src="/img/Group 13.png" alt="">
                        <input type="password" class="form-control form-control-user" style="padding-left: 50px;" id="password" name="password" placeholder="Password" required>
                    </div>
                    <!-- <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember Me</label>
                                            </div>
                                        </div> -->
                    <button type="submit" class="btn btn-user btn-block">
                        Login
                    </button>
                    <p class="font-weight-normal text-right" style="margin-top: 16px;">Forget <strong class="text-primary">Password<strong></p>

                    <!-- <a href="index.html" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>
                                        <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                        </a> -->
                    <!-- </form> -->
                    <!-- <hr>
                    <div class="text-center">
                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                    </div> -->
                    <div class="text-center">
                        <a class="small" href="<?= base_url(); ?>/regis">Create an Account!</a>
                    </div>
                </div>
            </div>
        </div>


    </div>

</div>


<?= $this->endSection('auth'); ?>
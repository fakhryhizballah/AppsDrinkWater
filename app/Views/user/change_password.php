<?= $this->extend('layout/user_template'); ?>
<?= $this->section('content'); ?>

<div class="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4 mx-auto text-center">
                <h4 class="mt-5"><span class="font-weight-light">Change </span>Password</h4>
                <br>
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
            </div>
        </div>
    </div>
</div>

<?= $this->endSection('content'); ?>
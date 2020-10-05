<?= $this->extend('layout/user_template'); ?>
<?= $this->section('content'); ?>

<div class="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4 mx-auto text-center">
                <h4 class="mt-5"><span class="font-weight-light">Change </span>Password</h4>
                <form action="user/passwordupdate" method="post">
                    <div class="form-group float-label">
                        <input type="password" id="password1" name="password1" class="form-control form-control-lg" required>
                        <label class="form-control-label">Current Password</label>
                    </div>
                    <div class="form-group float-label">
                        <input type="password" id="password2" name="password2" class="form-control form-control-lg" required>
                        <label class="form-control-label">New Password</label>
                    </div>
                    <div class="form-group float-label">
                        <input type="password" id="password3" name="password3" class="form-control form-control-lg" required>
                        <label class="form-control-label">Confirm New Password</label>
                    </div>
                    <div class="row mt-4">
                        <div class="col">
                            <button type="submit" class="btn btn-lg btn-default btn-block btn-rounded shadow"><span>Update Password</span></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection('content'); ?>
<?= $this->extend('layout/admin_template'); ?>
<?= $this->section('admcontent'); ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="card mb-3" style="max-width: 540px;">
        <div class="row no-gutters">
            <!-- <div class="col-md-4">
                <img class="card-img" src="">
            </div> -->

            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">Fakhry</h5>
                    <p class="card-text">D1021181063</p>
                    <p class="card-text">gang</p>
                    <p class="card-text"><small class="text-muted">Member since </small></p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?= $this->endSection('admcontent'); ?>
<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="card fixed-top">
    <div class="row no-gutters">
        <div class="col-4">
            <a href="javascript:window.history.go(-1);">
                <img class="back" src="/img/back.png" alt="">
            </a>
        </div>
        <div class="col-8">
            <h5 class="h5-navbar"><?= $page; ?></h5>
        </div>
    </div>
</div>

<?= $this->renderSection('MainBack'); ?>
<?= $this->endSection('content'); ?>
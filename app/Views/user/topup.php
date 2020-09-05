<?= $this->extend('layout/user_template'); ?>
<?= $this->section('content'); ?>

<div class="container">

    <!-- page content here -->
    <h3 class="font-weight-light text-center mt-4">Affordable<br><span class="text-template">Pricing</span> and
        <span class="text-template">Plan</span></h3>
    <p class="text-secondary text-mute text-center mb-4">Experience the best of all the new chat box.</p>

    <div class="row">
        <form class="vocer" method="POST" action="user/vocer">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="form-group float-label ">
                    <input type="number" class="form-control" id="vocer" name="vocer" required="">
                    <label class="form-control-label">Masukan kode vocer</label>
                </div>
                <button type="submit" class="mb-2 btn btn-outline-primary btn-rounded">Top Up</button>
            </div>
        </form>
    </div>



    <div class="card shadow border-0 mb-3">
        <div class="card-body">
            <div class="row h-100">
                <div class="col-auto pr-0">
                    <div class="avatar avatar-60 no-shadow border-0">
                        <div class="overlay gradient-success"></div>
                        <i class="material-icons text-success md-36">person</i>
                    </div>
                </div>
                <div class="col">
                    <h3>Rp 2.000 <small class="text-mute text-secondary">Paket Harian</small></h3>
                    <ul class="list pl-4 my-3">
                        <li>1000mL</li>
                    </ul>
                    <form class="vocer" method="POST" action="/snap">
                        <input type="hidden" class="form-control" id="id" name="id" value="1000mL">
                        <input type="hidden" class="form-control" id="paket" name="paket" value="Paket Harian">
                        <input type="hidden" class="form-control" id="harga" name="harga" value="2000">
                        <button type="submit" class="mb-2 btn btn-outline-primary btn-rounded">Beli</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow border-0 mb-3">
        <div class="card-body">
            <div class="row h-100">
                <div class="col-auto pr-0">
                    <div class="avatar avatar-60 no-shadow border-0">
                        <div class="overlay gradient-danger"></div>
                        <i class="material-icons text-danger md-36">cloud</i>
                    </div>
                </div>
                <div class="col">
                    <h3>Rp 10.000 <small class="text-mute text-secondary">Paket Hemat</small></h3>
                    <ul class="list pl-4 my-3">
                        <li>5200mL</li>
                    </ul>
                    <button type="button" class="mb-2 btn btn-outline-primary btn-rounded">Beli</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow border-0 mb-3">
        <div class="card-body">
            <div class="row h-100">
                <div class="col-auto pr-0">
                    <div class="avatar avatar-60 no-shadow border-0">
                        <div class="overlay gradient-info"></div>
                        <i class="material-icons text-info md-36">airplanemode_active</i>
                    </div>
                </div>
                <div class="col">
                    <h3>Rp 25.000 <small class="text-mute text-secondary">Paket Besar</small></h3>
                    <ul class="list pl-4 my-3">
                        <li>15000mL</li>
                        <li>cocok untuk stasiun di kantor</li>
                    </ul>
                    <button type="button" class="mb-2 btn btn-outline-primary btn-rounded">Beli</button>
                </div>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection('content'); ?>
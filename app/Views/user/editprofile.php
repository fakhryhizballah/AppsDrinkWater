<?= $this->extend('layout/user_template'); ?>
<?= $this->section('content'); ?>

<!-- Loader -->
<div class="row no-gutters vh-100 loader-screen">
    <div class="col align-self-center text-white text-center">
        <img src="img/logo.png" alt="logo">
        <h1 class="mt-3"><span class="font-weight-light ">Fi</span>mobile</h1>
        <p class="text-mute text-uppercase small">Mobile Template</p>
        <div class="laoderhorizontal">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
</div>
<!-- Loader ends -->

<div class="wrapper">
    <div class="header">
        <div class="row no-gutters">
            <div class="col-auto">
                <a href="javascript:void(0)" onClick="javascript:history.go(-1)" class="btn  btn-link text-dark"><i class="material-icons">navigate_before</i></a>
            </div>
            <div class="col text-center"><img src="img/logo-header.png" alt="" class="header-logo"></div>
            <div class="col-auto">
                <a href="profile.html" class="btn  btn-link text-dark"><i class="material-icons">account_circle</i></a>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="text-center">
            <div class="figure-profile shadow my-4">
                <figure><img src="img/user1.png" alt=""></figure>
                <div class="btn btn-dark text-white floating-btn">
                    <i class="material-icons">camera_alt</i>
                    <input type="file" class="float-file">
                </div>
            </div>
        </div>

        <h6 class="subtitle">Basic Information</h6>
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="form-group float-label active">
                    <input type="text" class="form-control" required="" value="Angelina Johnson">
                    <label class="form-control-label">Name</label>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group float-label active">
                    <input type="email" class="form-control" required="" value="angelinaJohnson@maxartkiller.com">
                    <label class="form-control-label">Email address</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="form-group float-label active mb-0">
                    <input type="tel" class="form-control" required="" value="55 5555 555555 55">
                    <label class="form-control-label">Phone Number</label>
                </div>
            </div>
        </div>

        <h6 class="subtitle">Address</h6>

        <div class="row">
            <div class="col-12 col-md-6">
                <div class="form-group float-label active">
                    <input type="text" class="form-control" required="" value="58, Lajpat Nagar">
                    <label class="form-control-label">Address line 1</label>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group float-label active">
                    <input type="text" class="form-control" value="Holand Street four">
                    <label class="form-control-label">Address line 2</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group float-label active">
                    <input type="tel" class="form-control" required="" value="Sydney">
                    <label class="form-control-label">City</label>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group float-label active">
                    <input type="tel" class="form-control" required="" value="25468">
                    <label class="form-control-label">Pin Code</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="form-group float-label active">
                    <select class="form-control">
                        <option>Australia</option>
                        <option>America</option>
                        <option>Africa</option>
                        <option>France</option>
                    </select>
                    <label class="form-control-label">Country</label>
                </div>
            </div>
        </div>


        <a href="profile-edit.html" class="btn btn-lg btn-default text-white btn-block btn-rounded shadow"><span>Submit</span></a>
        <br>
    </div>

    <!-- footer-->
    <div class="footer">
        <div class="no-gutters">
            <div class="col-auto mx-auto">
                <div class="row no-gutters justify-content-center">
                    <div class="col-auto">
                        <a href="index.html" class="btn btn-link-default ">
                            <i class="material-icons">home</i>
                        </a>
                    </div>
                    <div class="col-auto">
                        <a href="statistics.html" class="btn btn-link-default">
                            <i class="material-icons">insert_chart_outline</i>
                        </a>
                    </div>
                    <div class="col-auto">
                        <a href="wallet.html" class="btn btn-link-default">
                            <i class="material-icons">account_balance_wallet</i>
                        </a>
                    </div>
                    <div class="col-auto">
                        <a href="transactions.html" class="btn btn-link-default">
                            <i class="material-icons">widgets</i>
                        </a>
                    </div>
                    <div class="col-auto">
                        <a href="profile.html" class="btn btn-link-default">
                            <i class="material-icons">account_circle</i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer ends-->
</div>



<!-- color chooser menu start -->
<div class="modal fade " id="colorscheme" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content ">
            <div class="modal-header theme-header border-0">
                <h6 class="">Color Picker</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pt-0">
                <div class="text-center theme-color">
                    <button class="m-1 btn red-theme-bg text-white btn-rounded-54 shadow-sm" data-theme="red-theme"><i class="material-icons w-50">color_lens_outline</i></button>
                    <button class="m-1 btn blue-theme-bg text-white btn-rounded-54 shadow-sm" data-theme="blue-theme"><i class="material-icons w-50">color_lens_outline</i></button>
                    <button class="m-1 btn yellow-theme-bg text-white btn-rounded-54 shadow-sm" data-theme="yellow-theme"><i class="material-icons w-50">color_lens_outline</i></button>
                    <button class="m-1 btn green-theme-bg text-white btn-rounded-54 shadow-sm" data-theme="green-theme"><i class="material-icons w-50">color_lens_outline</i></button>
                    <button class="m-1 btn pink-theme-bg text-white btn-rounded-54 shadow-sm" data-theme="pink-theme"><i class="material-icons w-50">color_lens_outline</i></button>
                    <button class="m-1 btn orange-theme-bg text-white btn-rounded-54 shadow-sm" data-theme="orange-theme"><i class="material-icons w-50">color_lens_outline</i></button>
                    <button class="m-1 btn purple-theme-bg text-white btn-rounded-54 shadow-sm" data-theme="purple-theme"><i class="material-icons w-50">color_lens_outline</i></button>
                    <button class="m-1 btn deeppurple-theme-bg text-white btn-rounded-54 shadow-sm" data-theme="deeppurple-theme"><i class="material-icons w-50">color_lens_outline</i></button>
                    <button class="m-1 btn lightblue-theme-bg text-white btn-rounded-54 shadow-sm" data-theme="lightblue-theme"><i class="material-icons w-50">color_lens_outline</i></button>
                    <button class="m-1 btn teal-theme-bg text-white btn-rounded-54 shadow-sm" data-theme="teal-theme"><i class="material-icons w-50">color_lens_outline</i></button>
                    <button class="m-1 btn lime-theme-bg text-white btn-rounded-54 shadow-sm" data-theme="lime-theme"><i class="material-icons w-50">color_lens_outline</i></button>
                    <button class="m-1 btn deeporange-theme-bg text-white btn-rounded-54 shadow-sm" data-theme="deeporange-theme"><i class="material-icons w-50">color_lens_outline</i></button>
                    <button class="m-1 btn gray-theme-bg text-white btn-rounded-54 shadow-sm" data-theme="gray-theme"><i class="material-icons w-50">color_lens_outline</i></button>
                    <button class="m-1 btn black-theme-bg text-white btn-rounded-54 shadow-sm" data-theme="black-theme"><i class="material-icons w-50">color_lens_outline</i></button>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-6 text-left">
                    <div class="row">
                        <div class="col-auto text-right align-self-center"><i class="material-icons text-warning vm">wb_sunny</i></div>
                        <div class="col-auto text-center align-self-center px-0">
                            <div class="custom-control custom-switch float-right">
                                <input type="checkbox" name="themelayout" class="custom-control-input" id="theme-dark">
                                <label class="custom-control-label" for="theme-dark"></label>
                            </div>
                        </div>
                        <div class="col-auto text-left align-self-center"><i class="material-icons text-dark vm">brightness_2</i></div>
                    </div>
                </div>
                <div class="col-6 text-right">
                    <div class="row">
                        <div class="col-auto text-right align-self-center">LTR</div>
                        <div class="col-auto text-center align-self-center px-0">
                            <div class="custom-control custom-switch float-right">
                                <input type="checkbox" name="rtllayout" class="custom-control-input" id="theme-rtl">
                                <label class="custom-control-label" for="theme-rtl"></label>
                            </div>
                        </div>
                        <div class="col-auto text-left align-self-center">RTL</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- color chooser menu ends -->

<?= $this->endSection('content'); ?>
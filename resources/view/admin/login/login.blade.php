<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <!-- App Favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- App title -->
    <title>صفحه ورود</title>

    <!-- App CSS -->
    <link href="<?= asset('panel/assets/css/bootstrap-rtl.min.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= asset('panel/assets/css/core.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= asset('panel/assets/css/components.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= asset('panel/assets/css/icons.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= asset('panel/assets/css/pages.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= asset('panel/assets/css/menu.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= asset('panel/assets/css/responsive.css') ?>" rel="stylesheet" type="text/css" />

    <script src="<?= asset('panel/assets/js/modernizr.min.js') ?>"></script>

</head>

<body>

    <div class="account-pages"></div>
    <div class="clearfix"></div>
    <div class="wrapper-page">
        <div class="text-center">
            <a href="<?= route('admin.index') ?>" class="logo"><span> پنل مدیریت<span>لرنیت</span></span></a>
        </div>
        <div class="m-t-40 card-box">
            <div class="text-center">
                <h4 class="text-uppercase font-bold m-b-0">ورود</h4>
            </div>
            <div class="panel-body">
                <form class="form-horizontal m-t-20" action="<?= route('auth.login') ?>" method="post">
                    <?= errorText('active') ?>
                    <?= errorText('exist') ?>
                    <?= errorText('login') ?>
                    <?= flashText('register') ?>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control <?= errorClass('email') ?>" type="text" name="email" value="<?= oldOrCookie('email') ?>" required="" placeholder="ایمیل">
                            <?= errorText('email') ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control <?= errorClass('password') ?>" type="password" name="password" value="<?= oldOrCookie('password') ?>" required="" placeholder="پسورد">
                            <?= errorText('password') ?>
                        </div>
                    </div>

                    <div class="form-group ">
                        <div class="col-xs-12">
                            <div class="checkbox checkbox-custom">
                                <input id="checkbox-signup" name="remember" value="ok" type="checkbox">
                                <label for="checkbox-signup">
                                    مرا به خاطر بسپار
                                </label>
                            </div>

                        </div>
                    </div>

                    <div class="form-group text-center m-t-30">
                        <div class="col-xs-12">
                            <button class="btn btn-custom btn-bordred btn-block waves-effect waves-light" type="submit">ورود</button>
                        </div>
                    </div>

                    <div class="form-group m-t-30 m-b-0">
                        <div class="col-sm-12">
                            <a href="<?= route('auth.forgot.password') ?>" class="text-muted"><i class="fa fa-lock m-r-5"></i> آیا رمز خود را فراموش کرده اید؟</a>
                        </div>
                    </div>
                </form>

            </div>
        </div>
        <!-- end card-box-->

        <div class="row">
            <div class="col-sm-12 text-center">
                <p class="text-muted">حساب کاربری ندارید? <a href="<?= route('auth.register.admin.view') ?>" class="text-primary m-l-5"><b>ثبت نام</b></a></p>
            </div>
        </div>

    </div>
    <!-- end wrapper page -->

</body>

</html>
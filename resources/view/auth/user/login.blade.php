@extends('home.layouts.app')

@section('head-tag')
<title>ورود</title>
@endsection

@section('content')
<!-- Login Page Section -->
<div class="page-login">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 offset-lg-4">
                <div class="base-login shadow-sm">
                    <h3 class="mb-3">وارد حساب کاربری خود شوید!</h3>
                    <form action="<?= route('auth.login') ?>" method="post">
                        <?= errorText('active') ?>
                        <?= errorText('exist') ?>
                        <?= errorText('login') ?>
                        <?= flashText('register') ?>
                        <?= flashText('activation') ?>
                        <div class="form-group">
                            <input type="email" name="email" value="<?= oldOrCookie('email') ?>" class="form-control <?= errorClass('email') ?>" placeholder="ایمیل شما...">
                            <?= errorText('email') ?>
                        </div>
                        <div class="form-group mb-0">
                            <input type="password" name="password" value="<?= oldOrCookie('password') ?>" class="form-control <?= errorClass('password') ?>" placeholder="کلمه عبور...">
                            <?= errorText('password') ?>
                        </div>
                        <div class="login-footer">
                            <label class="check-box">
                                <span>مرا به خاطر بسپار</span>
                                <input type="checkbox" name="remember" value="ok"> <span class="checkmark"></span>
                            </label>
                            <span class="float-left"><a href="<?= route('auth.forgot') ?>">رمز عبور را فراموش کرده اید؟</a></span>
                        </div>
                        <div class="btn-login">
                            <button class="btn btn-fill-primary d-block w-100">ورود</button>
                        </div>
                    </form>
                    <hr>
                    <p>حساب کاربری ندارید؟ <a href="<?= route('auth.register.view') ?>">ثبت نام کنید</a></p>
                </div>
            </div>
        </div>
    </div>
    <div class="area">
        <ul class="circles">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div>
</div>
<!-- End Login Page Section -->
@endsection
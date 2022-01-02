@extends('home.layouts.app')

@section('head-tag')
<title>تغیر رمز عبور</title>
<link rel="stylesheet" href="<?= asset('app/css/user.css') ?>">
@endsection

@section('content')
<div class="container">
    <div class="row">

        <div class="col-lg-3">
            <div class="user_info">
                <div class="user_profile">
                    <img src="<?= asset($user->avatar) ?>" alt="">
                </div>
                <h1><?= $user->first_name . ' ' . $user->last_name ?></h1>
                <div class="user_utiliti">
                    <ul>
                        <li>
                            <a href="<?= route('home.user.show') ?>">داشبورد</a>
                        </li>
                        <?php if ($user->user_type == 'admin') { ?>
                            <li>
                                <a href="<?= route('admin.index') ?>">پنل ادمین</a>
                            </li>
                        <?php  } ?>
                        <li>
                            <a href="<?= route('home.user.change.password.show') ?>">تغییر رمز عبور</a>
                        </li>
                        <li>
                            <a href="<?= route('home.user.change.profile.show') ?>">تغییر عکس پروفایل</a>
                        </li>
                        <li>
                            <a href="<?= route('home.user.cart' , ['id' , $user->id]) ?>">صورت حساب ها</a>
                        </li>
                        <li>
                            <a href="<?= route('auth.logout') ?>">خروج از حساب کاربری</a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>

        <div class="col-lg-9">
            <div class="information_account box_shadow mb-4">
                <header>
                    <h2>تغییر رمز عبور</h2>
                </header>
                <div class="inner">
                    <div class="row">
                        <form action="<?= route('home.user.change.password' , ['id' => $user->id]) ?>" method="post" class="w-100 d-flex flex-wrap">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="input-layer">
                                    <label>
                                        <i class="fas fa-lock"></i>
                                        رمز عبور فعلی
                                    </label>
                                    <input type="password" name="old_password" class="<?= errorClass('old_password') ?>">
                                    <?= errorText('old_password') ?>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="input-layer">
                                    <label>
                                        <i class="fas fa-lock"></i>
                                        رمز عبور جدید
                                    </label>
                                    <input type="text" type="password" name="password" class="<?= errorClass('password') ?>" value="<?= old('password') ?>">
                                    <?= errorText('password') ?>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="input-layer">
                                    <label>
                                        <i class="fas fa-lock"></i>
                                        تکرار رمز عبور جدید
                                    </label>
                                    <input type="text" name="confirm_password" class="<?= errorClass('confirm_password') ?>" value="<?= old('confirm_password') ?>">
                                    <?= errorText('confirm_password') ?>
                                </div>
                            </div>

                            <div class="col-12 text-left">
                                <button class="btn btn-success" type="submit">
                                    ثبت رمز عبور
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
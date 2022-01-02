@extends('home.layouts.app')

@section('head-tag')
<title>اطلاعات کاربر</title>
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
                            <a href="<?= route('home.user.cart', ['id', $user->id]) ?>">صورت حساب ها</a>
                        </li>
                        <li>
                            <a href="<?= route('auth.logout') ?>">خروج از حساب کاربری</a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>

        <div class="col-lg-9">

            <div class="information_account box_shadow">
                <header>
                    <h2>لیست پرداخت های شما </h2>
                </header>
                <div class="inner">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <?php foreach ($purchases as $purchase) { ?>
                                <div class="input-layer">
                                    <label class="d-flex justify-content-between align-items-center">
                                        <i class="fas fa-money-bill-alt" style="color: #61b832;"></i>
                                        <span> تاریخ پرداخت: <?= \Morilog\Jalali\Jalalian::forge($purchase->created_at)->format('%d %B. %Y') ?></span>
                                        <span>مبلغ: <?= $purchase->price ?></span>
                                    </label>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
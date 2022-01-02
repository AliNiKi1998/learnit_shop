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
                    <h2>اطلاعات حساب کاربری</h2>
                </header>
                <div class="inner">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="input-layer">
                                <label>
                                    <i class="fas fa-user"></i>
                                    نام و نام خاموادگی : <?= $user->first_name . ' ' . $user->last_name ?>
                                </label>
                            </div>
                            <div class="input-layer">
                                <label>
                                    <i class="fas fa-envelope"></i>
                                    ایمیل : <?= $user->email ?>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="information_account box_shadow">
                <header>
                    <h2>لیست دوره های شما</h2>
                </header>
                <div class="inner">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <?php foreach ($allCourse as $course) { ?>
                                <div class="input-layer">
                                    <label>
                                        <i class="fas fa-folder-open"></i>
                                        اسم دوره: <a href="<?= route('home.course.show', ['id' => $course->id]) ?>"><?= $course->name ?></a>
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
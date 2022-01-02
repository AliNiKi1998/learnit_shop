@extends('home.layouts.app')

@section('head-tag')
<title>بازیابی رمز</title>
@endsection

@section('content')
<!-- Login Page Section -->
<div class="page-login">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 offset-lg-4">
                <div class="base-login shadow-sm">
                    <h3 class="mb-3">بازیابی رمز عبور</h3>
                    <form action="<?= route('auth.professor.reset-password', [$token]) ?>" method="post">
                        <?= errorText('reset_password') ?>
                        <div class="form-group">
                            <input type="password" name="password" value="<?= old('password') ?>" class="form-control <?= errorClass('password') ?>" placeholder="پسورد جدید">
                            <?= errorText('password') ?>
                        </div>
                        <div class="form-group">
                            <input type="password" name="new_password" value="<?= old('new_password') ?>" class="form-control <?= errorClass('new_password') ?>" placeholder="تکرار پسورد جدید">
                            <?= errorText('new_password') ?>
                        </div>
                        <div class="btn-login">
                            <button class="btn btn-fill-primary d-block w-100">بازیابی رمز</button>
                        </div>
                    </form>
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
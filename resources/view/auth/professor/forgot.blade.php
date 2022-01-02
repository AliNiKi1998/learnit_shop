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
                    <form action="<?= route('auth.professor.forgot') ?>" method="post">
                        <?= errorText('forgot') ?>
                        <?= flashText('reset_password') ?>
                        <div class="form-group">
                            <input type="email" name="email" value="<?= old('email') ?>" class="form-control <?= errorClass('email') ?>" placeholder="ایمیل شما...">
                            <?= errorText('email') ?>
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
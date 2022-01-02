@extends('home.layouts.app')

@section('head-tag')
<title>سبد خرید</title>
<style>
    .course_list {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 50px 20px;
        flex-wrap: wrap;
    }

    .course_item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        padding: 20px 20px;
        border-radius: 5px;
        -moz-border-radius: 5px;
        -webkit-border-radius: 5px;
        box-shadow: 0 0 7px 0 #eaeff4;
        -moz-box-shadow: 0 0 7px 0 #eaeff4;
        -webkit-box-shadow: 0 0 7px 0 #eaeff4;
        border: 1px solid #ecf0f4;
        background-color: #fff;
        margin-bottom: 20px;
    }

    .course_item_right a {
        display: block;
        color: #686e71;
    }

    .course_item_right span,
    .price_int {
        display: block;
        color: limegreen;
    }

    .course_item_left a button {
        font-size: 15px;
        color: white;
        line-height: unset;
        padding: 7px 32px;
    }

    .cart_main {
        padding: 50px 10px;
    }

    .cart_total {
        width: 100%;
        padding: 20px 20px;
        border-radius: 5px;
        -moz-border-radius: 5px;
        -webkit-border-radius: 5px;
        box-shadow: 0 0 7px 0 #eaeff4;
        -moz-box-shadow: 0 0 7px 0 #eaeff4;
        -webkit-box-shadow: 0 0 7px 0 #eaeff4;
        border: 1px solid #ecf0f4;
        background-color: #fff;
        margin-bottom: 20px;
        text-align: center;
    }

    .cart_total button {
        display: block;
        width: 100%;
        line-height: unset;
        border-color: #61B832;
        padding: 7px 32px;
    }

    .cart_total button:hover {
        background-color: #61B832 !important;
        border-color: #61B832;
    }

    .btn-green {
        background-color: #61B832 !important;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <div class="course_list">
                <?php
                $sum = 0;
                foreach ($courses as $course) {
                    $sum += $course->course()->price;
                ?>
                    <div class="course_item">

                        <div class="course_item_right">
                            <a href="<?= route('home.course.show', ['id' => $course->course()->id]) ?>"><?= $course->course()->name ?></a>
                            <div class="d-flex">
                                <span class="cart_price"><?= number_format($course->course()->price) ?></span>
                                <span class="mr-1"> تومان </span>
                            </div>
                        </div>

                        <div class="course_item_left">
                            <a href="<?= route('home.cart.remove', ['id' => $course->id]) ?>" onclick="return confirm('دوره <?= $course->course()->name ?> از سبد حذف شود؟')">
                                <button class="btn btn-warning">حذف</button>
                            </a>
                        </div>

                    </div>
                <?php
                } ?>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="cart_main">
                <div class="cart_total">
                    <div class="d-flex align-items-center justify-content-between">

                        <span>
                            مبلغ کل :
                        </span>

                        <span class="price_int">
                            <?= number_format($sum) ?> 
                            تومان
                        </span>

                    </div>
                    <div class="price my-3">
                        مبلغ قابل پرداخت : <?= number_format($sum) ?> تومان
                    </div>
                    <form action="<?= route('user.payment.request' , [$sum]) ?>" method="get">
                        <button class="btn btn-block btn-success btn-green">
                            ثبت و پرداخت نهایی
                        </button>
                    </form>
                    <?= errorText('amount_invalid') ?>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('home.layouts.app')

@section('head-tag')
<title>لیست دوره ها</title>
@endsection()
@section('content')
<!-- List Courses Section -->
<div class="list-courses-section">
    <div class="title-page text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4>لیست دور ها</h4>
                    <hr class="line-title">
                    <?= errorText('not_login') ?>
                    <?= errorText('already_exist') ?>
                </div>
            </div>
        </div>
    </div>
    <div class="gr-card-courses-list">
        <div class="container">
            <div class="row">
                <?php foreach (paginate($courses, 10) as $course) { ?>

                    <div class="col-lg-6">
                        <div class="card card-courses-list border-0 shadow-sm">
                            <div class="row no-gutters">
                                <div class="col-md-5 col-lg-5">
                                    <div class="images-card-courses">
                                        <img src="<?= asset($course->image['small']) ?>" class="card-img-top img-fluid" alt="...">
                                    </div>
                                </div>
                                <div class="col-md-7 col-lg-7">
                                    <div class="content-card-courses px-3 py-3">
                                        <a href="<?= route('home.course.show', ['id' => $course->id]) ?>" class="text_dark "><span class="name-courses"><?= $course->name ?></span></a>
                                        <span class="teacher-courses mb-2"><?= $course->professor()->first_name . ' ' . $course->professor()->last_name ?></span>

                                        <div class="price-courses mt-1 mb-2">
                                            <?php
                                            $comments =  $course->score()->where('approved', 1)->whereNull('parent_id')->get();

                                            $scores = [];
                                            foreach ($comments as $comment) {
                                                array_push($scores, $comment->score);
                                            }
                                            $scoreCount = count($scores);
                                            $score = 0;
                                            $scoreSum = array_sum($scores);
                                            if ($scoreSum != 0) {
                                                $score = ($scoreSum / $scoreCount);
                                            }
                                            $score = substr($score, 0, 3);
                                            ?>
                                            <span class="rank-courses">
                                                <?= $score ?>
                                                <?php
                                                for ($x = round($score); $x > 0; $x--) {
                                                ?>
                                                    <i class="fas fa-star"></i>
                                                <?php  } ?>
                                                <b>(<?= $scoreCount ?>)</b>
                                            </span>

                                            <span class="price-main"><?= $course->price == 0 ? 'رایگان' : number_format($course->price) . ' تومان' ?> </span>

                                        </div>

                                        <form action="<?= route('home.cart.add', ['course_id' => $course->id]) ?>" method="post">
                                            <button type="submit" class="btn btn-fill-secondary float-left">ثبت دوره</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php  } ?>
                <div class="blog-pagination">
                    <?= paginateView($courses, 10) ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Upcoming Events Section -->
<!-- Newsletter Now Section -->
<div class="new-letter">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="content-new-letter">
                    <div class="media">
                        <div class="icon-new-letter align-self-center ml-3"> <i class="fas fa-envelope-open-text"></i> </div>
                        <div class="media-body">
                            <h3 class="mt-0 mb-1">اکنون به خبرنامه ما بپیوندید</h3>
                            <p>برای دریافت به روزرسانی در تبلیغات ، اکنون ثبت نام کنید.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="subscribe-form">
                    <form action="<?= route('news.latter') ?>" method="POST">
                        <div class="form-group form-subscribe-email">
                            <input type="email" name="email" required="" placeholder="ایمیل خود را وارد کنید" class="form-control">
                            <?= errorText('email') ?>
                            <button type="submit" class="btn-email">اشتراک</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- End Newsletter Now Section -->
@endsection
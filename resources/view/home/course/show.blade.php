@extends('home.layouts.app')

@section('head-tag')
<title>دوره <?= $course->name ?></title>
@endsection

@section('content')
<!-- Courses Detail Section -->
<?= errorText('user_comment') ?>
<div class="courses-detail">
    <div class="container">
        <?= errorText('comment') ?>
        <div class="base-courses-detail">
            <div class="row">
                <div class="col-lg-8">
                    <div class="content-courses-detail">
                        <h2 class="font-weight-bold"><?= $course->name ?></h2>
                        <div class="block-info-content mt-4">
                            <ul>
                                <li>
                                    <div class="instructor">
                                        <img src="<?= asset($course->professor()->image['small']) ?>" class="img-fluid" alt="">
                                        <div class="mr-3 instructor_info">
                                            <h4>استاد</h4>
                                            <p><?= $course->professor()->first_name . ' ' . $course->professor()->last_name ?></p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="course_rating">
                                        <h4>امتیاز</h4>
                                        <div class="rating_stars">
                                            <?php
                                            for ($x = round($score); $x > 0; $x--) {
                                            ?>
                                                <i class="fas fa-star"></i>
                                            <?php  } ?>
                                            <span><?= $score ?></span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="course_student">
                                        <h4>دانشجویان</h4>
                                        <span><?= count($course->students()->whereNotNull('payment_code')->get()) ?></span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <img src="<?= asset($course->image['big']) ?>" class="img-fluid mt-4" alt="">
                        <h3 class="my-3 mb-2">توضیحات دوره</h3>

                        <div>
                            <?= html_entity_decode($course->description) ?>
                        </div>

                        <h3 class="my-3">ویدیو ها</h3>
                        <div class="courses-contents">
                            <div class="accordion courses-content-list" id="list-contents">

                                <div class="card">
                                    <div class="card-header">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#row-list-contents1" aria-expanded="false">
                                                لیست ویدیو ها <span><?= count($videos) ?> ویدیو</span>
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="row-list-contents1" class="collapse" data-parent="#list-contents">
                                        <div class="card-body">

                                            <ul class="list-unstyled">
                                                <?php

                                                foreach ($videos as $video) { ?>
                                                    <li class="d-flex justify-content-between">
                                                        <div>
                                                            <i class="fas fa-play-circle"></i>
                                                            <?= $video->name ?>
                                                            <span><?= convertToHoursMins($video->time, '%02d ساعت و %02d دقیقه') ?></span>
                                                        </div>
                                                        <div class="link">

                                                            <?php
                                                            if ($permision) {
                                                                if ($video->course_id == @$permision[0]->course_id || $video->professor_id == $permision[0]->id) {
                                                            ?>
                                                                    <a href="<?= route('home.course.video.download', ['id' => $video->id]) ?>" target="_blanck">
                                                                        <i class="fas fa-download text-success"></i>
                                                                    </a>
                                                                <?php }
                                                            } else { ?>
                                                                <i class="fas fa-download text-success" onclick="alert('شما مجاز به دانلود نمی باشید!!!')"></i>
                                                            <?php } ?>
                                                        </div>
                                                    </li>
                                                <?php  } ?>
                                            </ul>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <h3 class="mb-3 mt-4">درباره استاد</h3>
                        <div class="author-single-courses py-4 px-4 shadow-sm">
                            <div class="media">
                                <img src="<?= asset($course->professor()->image['small']) ?>" class="align-self-start ml-3 img-fluid" alt="...">
                                <div class="media-body">
                                    <h3 class="title-author-name"><?= $course->professor()->first_name . ' ' . $course->professor()->last_name ?></h3>
                                    <div class="group-icon-social">

                                        <a href="<?= $course->professor()->facebook ?>"><i class="fab fa-facebook-f"></i></a>

                                        <a href="<?= $course->professor()->telegram ?>"><i class="fab fa-telegram-plane"></i></a>

                                        <a href="<?= $course->professor()->instagram ?>"><i class="fab fa-instagram"></i></a>

                                    </div>

                                    <p><?= $course->professor()->description ?></p>

                                </div>
                            </div>
                        </div>


                        <h3 class="mb-3 mt-4">نظرات</h3>
                        <div class="users-comment">
                            <?php foreach ($comments as $comment) { ?>
                                <div class="media border-top pt-4">
                                    <img src="<?= asset($comment->user()->avatar) ?>" class="align-self-start ml-3" alt="..." style="border-radius: 50%;">
                                    <div class="media-body">
                                        <span class="name-comment"><?= $comment->user()->first_name . ' ' . $comment->user()->last_name ?></span>
                                        <span class="repply-comment float-left" onclick="answerView('<?= $comment->id ?>')"><i class="fas fa-reply-all"></i>پاسخ</span>

                                        <p class="times-comment"><?= \Morilog\Jalali\Jalalian::forge($comment->created_at)->format('%d %B. %Y') ?></p>
                                        <p><?= $comment->comment ?></p>

                                        <?php if (\System\Auth\Auth::checkLogin() || @$permision[0]->id == $course->professor_id) { ?>
                                            <form id="answer<?= $comment->id ?>" action="<?= route('home.comment.answer', [$comment->id]) ?>" method="post" class="d-none">
                                                <div class="write-comment mt-3">

                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <label for="">حداقل 10 کاراکتر</label>
                                                            <textarea placeholder="نظر شما" name="comment"></textarea>
                                                        </div>

                                                        <div class="col-lg-12">
                                                            <div class="btn-comment">
                                                                <button type="submit" class="btn btn-fill-primary">ارسال</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        <?php } else { ?>
                                            <div id="answer<?= $comment->id ?>" class="d-none">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <p class="text-info" style="font-size:20px">برای ثبت نظر وارد حساب خود شوید
                                                    </p>
                                                    <a href="<?= route('auth.login.view') ?>" class="btn btn-success ">ورود</a>
                                                    <a href="<?= route('auth.register.view') ?>" class="btn btn-dark">ثبت نام</a>
                                                </div>
                                            </div>
                                        <?php  } ?>

                                    </div>
                                </div>
                                <?php
                                $childComments = $comment->child()->where('approved', 1)->get();
                                if (!empty($childComments)) {
                                    foreach ($childComments as $childComment) {
                                ?>
                                        <div class="media child-comment border-top pt-4 my-4">
                                            <img src="<?= @asset($childComment->user()->avatar) . @$childComment->professor()->image['small']  ?>" class="align-self-start ml-3" alt="..." style="border-radius: 50%;">
                                            <div class="media-body">
                                                <span class="name-comment"><?= @$childComment->user()->first_name . ' ' . @$childComment->user()->last_name . @$childComment->professor()->first_name . ' ' . @$childComment->professor()->last_name  ?></span>
                                                <p class="times-comment"><?= \Morilog\Jalali\Jalalian::forge($childComment->created_at)->format('%d %B. %Y') ?></p>
                                                <p><?= $childComment->comment ?></p>

                                            </div>
                                        </div>

                            <?php  }
                                }
                            } ?>
                        </div>

                        <?php if (\System\Auth\Auth::checkLogin()) { ?>
                            <h3 class="mb-3 mt-4">ارسال نظرات</h3>
                            <form action="<?= route('home.comment.add', [$course->id]) ?>" method="post">
                                <div class="star_rating">
                                    <span data-value="1" class="selected"><i class="far fa-star"></i></span>
                                    <span data-value="2"><i class="far fa-star"></i></span>
                                    <span data-value="3"><i class="far fa-star"></i></span>
                                    <span data-value="4"><i class="far fa-star"></i></span>
                                    <span data-value="5"><i class="far fa-star"></i></span>
                                </div>
                                <?= errorText('score') ?>
                                <input id="score" type="hidden" name="score" value="1">

                                <div class="write-comment mt-3">

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label for="">حداقل 10 کاراکتر</label>
                                            <textarea placeholder="نظر شما" name="comment"></textarea>

                                        </div>

                                        <div class="col-lg-12">
                                            <div class="btn-comment">
                                                <button type="submit" class="btn btn-fill-primary">ارسال</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        <?php } else { ?>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="text-info" style="font-size:20px">برای ثبت نظر وارد حساب خود شوید
                                </p>
                                <a href="<?= route('auth.login.view') ?>" class="btn btn-success ">ورود</a>
                                <a href="<?= route('auth.register.view') ?>" class="btn btn-dark">ثبت نام</a>
                            </div>
                        <?php  } ?>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="side-bar shadow-sm">

                        <div class="widget">
                            <div class="title-widget mb-3">
                                <h4>جزئیات دوره</h4>
                            </div>
                            <div class="content-widget event-detail-widget">
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-calendar-alt"></i><b>تاریخ شروع:</b> <?= \Morilog\Jalali\Jalalian::forge($course->created_at)->format('%d %B. %Y') ?> </li>
                                    <li><i class="fas fa-clock"></i><b>زمان دوره:</b> <?= convertToHoursMins($course->time, '%02d ساعت و %02d دقیقه') ?></li>
                                    <li><i class="fas fa-user"></i><b>استاد:</b> <?= $course->professor()->first_name . ' ' .  $course->professor()->last_name ?></li>
                                    <li><i class="fas fa-envelope"></i><b>ایمیل:</b> <?= $course->professor()->email ?></li>
                                    <li><i class="fas fa-circle"></i><b>قیمت:</b> <?= number_format($course->price) ?> تومان</li>
                                </ul>
                                <?php
                                if ($permision) {
                                    if ($course->id == @$permision[0]->course_id) {
                                ?>
                                        <span class="btn btn-success d-block text-center">این دوره را خریده اید</span>
                                    <?php
                                    }
                                    ?>

                                <?php

                                } else { ?>
                                    <form action="<?= route('home.cart.add', [$course->id]) ?>" method="post">
                                        <button type="submit" class="btn btn-fill-primary d-block w-100">
                                            ثبت نام دوره
                                        </button>
                                    </form>
                                <?php  }

                                echo errorText('already_exist');
                                ?>
                            </div>

                        </div>

                        <div class="widget">
                            <div class="title-widget mb-3">
                                <h4>تگ ها</h4>
                            </div>
                            <div class="content-widget tags">
                                <?php
                                $tags = explode(',', $course->tags);
                                foreach ($tags as $tag) {
                                ?>
                                    <a href="<?= currentDomain() . '/search?searchTag=' . $tag ?>" class="btn-tags"><?= $tag ?></a>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="widget">
                            <div class="title-widget mb-3">
                                <h4>دوره های مرتبط</h4>
                            </div>
                            <?php foreach ($coursesLiked as $courseLiked) { ?>
                                <?php if ($courseLiked->id == $course->id) {
                                    continue;
                                } ?>
                                <div class="content-widget recent-courses">

                                    <div class="media my-3">
                                        <img src="<?= asset($courseLiked->image['small']) ?>" class="align-self-start ml-3" alt="..." style="width:80px; height:80px">
                                        <div class="media-body">
                                            <a href="<?= route('home.course.show', [$courseLiked->id]) ?>">
                                                <h5 class="mt-0"><?= $courseLiked->name ?></h5>
                                            </a>
                                            <h3 class="mt-2 font-weight-bold"><?= $courseLiked->price ?> تومان</h3>
                                        </div>
                                    </div>

                                </div>
                            <?php  } ?>
                        </div>

                        <div class="widget">
                            <div class="title-widget mb-3">
                                <h4>آخرین دوره ها</h4>
                            </div>
                            <?php foreach ($lastCourses as $lastCourse) { ?>
                                <div class="content-widget recent-courses">

                                    <div class="media my-3">
                                        <img src="<?= asset($lastCourse->image['small']) ?>" class="align-self-start ml-3" alt="..." style="width:80px; height:80px">
                                        <div class="media-body">
                                            <a href="<?= route('home.course.show', [$lastCourse->id]) ?>">
                                                <h5 class="mt-0"><?= $lastCourse->name ?></h5>
                                            </a>
                                            <h3 class="mt-2 font-weight-bold"><?= $lastCourse->price ?> تومان</h3>
                                        </div>
                                    </div>

                                </div>
                            <?php  } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Courses Detail Section -->
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

@section('script')
<script>
    function answerView(id) {
        let form = document.getElementById('answer' + id);
        form.className = 'd-block'
    }
</script>
@endsection
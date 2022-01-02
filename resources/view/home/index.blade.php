@extends('home.layouts.app')

@section('head-tag')
<title>لرنیت صفحه اصلی</title>
@endsection

@section('content')
<?= flashText('forgot'); ?>

<!-- Banner Top Section -->
<div class="bg-top-default">
    <div class="container">
        <div class="row">

            <div class="col-lg-9">
                <div class="content-banner-top">
                    <h1 class="font-weight-bold">امروز چه چیزی یاد می گیرید؟ </h1>
                    <h3 class="mt-1 mb-2">هر جا ، امروز شروع به یادگیری کنید!</h3>
                    <p>از چندین دوره ویدیو آنلاین جدید منتشر شده در هر ماه ، انتخاب کنید.</p>
                </div>
                <div class="group-btn-top mt-4"> <a href="<?= route('home.all.course') ?>" class="btn btn-fill-secondary ml-2">دوره خود را
                        پیدا کنید </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Banner Top Section -->

<!-- Featured Courses Section -->
<div class="featured-courses">
    <div class="title-page text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4>دوره پیشنهادی</h4>
                    <hr class="line-title">
                    <h1>دوره های ویژه</h1>
                    <?= errorText('not_login') ?>
                    <?= errorText('already_exist') ?>
                </div>
            </div>
        </div>
    </div>
    <div class="gr-card-courses">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="owl-carousel owl-theme" id="carousel-card-courses-2">
                        <?php foreach ($suggestedCourses as $suggestedCourse) { ?>
                            <div class="item">
                                <div class="card-courses">
                                    <div class="images-card-courses">
                                        <img src="<?= asset($suggestedCourse->image['small']) ?>" class="img-fluid" alt="">
                                    </div>
                                    <div class="content-card-courses px-3 py-3">
                                        <a href="<?= route('home.course.show', ['id' => $suggestedCourse->id]) ?>" class="text_dark "><span class="name-courses"><?= $suggestedCourse->name ?></span></a>
                                        <span class="teacher-courses mb-2"><?= $suggestedCourse->professor()->first_name . ' ' . $suggestedCourse->professor()->last_name ?></span>
                                        <div class="price-courses mt-1 mb-2">
                                            <?php
                                            $comments =  $suggestedCourse->score()->where('approved', 1)->whereNull('parent_id')->get();

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

                                            <span class="price-main"><?= $suggestedCourse->price == 0 ? 'رایگان' : number_format($suggestedCourse->price) . ' تومان' ?> </span>

                                        </div>
                                    </div>
                                    <div class="card-courses-hover px-3 py-3 pr-0">
                                        <a href="<?= route('home.course.show', ['id' => $suggestedCourse->id]) ?>" class="text_dark "><span class="name-courses"><?= $suggestedCourse->name ?></span></a>

                                        <span class="date-courses mt-2">
                                            <i class="fas fa-calendar-alt"></i>
                                            در <?= \Morilog\Jalali\Jalalian::forge($suggestedCourse->updated_at)->format('%d %B. %Y')  ?> به روز شد
                                        </span>
                                        <div class="info-times mt-2 mb-2">
                                            <span class="ml-2">
                                                <i class="fas fa-clock ml-2"></i>
                                                <?= convertToHoursMins($suggestedCourse->time, '%02d ساعت و %02d دقیقه') ?>
                                            </span>
                                        </div>
                                        <p class="ders-courses mb-3"><?= mb_substr(html_entity_decode($suggestedCourse->description), 0, 40) ?>...</p>
                                        <form action="<?= route('home.cart.add', ['course_id' => $suggestedCourse->id]) ?>" method="post">
                                            <button type="submit" class="btn btn-fill-secondary float-left">ثبت دوره</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- End item -->
                        <?php  } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Featured Courses Section -->

<!-- Featured Courses Section -->
<div class="featured-courses">
    <div class="title-page text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4>آخرین دوره ها</h4>
                    <hr class="line-title">
                    <h1>جدید ترین دور ها</h1>
                    <?= errorText('not_login') ?>
                    <?= errorText('already_exist') ?>
                </div>
            </div>
        </div>
    </div>
    <div class="gr-card-courses">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="owl-carousel owl-theme" id="carousel-card-courses-1">
                        <?php foreach ($lastCourses as $lastCourse) { ?>
                            <div class="item">
                                <div class="card-courses">
                                    <div class="images-card-courses">
                                        <img src="<?= asset($lastCourse->image['small']) ?>" class="img-fluid" alt="">
                                    </div>
                                    <div class="content-card-courses px-3 py-3">
                                        <a href="<?= route('home.course.show', ['id' => $lastCourse->id]) ?>" class="text_dark "><span class="name-courses"><?= $lastCourse->name ?></span></a>
                                        <span class="teacher-courses mb-2"><?= $lastCourse->professor()->first_name . ' ' . $lastCourse->professor()->last_name ?></span>
                                        <div class="price-courses mt-1 mb-2">
                                            <?php
                                            $comments =  $lastCourse->score()->where('approved', 1)->whereNull('parent_id')->get();

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

                                            <span class="price-main"><?= $lastCourse->price == 0 ? 'رایگان' : number_format($lastCourse->price) . ' تومان' ?> </span>

                                        </div>
                                    </div>
                                    <div class="card-courses-hover px-3 py-3 pr-0">
                                        <a href="<?= route('home.course.show', ['id' => $lastCourse->id]) ?>" class="text_dark "><span class="name-courses"><?= $lastCourse->name ?></span></a>

                                        <span class="date-courses mt-2">
                                            <i class="fas fa-calendar-alt"></i>
                                            در <?= \Morilog\Jalali\Jalalian::forge($lastCourse->updated_at)->format('%d %B. %Y')  ?> به روز شد
                                        </span>
                                        <div class="info-times mt-2 mb-2">
                                            <span class="ml-2">
                                                <i class="fas fa-clock ml-2"></i>
                                                <?= convertToHoursMins($lastCourse->time, '%02d ساعت و %02d دقیقه') ?>
                                            </span>
                                        </div>
                                        <p class="ders-courses mb-3"><?= mb_substr(html_entity_decode($lastCourse->description), 0, 40) ?>...</p>
                                        <form action="<?= route('home.cart.add', ['course_id' => $lastCourse->id]) ?>" method="post">
                                            <button type="submit" class="btn btn-fill-secondary float-left">ثبت دوره</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- End item -->
                        <?php  } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Featured Courses Section -->

<!-- Featured Number Section -->
<div class="feature-number">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-3">
                <div class="card-number text-white text-center"> <i class="fas fa-book"></i>
                    <h1 class="mt-2 mb-2 font-weight-bold count"><?= count($allCourse) ?></h1>
                    <span>دوره ها</span>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card-number text-white text-center"> <i class="fas fa-user-graduate"></i>
                    <h1 class="mt-2 mb-2 font-weight-bold count"><?= count($allUser) ?></h1>
                    <span>دانش جویان</span>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card-number text-white text-center"> <i class="fas fa-user-tie"></i>
                    <h1 class="mt-2 mb-2 font-weight-bold count"><?= count($allProfessor) ?></h1>
                    <span>اساتید</span>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card-number text-white text-center"> <i class="fas fa-comment"></i>
                    <h1 class="mt-2 mb-2 font-weight-bold count"><?= count($allComment) ?></h1>
                    <span>نظرات</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Featured Number Section -->

<!-- Our Instructor Section -->
<div class="our-instructor bg-light">
    <div class="title-page text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4>بهترین ها</h4>
                    <hr class="line-title">
                    <h1>اساتید</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="gr-card-instrutor">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="owl-carousel owl-theme" id="carousel-card-instrutor">
                        <?php foreach ($allProfessor as $professor) { ?>
                            <div class="item">
                                <div class="card-instrutor">
                                    <div class="images-card-instrutor">
                                        <img src="<?= asset($professor->image['big']) ?>" class="img-fluid" alt="">
                                    </div>
                                    <div class="content-card-instrutor px-3 py-3">
                                        <a href="<?= route('home.professor.all.course', ['id' => $professor->id]) ?>">
                                            <h3 class="name-instrutor"><?= $professor->first_name . ' ' . $professor->last_name ?></h3>
                                        </a>

                                        <div class="text-instrutor">
                                            <p><?= mb_substr($professor->description, 0, 80) ?>...</p>
                                        </div>

                                        <?php
                                        $courses = App\Course::where('professor_id', $professor->id)->get();
                                        //get count comment and student
                                        $coursesId = [];
                                        foreach ($courses as $courseId) {
                                            array_push($coursesId, $courseId->id);
                                        }
                                        $allComment = [];
                                        $allStudent = [];
                                        foreach ($coursesId as $id) {
                                            $countComment = count(App\Comment::where('course_id', $id)->where('approved', 1)->get());
                                            $countStudent = count(App\UserCourse::where('course_id', $id)->whereNotNull('payment_code')->get());
                                            array_push($allComment, $countComment);
                                            array_push($allStudent, $countStudent);
                                        }
                                        $allComment = array_sum($allComment);
                                        $allStudent = array_sum($allStudent);
                                        //end

                                        ?>

                                        <div class="info-instrutor mt-2 mb-2">
                                            <div class="student-instrutor"> <span><?= $allStudent ?></span>
                                                <span>دانش آموزان</span>
                                            </div>
                                            <div class="course-instrutor"> <span><?= count($professor->courses()->get()) ?></span>
                                                <span>دوره ها</span>
                                            </div>
                                            <div class="comment-instrutor"> <span><?= $allComment ?></span>
                                                <span>نظرات</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End item -->
                        <?php  } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Our Instructor Section -->

<!-- Our Client Say Section -->
<div class="our-client">
    <div class="container">
        <div class="group-our-client">
            <div class="owl-carousel owl-theme" id="our-client-say">
                <?php foreach ($lastComments as $lastComment) { ?>
                    <div class="item">
                        <div class="card card-client animated-Fade-In-1 border-0">
                            <div class="card-content">
                                <div class="content-client">
                                    <div class="avatar-client">
                                        <img src="<?= $lastComment->user()->avatar ?>" alt="" class="img-fluid">
                                    </div>
                                    <div class="info-client">
                                        <p><?= $lastComment->user()->first_name . ' ' . $lastComment->user()->last_name ?></p>

                                    </div>
                                </div>
                            </div>
                            <div class="card-body" style="display: inline-flex;">
                                <p><?= $lastComment->comment ?></p>
                            </div>
                        </div>
                    </div>
                    <!-- End item -->
                <?php  } ?>
            </div>
            <!-- End owl-carousel -->
        </div>
    </div>
</div>
<!-- End Our Client Say Section -->

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
@extends('home.layouts.app')

@section('head-tag')
<title>اطلاعات استاد</title>
@endsection

@section('content')

<!-- Instructor Detail Section -->
<div class="instrutor-detail">
    <div class="container">
        <?= errorText('student_exist') ?>
        <?= errorText('course_removed') ?>
        <div class="card-instrutor-detail">
            <div class="row">
                <div class="col-lg-4">
                    <div class="img-instrutor text-center">
                        <img src="<?= $professor->image['big'] ?>" class="img-fluid" alt="">
                        <h3 class="mt-3"><?= $professor->first_name . ' ' . $professor->last_name ?></h3>
                        <div class="group-icon-social mt-2">
                            <a href="<?= $professor->facebook ?>"><i class="fab fa-facebook-f"></i></a>
                            <a href="<?= $professor->telegram ?>"><i class="fab fa-telegram-plane"></i></a>
                            <a href="<?= $professor->instagram ?>"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="content-instrutor">
                        <h4>درباره استاد</h4>
                        <p class="mt-2 mb-2 text-about-instrutor"><?= $professor->description ?></p>

                        <div class="info-instrutor mt-2 mb-2">
                            <div class="student-instrutor text-center mx-3">
                                <h2 class="font-weight-bold text-center"><?= $allStudent ?></h2>
                                <span class="d-block m-0">دانشجویان</span>
                            </div>
                            <div class="course-instrutor  text-center mx-3">
                                <h2 class="font-weight-bold text-center"><?= count($professor->courses()->get()) ?></h2>
                                <span class="d-block m-0">دوره ها</span>
                            </div>
                            <div class="comment-instrutor text-center mx-3">
                                <h2 class="font-weight-bold text-center"><?= $allComment ?></h2>
                                <span class="d-block m-0">نظرات</span>
                            </div>
                            <div class="comment-instrutor text-center mx-3">
                                <h2 class="font-weight-bold"><?= number_format($income) ?> تومان</h2>
                                <span class="d-block m-0">درامد شما</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-lg-12">
                    <a href="<?= route('home.professor.edit.info') ?>">
                        <button class="btn btn-danger">ویرایش اطلاعات </button>
                    </a>
                    <a href="<?= route('home.course.create') ?>">
                        <button class="btn btn-info">ایجاد دوره جدید</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Instructor Detail Section -->
<div class="list-courses-section">
    <div class="title-page text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4>لسیت دوره ها</h4>
                    <hr class="line-title">
                    <h1>دوره های <?= \System\Auth\Auth::professor()->first_name . ' ' . \System\Auth\Auth::professor()->last_name ?></h1>
                </div>
            </div>
        </div>
    </div>
    <div class="gr-card-courses-list">
        <div class="container">
            <div class="row">
                <?php foreach (paginate($courses, 6) as $course) { ?>
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
                                        <span class="teacher-courses mb-2"><?= $course->professor()->first_name . ' ' .  $course->professor()->last_name ?></span>
                                        <span class="rank-courses">
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
                                            <div class="info-times mt-2 mb-2">
                                                <span class="ml-2">
                                                    <i class="fas fa-clock ml-2"></i>
                                                    <?= convertToHoursMins($course->time, '%02d ساعت و %02d دقیقه') ?>
                                                </span>
                                            </div>
                                            <div class="price-courses mt-1 mb-2">
                                                <span class="price-main"><?= $course->price ?> تومان</span>
                                            </div>

                                            <div class="d-flex justify-content-between">
                                                <a href="<?= route('home.course.edit', ['id' => $course->id]) ?>" class="btn-sm btn-fill-secondary">ویرایش</a>
                                                <a href="<?= route('home.course.video.list', ['id' => $course->id]) ?>" class="btn-sm btn-fill-secondary">ویدیو ها</a>
                                                <a href="<?= route('home.course.delete', ['id' => $course->id]) ?>" class="btn-sm btn-fill-primary">حذف</a>

                                            </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php  } ?>
                <div class="blog-pagination">
                    <nav>
                        <?= paginateView($courses, 6) ?>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
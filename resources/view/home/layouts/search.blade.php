@extends('home.layouts.app')

@section('head-tag')
<title>جستجو برچسب</title>
@endsection()
@section('content')
<!-- List Courses Section -->

<div class="list-courses-section">
    <div class="title-page text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4>جستجو <?= isset($_GET['search']) == true ? $_GET['search'] : $_GET['searchTag']; ?></h4>
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
                <?php if (empty($courses)) { ?>
                    <p class="w-100 text-center">هیچ دوره ای پیدا نشد!!!</p>
                <?php }  ?>
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
                                            
                                            <div class="price-courses mt-1 mb-2">

                                                <span class="price-main"><?= $course->price == 0 ? 'رایگان' : number_format($course->price) . ' تومان' ?> </span>

                                            </div>
                                            <span class="status1-courses">پرفروش</span>
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
                    <nav>
                        <?= paginateView($courses, 10) ?>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Upcoming Events Section -->
@endsection
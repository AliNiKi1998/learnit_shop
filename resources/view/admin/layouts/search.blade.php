@extends('admin.layouts.app')

@section('head-tag')
<title>جستجو</title>
@endsection

@section('content')

<div class="row">
    <h4 class="m-t-0 m-b-5 font-600">کاربران</h4>
    <?php foreach ($usersSearch as $userSearch) { ?>
        <div class="col-lg-3 col-md-6">
            <div class="card-box widget-user">
                <div>
                    <img src="<?= asset($userSearch->avatar) ?>" class="img-responsive img-circle" alt="user">
                    <div class="wid-u-info">
                        <h4 class="m-t-0 m-b-5 font-600"><?= $userSearch->first_name . ' ' . $userSearch->last_name  ?></h4>
                        <p class="text-muted m-b-5 font-13"><?= $userSearch->email ?></p>
                        <small class="text-warning"><b>
                                <?php
                                if ($userSearch->user_type == 'admin') {
                                    echo 'مدیر';
                                } elseif ($userSearch->user_type == 'writer') {
                                    echo 'نویسنده';
                                } else {
                                    echo 'کاربر';
                                }
                                ?>
                            </b></small>
                    </div>
                </div>
            </div>
        </div><!-- end col -->
    <?php } ?>
    <?php if (empty($usersSearch)) {
        echo '<h5 class="m-t-0 m-b-5 font-600 text-danger">هیچ کاربری یافت نشد</h5>';
    } ?>
</div>

<div class="row">
    <h4 class="m-t-0 m-b-5 font-600">اساتید</h4>
    <?php foreach ($professorsSearch as $professorSearch) { ?>
        <div class="col-lg-3 col-md-6">
            <div class="card-box widget-user">
                <div>
                    <img src="<?= asset($professorSearch->image['big']) ?>" class="img-responsive img-circle" alt="user">
                    <div class="wid-u-info">
                        <h4 class="m-t-0 m-b-5 font-600"><?= $professorSearch->first_name . ' ' . $professorSearch->last_name  ?></h4>
                        <p class="text-muted m-b-5 font-13"><?= $professorSearch->email ?></p>
                        <small class="text-warning"><b>
                                <?= $professorSearch->user_type ?>
                            </b></small>
                    </div>
                </div>
            </div>
        </div><!-- end col -->
    <?php } ?>
    <?php if (empty($professorsSearch)) {
        echo '<h5 class="m-t-0 m-b-5 font-600 text-danger">هیچ استادی یافت نشد</h5>';
    } ?>
</div>

<div class="row">
    <h4 class="m-t-0 m-b-5 font-600">ویدیو ها</h4>
    <?php if (!empty($videsosSearch)) { ?>
        <div class="col-sm-12">
            <div class="card-box table-responsive">
                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>نام</th>
                            <th>زمان</th>
                            <th>دوره</th>
                            <th>استاد</th>
                            <th class="sorting_disable">فعالیت</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($videsosSearch as $videsoSearch) { ?>
                            <tr>
                                <td><?= $videsoSearch->id ?></td>
                                <td><?= $videsoSearch->name ?></td>
                                <td><?= $videsoSearch->time ?></td>
                                <td><?= $videsoSearch->course()->name ?></td>
                                <td><?= $videsoSearch->professor()->first_name . ' ' . $videsoSearch->professor()->last_name  ?></td>

                                <td class="actions d-flex align-items-center justify-content-space-around">
                                    <form action="<?= route('admin.video.delete', [$videsoSearch->id]) ?>" method="post">
                                        <input type="hidden" name="_method" value="delete">
                                        <button type="submit" onclick="return confirm('میخوای ویدیو  <?= $videsoSearch->name ?> رو حذف کنی؟')" class="btn btn-danger fs-15">
                                            <i class="fa fa-trash-o text-white"></i>
                                        </button>
                                    </form>
                                </td>

                            </tr>

                        <?php } ?>


                    </tbody>
                </table>

            </div>
        </div><!-- end col -->
    <?php } else {
        echo '<h5 class="m-t-0 m-b-5 font-600 text-danger">هیچ ویدیویی یافت نشد</h5>';
    }  ?>
</div>

<div class="row">
    <?= errorText('course_removed') ?>
    <?= errorText('student_exist') ?>
    <h4 class="m-t-0 m-b-5 font-600">دوره ها</h4>
    <?php if (!empty($coursesSearch)) { ?>
        <div class="col-sm-12">
            <div class="card-box table-responsive">
                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>اسم</th>
                            <th>استاد</th>
                            <th>زمان</th>
                            <th>دسته بندی</th>
                            <th>دانشجویان</th>
                            <th>عکس</th>
                            <th>وضعیت</th>
                            <th class="sorting_disable">فعالیت</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($coursesSearch as $courseSearch) { ?>
                            <tr>
                                <td><?= $courseSearch->id ?></td>
                                <td><?= $courseSearch->name ?></td>
                                <td><?= $courseSearch->professor()->first_name . ' ' . $courseSearch->professor()->last_name ?></td>
                                <td><?= $courseSearch->time ?></td>
                                <td><?= $courseSearch->category()->name ?></td>
                                <td><?= count($courseSearch->students()->whereNotNull('payment_code')->get()) ?></td>
                                <td><img src="<?= asset($courseSearch->image['small']) ?>" alt="" width="60" height="60"></td>

                                <td><?= $courseSearch->status == 1 ? '<span class="text-success">فعال</span>' : '<span class="text-warning">غیر فعال</span>'; ?></td>

                                <td class="actions d-flex align-items-center justify-content-space-around">
                                    <a href="<?= route('admin.course.change.status', [$courseSearch->id]) ?>">
                                        <?= $courseSearch->status == 1 ? '<button class="btn btn-warning" >غیر فعال کردن</button>' : ' <button class="btn btn-success" >فعال کردن</button>' ?>

                                    </a>
                                    <a href="<?= route('admin.course.edit', [$courseSearch->id]) ?>"><i class="fa fa-pencil text-success fs-18"></i></a>
                                    <form action="<?= route('admin.course.delete', [$courseSearch->id]) ?>" method="post">
                                        <input type="hidden" name="_method" value="delete">
                                        <button type="submit" onclick="return confirm('میخوای دوره  <?= $courseSearch->name ?> رو حذف کنی؟')" class="btn btn-danger fs-15">
                                            <i class="fa fa-trash-o text-white"></i>
                                        </button>
                                    </form>

                                </td>
                            </tr>

                        <?php } ?>


                    </tbody>
                </table>

            </div>
        </div><!-- end col -->
    <?php } else {
        echo '<h5 class="m-t-0 m-b-5 font-600 text-danger">هیچ دوره ای یافت نشد</h5>';
    }  ?>
</div>
@endsection

@section('script')

@endsection
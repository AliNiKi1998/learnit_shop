@extends('home.layouts.app')

@section('head-tag')
<title>لیست ویدیو ها</title>
@endsection

@section('content')
<div class="list-courses-section">
    <div class="title-page text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4>لسیت ویدیو ها <?= $course->name ?></h4>
                    <hr class="line-title">
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="d-flex justify-content-between">
            <a href="<?= route('home.course.video.create', ['courseID' => $course->id]) ?>" class="btn btn-success mb-3">ثبت ویدیو جدید</a>
            <a href="<?= route('home.professor.show') ?>" class="btn btn-secondary mb-3">بازگشت</a>
        </div>
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">نام</th>
                    <th scope="col">زمان</th>
                    <th scope="col">وضعیت</th>
                    <th scope="col">استاد</th>
                    <th scope="col">دوره</th>
                    <th scope="col">فعالیت</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($videos as $video) { ?>
                    <tr>
                        <th scope="row"><?= $video->id ?></th>
                        <td><?= $video->name ?></td>
                        <td><?= convertToHoursMins($video->time, '%02d ساعت و %02d دقیقه') ?></td>
                        <td><?= $video->status == 1 ? '<span class="text-success">فعال</span>' : '<span class="text-warning">غیر فعال</span>'; ?></td>
                        <td><?= $video->professor()->first_name . ' ' . $video->professor()->last_name ?></td>
                        <td><?= $video->course()->name ?></td>
                        <td class="d-flex justify-content-around">

                            <a href="<?= route('home.course.video.change.status', [$video->id]) ?>">
                                <?= $video->status == 1 ? '<button class="btn-sm btn-warning" >غیر فعال کردن</button>' : ' <button class="btn-sm btn-success" >فعال کردن</button>' ?>

                            </a>

                            <a href="<?= route('home.course.video.edit', [$video->id]) ?>"><button class="btn-sm btn-info">ویرایش</button></a>

                            <form action="<?= route('home.course.video.delete', [$video->id]) ?>" method="post">
                                <input type="hidden" name="_method" value="delete">
                                <button class="btn-sm btn-danger" type="submit" onclick="return confirm('ویدیو <?= $video->name ?> حذف شود؟')" class="btn btn-danger fs-15">
                                    حذف
                                </button>
                            </form>

                        </td>
                    </tr>
                <?php  } ?>
            </tbody>
        </table>
    </div>
</div>
@endsection
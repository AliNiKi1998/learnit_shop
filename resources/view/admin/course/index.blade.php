@extends('admin.layouts.app')

@section('head-tag')
<title>ادمین | دوره ها</title>
<!-- DataTables -->
<link href="<?= asset('panel/assets/plugins/datatables/jquery.dataTables.min.css') ?>" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="row">
<?= errorText('course_removed') ?>
<?= errorText('student_exist') ?>
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
                    <?php foreach ($courses as $course) { ?>
                        <tr>
                            <td><?= $course->id ?></td>
                            <td><?= $course->name ?></td>
                            <td><?= $course->professor()->first_name .' ' .$course->professor()->last_name ?></td>
                            <td><?= $course->time ?></td>
                            <td><?= $course->category()->name ?></td>                           
                            <td><?= count($course->students()->whereNotNull('payment_code')->get()) ?></td>                           
                            <td><img src="<?= asset($course->image['small']) ?>" alt="" width="60" height="60"></td>

                            <td><?= $course->status == 1 ? '<span class="text-success">فعال</span>' : '<span class="text-warning">غیر فعال</span>'; ?></td>

                            <td class="actions d-flex align-items-center justify-content-space-around">
                                <a href="<?= route('admin.course.change.status', [$course->id]) ?>">
                                    <?= $course->status == 1 ? '<button class="btn btn-warning" >غیر فعال کردن</button>' : ' <button class="btn btn-success" >فعال کردن</button>' ?>

                                </a>
                                <a href="<?= route('admin.course.edit', [$course->id]) ?>"><i class="fa fa-pencil text-success fs-18"></i></a>
                                <form action="<?= route('admin.course.delete', [$course->id]) ?>" method="post">
                                    <input type="hidden" name="_method" value="delete">
                                    <button type="submit" onclick="return confirm('میخوای دوره  <?= $course->name ?> رو حذف کنی؟')" class="btn btn-danger fs-15">
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
</div>
@endsection

@section('script')
<!-- Datatables-->
<script src="<?= asset('panel/assets/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= asset('panel/assets/plugins/datatables/dataTables.bootstrap.js') ?>"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#datatable-responsive').DataTable();
    });
</script>
@endsection
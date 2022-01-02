@extends('admin.layouts.app')

@section('head-tag')
<title>ادمین | کاربر ها</title>
<!-- DataTables -->
<link href="<?= asset('panel/assets/plugins/datatables/jquery.dataTables.min.css') ?>" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card-box table-responsive">
            <?= errorText('user_login') ?>
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>نام</th>
                        <th>نام خانوادگی</th>
                        <th>نوع</th>
                        <th>ایمیل</th>
                        <th>عکس</th>
                        <th>وضعیت</th>
                        <th>تایید ایمیل</th>
                        <th class="sorting_disable">فعالیت</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user) { ?>
                        <tr>
                            <td><?= $user->id ?></td>
                            <td><?= $user->first_name ?></td>
                            <td><?= $user->last_name ?></td>
                            <td><?= $user->user_type ?></td>
                            <td><?= $user->email ?></td>
                            <td><img src="<?= $user->avatar ?>" alt="" width="60" height="60"></td>
                            <td><?= $user->status == 1 ? '<span class="text-success">فعال</span>' : '<span class="text-warning">غیر فعال</span>'; ?></td>
                            <td><?= $user->is_active == 1 ? '<span class="text-success">تایید شده</span>' : '<span class="text-warning">تایید نشده</span>'; ?></td>
                            <td class="actions d-flex align-items-center justify-content-space-around">

                                <a href="<?= route('admin.user.change.status', [$user->id]) ?>">
                                    <?= $user->status == 1 ? '<button class="btn btn-warning" >غیر فعال کردن</button>' : ' <button class="btn btn-success" >فعال کردن</button>' ?>

                                </a>

                                <a href="<?= route('admin.user.edit', [$user->id]) ?>"><i class="fa fa-pencil text-success fs-18"></i></a>
                                
                                <form action="<?= route('admin.user.delete', [$user->id]) ?>" method="post">
                                    <input type="hidden" name="_method" value="delete">
                                    <button type="submit" onclick="return confirm('میخوای کاربر  <?= $user->first_name . ' ' . $user->last_name ?> رو حذف کنی؟')" class="btn btn-danger fs-15">
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
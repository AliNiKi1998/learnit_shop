@extends('admin.layouts.app')

@section('head-tag')
<title>ادمین | نظرات</title>
<!-- DataTables -->
<link href="<?= asset('panel/assets/plugins/datatables/jquery.dataTables.min.css') ?>" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card-box table-responsive">
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>نام</th>
                        <th>نام خانوادگی</th>
                        <th>متن نظر</th>
                        <th>وضعیت</th>
                        <th>تایید</th>
                        <th class="sorting_disable">فعالیت</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($comments as $comment) { ?>
                        <tr>
                            <td><?= $comment->id ?></td>
                            <td><?= @$comment->user()->first_name . @$comment->professor()->first_name ?></td>
                            <td><?= @$comment->user()->last_name . @$comment->professor()->last_name ?></td>                            
                            <td><?= mb_substr($comment->comment , 0 , 60) ?>...</td>                            
                            <td><?= $comment->status == 1 ? '<span class="text-success">فعال</span>' : '<span class="text-warning">غیر فعال</span>'; ?></td>
                            <td><?= $comment->approved == 1 ? '<span class="text-success">تایید شده</span>' : '<span class="text-warning">در انتظار تایید</span>'; ?></td>

                            <td class="actions d-flex align-items-center justify-content-space-around">
                                <a href="<?= route('admin.comment.change.status', [$comment->id]) ?>">
                                    <?= $comment->status == 1 ? '<button class="btn btn-warning" >غیر فعال کردن</button>' : ' <button class="btn btn-success" >فعال کردن</button>' ?>

                                </a>

                                <a href="<?= route('admin.comment.show', [$comment->id]) ?>"><button class="btn btn-info" >نمایش</button></a>

                                <a href="<?= route('admin.comment.confirm', [$comment->id]) ?>">
                                    <?= $comment->approved == 1 ? '<button class="btn btn-warning" >لغو تایید</button>' : ' <button class="btn btn-success" >تایید کردن</button>' ?>

                                </a>
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
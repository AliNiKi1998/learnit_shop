@extends('admin.layouts.app')

@section('head-tag')
<title>ادمین | ویدیو ها</title>
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
                        <th>زمان</th>
                        <th>دوره</th>
                        <th>استاد</th>
                        <th class="sorting_disable">فعالیت</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($videos as $video) { ?>
                        <tr>
                            <td><?= $video->id ?></td>
                            <td><?= $video->name ?></td>
                            <td><?= $video->time ?></td>
                            <td><?= $video->course()->name ?></td>
                            <td><?= $video->professor()->first_name . ' ' . $video->professor()->last_name  ?></td>

                            <td class="actions d-flex align-items-center justify-content-space-around">
                                <form action="<?= route('admin.video.delete', [$video->id]) ?>" method="post">
                                    <input type="hidden" name="_method" value="delete">
                                    <button type="submit" onclick="return confirm('میخوای ویدیو  <?= $video->name ?> رو حذف کنی؟')" class="btn btn-danger fs-15">
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
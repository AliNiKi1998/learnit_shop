@extends('admin.layouts.app')

@section('head-tag')
<title>ادمین | ایمیل های خبر نامه </title>
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
                        <th>ایمیل</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($emails as $email) { ?>
                        <tr>
                            <td><?= $email->id ?></td>
                            <td><?= $email->email ?></td>
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
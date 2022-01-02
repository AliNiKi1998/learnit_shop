@extends('admin.layouts.app')

@section('head-tag')
<title>ادمین | دسته بندی ها</title>
<!-- DataTables -->
<link href="<?= asset('panel/assets/plugins/datatables/jquery.dataTables.min.css') ?>" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card-box table-responsive">

            <div class="row">
                <div class="col-sm-6">
                    <div class="m-b-30">
                        <a href="<?= route('admin.category.create') ?>">
                            <button class="btn btn-success waves-effect waves-light">افزودن <i class="fa fa-plus"></i></button>
                        </a>
                    </div>
                </div>
            </div>

            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>نام</th>
                        <th>دسته والد</th>
                        <th class="sorting_disable">فعالیت</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $category) { ?>
                        <tr>
                            <td><?= $category->id ?></td>
                            <td><?= $category->name ?></td>
                            <td><?= empty($category->parent_id) ? '' : $category->parent()->name ?></td>
                            <td class="actions d-flex align-items-center justify-content-space-around">
                                <a href="<?= route('admin.category.edit', [$category->id]) ?>"><i class="fa fa-pencil text-success fs-18"></i></a>
                                <form action="<?= route('admin.category.delete', [$category->id]) ?>" method="post">
                                    <input type="hidden" name="_method" value="delete">
                                    <button type="submit" onclick="return confirm('میخوای دسته بندی <?= $category->name ?> رو حذف کنی؟')" class="btn btn-danger fs-15">
                                        <i class="fa fa-trash-o text-white"></i>
                                    </button>
                                </form>

                            </td>
                        </tr>

                    <?php } ?>


                </tbody>
            </table>
             <?= errorText('has_course') ?>           
             <?= errorText('has_category') ?>           
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
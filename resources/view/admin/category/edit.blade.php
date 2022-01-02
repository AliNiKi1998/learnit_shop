@extends('admin.layouts.app')

@section('head-tag')
<title>ادمین | ویرایش دستته بندی</title>
<!-- form Uploads -->
<link href="<?= asset('panel/assets/plugins/fileuploads/css/dropify.min.css') ?>" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">

            <h4 class="header-title m-t-0 m-b-30"> ویرایش دسته بندی <span class="text-primary"><?= $currentCategory->name ?></span></h4>

            <div class="row">

                <form class="form-horizontal" role="form" method="post" action="<?= route('admin.category.update', [$currentCategory->id]) ?>">
                    <div class="col-lg-6">
                        <input type="hidden" name="_method" value="put">
                        <div class="form-group">
                            <label class="col-md-2 control-label">نام دسته بندی</label>
                            <div class="col-md-10">
                                <input type="text" name="name" placeholder="نام دسته بندی" class="form-control <?= errorClass('name') ?>" value="<?= oldOrValue('name', $currentCategory->name) ?>">
                                <?= errorText('name') ?>
                                <?= errorText('exists') ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">انتخاب دسته والد</label>
                            <div class="col-sm-10">
                                <select name="parent_id" class="form-control <?= errorClass('parent_id') ?>">
                                    <option value="">انتخاب دسته بندی</option>
                                    <?php foreach ($categories as $category) { ?>

                                        <option value="<?= $category->id ?>" <?= oldOrValue('parent_id', $currentCategory->parent_id) === $category->id ? 'selected' : '' ?>>
                                            <?= $category->name ?>
                                        </option>

                                    <?php  } ?>
                                </select>
                                <?= errorText('parent_id') ?>
                            </div>
                        </div>
                        <button type="submit" class="m-t-10 btn btn-info btn-block waves-effect waves-light">ویرایش</button>
                    </div><!-- end col -->

                </form>
            </div><!-- end col -->

        </div><!-- end row -->
    </div>
</div><!-- end col -->
</div>
@endsection
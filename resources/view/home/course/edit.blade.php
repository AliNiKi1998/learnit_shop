@extends('home.layouts.app')

@section('head-tag')
<title>ویرایش دوره</title>
<link href="<?= asset('panel/assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') ?>" rel="stylesheet" />

<style>
    .bootstrap-tagsinput .tag {
        margin-right: 2px;
        margin-bottom: 2px;
        color: white;
    }

    .label-info {
        background-color: #35b8e0;
    }

    .label {
        font-weight: 500;
        letter-spacing: 0.05em;
        padding: 0.3em 0.6em 0.3em;
    }

    .lable {
        display: inline;
        padding: .2em .6em .3em;
        font-size: 75%;
        font-weight: bold;
        line-height: 1;
        color: #fff;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: .25em;
        border-radius: 4px;
    }

    .bootstrap-tagsinput {
        min-height: 48px;
        position: relative;
        border: 2px solid #e9ecef;
        font-size: 16px;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
    }
</style>
@endsection

@section('content')
<!-- Register Page Section -->
<div class="page-register">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-8">
                <div class="base-register shadow-sm">
                    <h3 class="mb-3">ویرایش دوره <?= $course->name ?></h3>
                    <form action="<?= route('home.course.update', ['id' => $course->id]) ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="put">
                        <div class="form-group">
                            <label>نام</label>
                            <input type="text" name="name" value="<?= oldOrValue('name', $course->name) ?>" class="form-control <?= errorClass('name') ?>" placeholder="نام دوره">
                            <?= errorText('name') ?>
                        </div>
                        <div class="form-group">
                            <label>دسته بندی</label>
                            <select name="cat_id" class="form-control <?= errorClass('cat_id') ?>">
                                <?php foreach ($categories as $category) { ?>

                                    <option value="<?= $category->id ?>" <?= oldOrValue('cat_id', $course->cat_id) == $category->id ? 'selected' : ''; ?>><?= $category->name ?></option>

                                <?php } ?>
                            </select>
                            <?= errorText('cat_id') ?>
                        </div>
                        <div class="form-group">
                            <label>قیمت</label>
                            <input type="number" name="price" value="<?= oldOrValue('price', $course->price) ?>" class="form-control <?= errorClass('price') ?>" placeholder="قیمت">
                            <?= errorText('price') ?>
                        </div>
                        <div class="form-group">
                            <label>تگ ها</label>
                            <?php
                            $tags = explode(' ', oldOrValue('tags', $course->tags));
                            $tags = implode(',', $tags)
                            ?>
                            <input type="text" name="tags" value="<?= $tags ?>" class="form-control <?= errorClass('tags') ?>" data-role="tagsinput" placeholder="افزودن تگ" />
                            <?= errorText('tags') ?>
                        </div>
                        <div class="form-group">
                            <label>توضیحات</label>
                            <textarea name="description" id="description" cols="30" rows="10">
                            <?= oldOrValue('description', $course->description) ?>
                            </textarea>
                            <?= errorText('description') ?>
                        </div>

                        <div class="form-group">
                            <label>عکس</label>
                            <img src="<?= asset($course->image['small'])?>">
                        </div>

                        <div class="form-group">
                            <label for="avatar">عکس دوره</label>
                            <input type="file" name="image" class="form-control <?= errorClass('image') ?>">
                            <?= errorText('image') ?>
                        </div>

                        <div class="btn-login">
                            <button class="btn btn-fill-secondary d-block w-100">ویرایش</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <div class="area">
        <ul class="circles">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div>
</div>
<!-- End Register Page Section -->
@endsection

@section('script')
<script src="<?= asset('ckeditor/ckeditor.js'); ?>"></script>
<script type="text/javascript">
    CKEDITOR.replace('description');
</script>
<script src="<?= asset('panel/assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') ?>"></script>
@endsection
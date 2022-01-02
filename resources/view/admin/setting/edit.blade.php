@extends('admin.layouts.app')

@section('head-tag')
<title>ادمین | ویرایش تنظیمات</title>
<!-- DataTables -->
<link href="<?= asset('panel/assets/plugins/datatables/jquery.dataTables.min.css') ?>" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">

            <h4 class="header-title m-t-0 m-b-30"> ویرایش تنظیمات</h4>

            <div class="row">

                <form class="form-horizontal" role="form" method="post" action="<?= route('admin.setting.update', ['id' => $setting->id]) ?>">

                    <div class="col-lg-6">

                        <input type="hidden" name="_method" value="put">
                        <div class="form-group">
                            <label class="col-md-2 control-label">ایمیل</label>
                            <div class="col-md-10">
                                <input type="email" name="email" placeholder="ایمیل" class="form-control <?= errorClass('email') ?>" value="<?= oldOrValue('email', $setting->email) ?>">
                                <?= errorText('email') ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">موبایل</label>
                            <div class="col-md-10">
                                <input type="number" name="phone" placeholder="موبایل" class="form-control <?= errorClass('phone') ?>" value="<?= oldOrValue('phone', $setting->phone) ?>">
                                <?= errorText('phone') ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">موقعیت</label>
                            <div class="col-md-10">
                                <input type="text" name="location" placeholder="موقعیت" class="form-control <?= errorClass('location') ?>" value="<?= oldOrValue('location', $setting->location) ?>">
                                <?= errorText('location') ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">تلگرام</label>
                            <div class="col-md-10">
                                <input type="text" name="telegram" placeholder="تلگرام" class="form-control <?= errorClass('telegram') ?>" value="<?= oldOrValue('telegram', $setting->telegram) ?>">
                                <?= errorText('telegram') ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">اینستاگرام</label>
                            <div class="col-md-10">
                                <input type="text" name="instagram" placeholder="اینستاگرام" class="form-control <?= errorClass('instagram') ?>" value="<?= oldOrValue('instagram', $setting->instagram) ?>">
                                <?= errorText('instagram') ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">فیس بوک</label>
                            <div class="col-md-10">
                                <input type="text" name="facebook" placeholder="فیس بوک" class="form-control <?= errorClass('facebook') ?>" value="<?= oldOrValue('facebook', $setting->facebook) ?>">
                                <?= errorText('facebook') ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">توضیحات</label>
                            <div class="col-md-10">
                                <textarea name="description" class="form-control <?= errorClass('facebook') ?>" ">
                               <?= oldOrValue('description', $setting->description) ?>
                               </textarea>
                            </div>
                        </div>


                        <button type=" submit" class="m-t-10 btn btn-info btn-block waves-effect waves-light">ویرایش</button>
                    </div><!-- end col -->

                </form>
            </div><!-- end col -->

        </div><!-- end row -->
    </div>
</div><!-- end col -->
</div>
@endsection
@extends('admin.layouts.app')

@section('head-tag')
<title>ادمین | تنظیمات</title>
<!-- DataTables -->
<link href="<?= asset('panel/assets/plugins/datatables/jquery.dataTables.min.css') ?>" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="text-center card-box">
            <div>
                <h4 class="m-t-0 m-b-5 font-600">توضیحات سایت</h4>
                <p class="text-muted font-13 m-b-30">
                    <?= $setting->description ?>
                </p>

                <div class="text-left">
                    <p class="text-muted font-13"><strong>ایمیل :</strong> <span class="m-l-15"><?= $setting->email ?></span></p>
                    <p class="text-muted font-13"><strong>موبایل :</strong><span class="m-l-15">0<?= $setting->phone ?></span></p>
                    <p class="text-muted font-13"><strong>موقعیت :</strong> <span class="m-l-15"><?= $setting->location ?></span></p>
                    <p class="text-muted font-13 m-b-5"><strong>تلگرام :</strong> <span class="m-l-15"><?= $setting->telegram ?></span></p>
                    <p class="text-muted font-13 m-b-5"><strong>اینستاگرام :</strong> <span class="m-l-15"><?= $setting->instagram ?></span></p>
                    <p class="text-muted font-13 m-b-5"><strong>فیس بوک :</strong> <span class="m-l-15"><?= $setting->facebook ?></span></p>
                </div>

            </div>
            <a href="<?= route('admin.setting.edit') ?>" type="submit" class="m-t-10 btn btn-info btn-block waves-effect waves-light">ویرایش</a>
        </div>
    </div>
</div>
@endsection
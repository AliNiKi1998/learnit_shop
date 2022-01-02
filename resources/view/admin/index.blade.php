@extends('admin.layouts.app')

@section('head-tag')
<title>پنل مدیریت </title>
@endsection

@section('content')
<div class="row">
    <!-- <div class="col-lg-3 col-md-6">
        <div class="card-box">
            <h4 class="header-title m-t-0 m-b-30">درآمد کل</h4>

            <div class="widget-chart-1">
                <div class="widget-chart-box-1">
                    <input data-plugin="knob" data-width="80" data-height="80" data-fgColor="#f05050 " data-bgColor="#F9B9B9" value="58" data-skin="tron" data-angleOffset="180" data-readOnly=true data-thickness=".15" />
                </div>

                <div class="widget-detail-1">
                    <h2 class="p-t-10 m-b-0"> 256 </h2>
                    <p class="text-muted">درآمد روزانه</p>
                </div>
            </div>
        </div>
    </div> -->

    <div class="col-lg-6">
        <div class="card-box">
            <h4 class="header-title m-t-0 m-b-30">آمار بازدید سایت</h4>

            <div class="widget-box-2">
                <div class="widget-detail-2 d-flex" style="justify-content: space-between;">
                   <div class="info text-center">
                    <h2 class="m-b-0 text-success"><?= $webInfo['today_visit'] ?></h2>
                    <p class="text-muted m-b-25">بازدید امروز</p>
                   </div>
                   <div class="info text-center">
                    <h2 class="m-b-0 text-info"><?= $webInfo['yesterday_visit'] ?></h2>
                    <p class="text-muted m-b-25">بازدید دیروز</p>
                   </div>
                   <div class="info text-center">
                    <h2 class="m-b-0 text-success"><?= $webInfo['total_visit'] ?></h2>
                    <p class="text-muted m-b-25">بازدید کل</p>
                   </div>
                   <div class="info text-center">
                    <h2 class="m-b-0 text-info"><?= $webInfo['online'] ?></h2>
                    <p class="text-muted m-b-25">کاربران آنلاین</p>
                   </div>
                </div>
            </div>
        </div>
    </div>

</div>



<div class="row">
    <?php foreach ($admins as $admin) { ?>
        <div class="col-lg-3 col-md-6">
            <div class="card-box widget-user">
                <div>
                    <img src="<?= asset($admin->avatar) ?>" class="img-responsive img-circle" alt="user">
                    <div class="wid-u-info">
                        <h4 class="m-t-0 m-b-5 font-600"><?= $admin->first_name . ' ' . $admin->last_name  ?></h4>
                        <p class="text-muted m-b-5 font-13"><?= $admin->email ?></p>
                        <small class="text-warning"><b>
                                <?= $admin->user_type == 'admin' ? 'مدیر کل' : 'نویسنده'; ?>
                            </b></small>
                    </div>
                </div>
            </div>
        </div><!-- end col -->
    <?php } ?>
</div>
@endsection

@section('script')
<script src="<?= asset('panel/assets/plugins/jquery-knob/jquery.knob.js') ?>"></script>
@endsection
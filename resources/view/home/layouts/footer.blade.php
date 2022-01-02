<footer>
    <div class="top-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="block-widget">
                        <div class="logo-footer">
                            <img src="<?= asset('app/img/logo-footer.jpg') ?>" alt="">
                        </div>
                        <p class="mt-2 mb-3"><?= \App\Setting::find(1)->description ?></p>
                        <ul class="list-unstyled group-icon-contact">
                            <li><i class="fas fa-map-marker-alt"></i><?= \App\Setting::find(1)->location ?></li>
                            <li><i class="fas fa-envelope"></i><?= \App\Setting::find(1)->email ?></li>
                            <li><i class="fas fa-mobile-alt"></i>0<?= \App\Setting::find(1)->phone ?></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-lg-2">
                    <div class="block-widget">
                        <div class="widget-title">
                            <h5>لینک های مفید</h5>
                        </div>
                        <ul class="widget_links list-unstyled mt-3">
                            <li><a href="<?= route('home.all.course') ?>">لیست تمام دوره ها</a>
                            </li>
                            <li><a href="<?= route('auth.professor.login.view') ?>">ورود استاد</a>
                            </li>
                            <li><a href="<?= route('auth.login.view') ?>">ورود</a>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="block-social mt-4">
                        <div class="widget-title">
                            <h5>شبکه اجتماعی</h5>
                        </div>
                        <div class="group-icon-social mt-3"> 
                            <a href="<?= \App\Setting::find(1)->facebook ?>"><i class="fab fa-facebook-f"></i></a>
                            <a href="<?= \App\Setting::find(1)->instagram ?>"><i class="fab fa-instagram"></i></a>
                            <a href="<?= \App\Setting::find(1)->telegram ?>"><i class="fab fa-telegram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom-footer py-3">
        <div class="container border-top pt-3">
            <div class="row">
                <div class="col-lg-6">
                    <p class="coppyright">© 1400 کلیه حقوق این سایت متعلق به لرنیت است</p>
                </div>
               
            </div>
        </div>
    </div>
</footer>
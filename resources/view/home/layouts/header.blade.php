<!-- Header -->
<?php getAllView(); ?>
<header class="header">
    <div class="base-header">
        <div class="top-header">
            <div class="container">
                <div class="row">
                    <div class="col-5 col-md-8 col-lg-6">
                        <div class="top-header-info-left"> <span class="top-email"><i class="fas fa-envelope mr-1"></i><?= \App\Setting::find(1)->email ?></span> <span class="top-phone ml-2"><i class="fas fa-mobile-alt mr-1"></i>0<?= \App\Setting::find(1)->phone ?></span>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-lg-6 ">
                        <div class="top-header-info-right float-left
                        <?= \System\Auth\Auth::checkLoginProfessor() == true ? 'd-none' : '' ?>
                        "> <span class="ml-2"><a href="<?= route('auth.professor.register.view') ?>" style="color: aquamarine;"> ثبت نام استاد</a> </span>
                        </div>

                        <div class="top-header-info-right float-left ml-3
                        <?= \System\Auth\Auth::checkLoginProfessor() == true ? 'd-none' : '' ?>
                        "> <span class="ml-2"><a href="<?= route('auth.professor.login.view') ?>">ورود اساتید</a> </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="middle-header bg-white">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-4 col-lg-2">
                        <div class="logo-brand"> <i class="fas fa-bars menu-mobile"></i>
                            <a href="<?= route('home.index') ?>">
                                <img src="<?= asset('app/img/logo.png') ?>" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-12 col-md-8 col-lg-5">
                        <div class="nav-search">
                            <form action="<?= route('search') ?>" method="GET">
                                <input type="text" name="search" placeholder="دوره خود را جستجو کنید ..." class="searchbox" required="">
                                <button type="submit" class="searchbutton fa fa-search"></button>
                            </form>
                        </div>
                    </div>

                    <div class="col-12 col-md-12 col-lg-5">

                        <div class="group-icon-header">

                            <div class="cart">
                                <a href="<?= route('home.cart.show') ?>"><i class="fas fa-shopping-basket"></i>
                                    <span class="amount" id="total_price1">
                                </a>
                                <div class="box-cart">
                                    <div class="list-cart-item">
                                        <?php
                                        if (System\Auth\Auth::checklogin()) {
                                            $carts = \App\UserCourse::where('user_id', \System\Auth\Auth::user()->id)->whereNull('payment_code')->get();
                                            $sum = 0;
                                            foreach ($carts as $cart) {
                                                $sum += $cart->course()->price;
                                        ?>
                                                <div class="media border-bottom">
                                                    <img src="<?= asset($cart->course()->image['small']) ?>" class="align-self-start ml-3" alt="..." width="80" height="80">
                                                    <div class="media-body">
                                                        <a href="<?= route('home.course.show', ['id' => $cart->course()->id]) ?>">
                                                            <h5 class="mt-0"><?= $cart->course()->name ?></h5>
                                                        </a>
                                                        <a href="<?= route('home.cart.remove', ['id' => $cart->id]) ?>"><i class="fas fa-times"></i></a>
                                                        <div class="d-flex">
                                                            <p class="price d-none"> <?= $cart->course()->price ?>
                                                            <p> <?= number_format($cart->course()->price) ?>
                                                            <p>تومان</p>
                                                        </div>
                                                        </p>
                                                    </div>
                                                </div>
                                        <?php
                                            }
                                        } ?>
                                    </div>
                                    <?php if (System\Auth\Auth::checklogin()) { ?>
                                        <div class="bottom-cart">
                                            <div class="cart-total"> <span>جمع:</span> <span id="total_price"></span>
                                            </div>
                                            <div class="cart_gr_buttons d-flex justify-content-between">
                                                <a href="<?= route('home.cart.show') ?>" class="btn btn-fill-primary view-cart ml-2">مشاهده سبد</a>
                                                
                                                <form action="<?= route('user.payment.request', [$sum]) ?>" method="get">
                                                    <button class="btn btn-fill-secondary checkout">
                                                          پرداخت
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    <?php  } ?>
                                </div>
                            </div>
                        </div>

                        <script>
                            function separate(Number) {
                                Number += '';
                                Number = Number.replace(',', '');
                                x = Number.split('.');
                                y = x[0];
                                z = x.length > 1 ? '.' + x[1] : '';
                                var rgx = /(\d+)(\d{3})/;
                                while (rgx.test(y))
                                    y = y.replace(rgx, '$1' + ',' + '$2');
                                return y + z;
                            }

                            let price = document.querySelectorAll('.price');

                            let totalPrice1 = document.getElementById('total_price1');
                            let totalPrice = document.getElementById('total_price');

                            var sum = [];
                            price.forEach(myFunction);

                            function myFunction(item, index) {
                                sum.push(parseInt(item.innerHTML));
                            }

                            let sum1 = 0;

                            for (const i in sum) {
                                sum1 += sum[i];
                            }
                            totalPrice1.innerHTML = separate(sum1) + ' ' + 'تومان';
                            totalPrice.innerHTML = separate(sum1) + ' ' + 'تومان';
                        </script>

                        <div class="group-btn-header">
                            <a href="<?= route('auth.register.view') ?>" class="btn-resgiter ml-2 <?= \System\Auth\Auth::checkLogin() == true ? 'd-none' : '' ?>
                            <?= \System\Auth\Auth::checkLoginProfessor() == true ? 'd-none' : '' ?>
                            ">ثبت نام</a>

                            <a href="<?= route('auth.login.view') ?>" class="btn-login <?= \System\Auth\Auth::checkLogin() == true ? 'd-none' : '' ?>
                            <?= \System\Auth\Auth::checkLoginProfessor() == true ? 'd-none' : '' ?>">ورود</a>

                            <a href="<?= route('home.user.show') ?>" class="btn-resgiter <?= \System\Auth\Auth::checkLogin() == false ? 'd-none' : '' ?>">حساب کاربری</a>

                            <a href="<?= route('home.professor.show') ?>" class="btn-resgiter <?= \System\Auth\Auth::checkLoginProfessor() == false ? 'd-none' : '' ?>">حساب کاربری</a>

                            <a href="<?= route('auth.logout') ?>" class="btn-login <?= \System\Auth\Auth::checkLogin() == false ? 'd-none' : '' ?>">خروج</a>

                            <a href="<?= route('auth.professor.logout') ?>" class="btn-login <?= \System\Auth\Auth::checkLoginProfessor() == false ? 'd-none' : '' ?>">خروج</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bottom-header">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="block-navigation">
                            <nav class="navbar navbar-expand-lg">

                                <ul class="navbar-nav p-0 d-flex align-items-center" style="flex-direction: unset;">
                                    <li class="nav-item"> <a class="nav-link active" href="<?= route('home.index') ?>">خانه</a>
                                    </li>
                                    <?php
                                    $parentCategories = \App\Category::where('parent_id', 0)->get();
                                    $subCategories = \App\Category::where('parent_id', '!=', 0)->get();
                                    foreach ($parentCategories as $parentCategory) {
                                    ?>
                                        <li class="nav-item">
                                            <sapn class="nav-link d-flex align-items-center" style="font-weight: 700; font-size: 14px;"><?= $parentCategory->name; ?><i class="fa fa-caret-down mr-2"></i></sapn>
                                            <div class="dropdown-nav" style="top: 47px;">
                                                <ul class="list-unstyled">

                                                    <?php foreach ($subCategories as $subCategory) { ?>

                                                        <?php
                                                        if ($subCategory->parent_id == $parentCategory->id) {
                                                        ?>

                                                            <li>
                                                                <a href="<?= route('home.category.show', ['id' => $subCategory->id]) ?>" style="font-weight: 700; font-size: 13px;">
                                                                    <?= $subCategory->name ?>
                                                                </a>
                                                            </li>

                                                        <?php
                                                        }
                                                        ?>

                                                    <?php  } ?>
                                                </ul>
                                            </div>
                                        </li>
                                    <?php  } ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- End Header -->
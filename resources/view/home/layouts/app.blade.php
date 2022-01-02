<!DOCTYPE html>
<html lang="fa">

<head>
    @include('home.layouts.head-tag')
    @yield('head-tag')
</head>

<body>
    <!-- Preloader -->
    <div class="spinner-wrapper">
        <div class="logo-spinner">
            <img src="<?= asset('app/img/logo.png') ?>" alt="">
        </div>
        <div class="spinner">
            <div class="rect1"></div>
            <div class="rect2"></div>
            <div class="rect3"></div>
            <div class="rect4"></div>
            <div class="rect5"></div>
        </div>
    </div>
    <!-- End of Preloader -->

    <!-- Header -->

    @include('home.layouts.header')

    <!-- End Header -->

    <!-- Content Page -->
    <div class="wrapper-page">
        <div class="content-page">
            @yield('content')
        </div>
        <!-- Button Back Top -->
        <div class="back-top"> <a href="#top"><i class="fas fa-angle-up"></i></a> </div>
        <!-- End Button Back Top -->
    </div>
    <!-- End Content Page -->

    <!-- Footer -->

    @include('home.layouts.footer')

    <!-- End Footer -->

    <!-- Bootstrap JavaScript -->
    @include('home.layouts.script')
    @yield('script')
</body>

</html>
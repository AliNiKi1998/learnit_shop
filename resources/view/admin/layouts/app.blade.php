<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    @include('admin.layouts.head-tag')
    @yield('head-tag')
</head>

<body class="fixed-left">

    <!-- Begin page -->
    <div id="wrapper">

        @include('admin.layouts.top-bar')

        @include('admin.layouts.right-sidebar')



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container">

                    @yield('content')

                </div>
            </div>
        </div>

        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->

        @include('admin.layouts.left-sidbar')

    </div>

    @include('admin.layouts.script')
    @yield('script')

</body>

</html>
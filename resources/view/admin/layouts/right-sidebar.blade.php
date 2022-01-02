   <!-- ========== Left Sidebar Start ========== -->
   <?php $webInfo = getAllView(); ?>
   <div class="left side-menu">
       <div class="sidebar-inner slimscrollleft">

           <!-- User -->
           <div class="user-box">
               <div class="user-img">
                   <img src="<?= asset(\System\Auth\Auth::user()->avatar) ?>" alt="user-img" title="Mat Helme" class="img-circle img-thumbnail img-responsive">
                   <div class="user-status online"><i class="zmdi zmdi-dot-circle"></i></div>
               </div>
               <h5><a href="#"><?= \System\Auth\Auth::user()->first_name . ' ' . \System\Auth\Auth::user()->last_name ?></a> </h5>
               <ul class="list-inline">
                   <li>
                       <a href="<?= route('home.index') ?>">
                           <i class="zmdi zmdi-home"></i>
                       </a>
                   </li>

                   <li>
                       <a href="<?= route('admin.setting') ?>">
                           <i class="zmdi zmdi-settings"></i>
                       </a>
                   </li>

                   <li>
                       <a href="<?= route('auth.admin.logout') ?>" onclick="return confirm('برای خروج از پنل مطمئنی!!؟')" class="text-danger">
                           <i class="zmdi zmdi-power"></i>
                       </a>
                   </li>
               </ul>
           </div>
           <!-- End User -->

           <!--- Sidemenu -->
           <div id="sidebar-menu">
               <ul>
                   <li class="text-muted menu-title">دسته بندی ها</li>

                   <li>
                       <a href="<?= route('admin.index') ?>" class="waves-effect <?= sidebarActive(route('admin.index'), false) ?>"><i class="ti-layout-grid2-alt"></i> <span> داشبورد </span> </a>
                   </li>

                   <li>
                       <a href="<?= route('admin.category.index') ?>" class="waves-effect <?= sidebarActive(route('admin.category.index')) ?>"><i class="zmdi zmdi-collection-text"></i> <span> دسته بندی ها </span> </a>
                   </li>

                   <li>
                       <a href="<?= route('admin.user.index') ?>" class="waves-effect <?= sidebarActive(route('admin.user.index')) ?>"><i class="zmdi zmdi-collection-text"></i> <span> کاربر ها </span> </a>
                   </li>

                   <li>
                       <a href="<?= route('admin.professor.index') ?>" class="waves-effect <?= sidebarActive(route('admin.professor.index')) ?>"><i class="zmdi zmdi-collection-text"></i> <span> اساتید </span> </a>
                   </li>

                   <li>
                       <a href="<?= route('admin.course.index') ?>" class="waves-effect <?= sidebarActive(route('admin.course.index')) ?>"><i class="zmdi zmdi-collection-text"></i> <span> دوره ها </span> </a>
                   </li>

                   <li>
                       <a href="<?= route('admin.video.index') ?>" class="waves-effect <?= sidebarActive(route('admin.video.index')) ?>"><i class="zmdi zmdi-collection-text"></i> <span> ویدیو ها </span> </a>
                   </li>

                   <li>
                       <a href="<?= route('admin.comment.index') ?>" class="waves-effect <?= sidebarActive(route('admin.comment.index')) ?>"><i class="zmdi zmdi-collection-text"></i> <span> نظرات </span> </a>
                   </li>
                   <li>
                       <a href="<?= route('admin.news.latter') ?>" class="waves-effect <?= sidebarActive(route('admin.news.latter')) ?>"><i class="zmdi zmdi-collection-text"></i> <span> ایمیل های خبر نامه </span> </a>
                   </li>

               </ul>
               <div class="clearfix"></div>
           </div>
           <!-- Sidebar -->
           <div class="clearfix"></div>

       </div>

   </div>
   <!-- Left Sidebar End -->